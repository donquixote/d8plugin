<?php


namespace Drupal\d8plugin\Discovery;

use Doctrine\Common\Reflection\StaticReflectionParser;
use Drupal\d8plugin\Discovery\Argument\ArgumentsResolver;
use Drupal\d8plugin\PluginDefinition\PluginDefinitionInterface;
use Drupal\d8plugin\PluginType;
use Drupal\d8plugin\Reflection\FakeClassFinder;
use vektah\parser_combinator\exception\ParseException;
use vektah\parser_combinator\language\php\annotation\DoctrineAnnotation;
use vektah\parser_combinator\language\php\annotation\PhpAnnotationParser;

class PluginDiscovery {

  /**
   * @var PluginType
   */
  private $pluginType;

  /**
   * @var string
   */
  private $pluginTypePathSuffix;

  /**
   * @var FileDiscovery
   */
  private $fileDiscovery;

  /**
   * @var PluginDefinitionInterface[]
   */
  private $collectedInfo = array();

  /**
   * @var PhpAnnotationParser
   */
  private $parser;

  /**
   * @var ArgumentsResolver
   */
  private $argumentsResolver;

  /**
   * @param PluginType $pluginType
   * @param PhpAnnotationParser $parser
   * @param ArgumentsResolver $argumentsResolver
   */
  function __construct(
    PluginType $pluginType,
    PhpAnnotationParser $parser,
    ArgumentsResolver $argumentsResolver
  ) {
    $this->pluginType = $pluginType;
    $this->pluginTypePathSuffix = str_replace('\\', '/', $pluginType->getNamespaceSuffix());
    $this->fileDiscovery = new FileDiscovery();
    $this->parser = $parser;
    $this->argumentsResolver = $argumentsResolver;
  }

  /**
   * @param string $module
   *   The module machine name.
   * @param string $moduleDir
   *   The module path, without trailing slash.
   */
  function discoverModulePlugins($module, $moduleDir) {
    $dir = $moduleDir . '/src/Plugin/' . $this->pluginTypePathSuffix;
    if (!is_dir($dir)) {
      return;
    }
    $annotationName = $this->pluginType->getAnnotationName();
    $namespace = 'Drupal\\' . $module . '\Plugin\\' . $this->pluginType->getNamespaceSuffix();

    foreach ($this->fileDiscovery->discoverClassFiles($dir, $namespace) as $class => $file) {
      // Find out if this is really a plugin implementation.
      $docComment = $this->getClassDocComment($class, $file);
      foreach ($this->findClassAnnotations($docComment, $annotationName) as $id => $args) {
        $args = $this->argumentsResolver->resolveArguments($args);
        $this->collectedInfo[$id] = $this->pluginType->buildPluginDefinition($id, $class, $args);
      }
    }
  }

  /**
   * Gets the info collected crom plugin annotations.
   *
   * @return \Drupal\d8plugin\PluginDefinition\PluginDefinitionInterface[]
   *   Format: $[$pluginName] = array(..)
   */
  public function getCollectedInfo() {
    return $this->collectedInfo;
  }

  /**
   * @param string $docComment
   * @param string $annotationName
   *
   * @return array[]
   */
  private function findClassAnnotations($docComment, $annotationName) {
    $annotations = array();
    try {
      $candidates = $this->parser->parseString($docComment);
    }
    catch (ParseException $e) {
      return array();
    }
    foreach ($candidates as $candidate) {
      if (!$candidate instanceof DoctrineAnnotation) {
        continue;
      }
      if ($candidate->name !== $annotationName) {
        continue;
      }
      $args = $candidate->arguments;
      if (empty($args['id'])) {
        continue;
      }
      $id = $args['id'];
      $annotations[$id] = $args;
    }
    return $annotations;
  }

  /**
   * @param string $class
   * @param string $file
   *
   * @return string
   */
  private function getClassDocComment($class, $file) {
    $finder = new FakeClassFinder($class, $file);
    $staticReflectionParser = new StaticReflectionParser($class, $finder, true);
    $reflectionClass = $staticReflectionParser->getReflectionClass();
    return $reflectionClass->getDocComment();
  }

} 

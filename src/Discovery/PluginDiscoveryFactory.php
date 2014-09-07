<?php


namespace Drupal\d8plugin\Discovery;


use Drupal\d8plugin\Discovery\Argument\ArgumentsResolver;
use Drupal\d8plugin\PluginType;
use vektah\parser_combinator\language\php\annotation\PhpAnnotationParser;

class PluginDiscoveryFactory {

  /**
   * @var PhpAnnotationParser
   */
  private $parser;

  /**
   * @var ArgumentsResolver
   */
  private $argumentsResolver;

  /**
   * @param PhpAnnotationParser $parser
   * @param ArgumentsResolver $argumentsResolver
   */
  function __construct(PhpAnnotationParser $parser, ArgumentsResolver $argumentsResolver) {
    $this->parser = $parser;
    $this->argumentsResolver = $argumentsResolver;
  }

  /**
   * @param PluginType $pluginType
   *
   * @return PluginDiscovery
   */
  function getPluginDiscovery(PluginType $pluginType) {
    return new PluginDiscovery($pluginType, $this->parser, $this->argumentsResolver);
  }

} 

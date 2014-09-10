<?php

namespace Drupal\Tests\d8plugin;


use Drupal\d8plugin\DIC\ServiceContainer;
use Drupal\d8plugin\Discovery\Argument\ArgumentsResolver;
use Drupal\d8plugin\Discovery\FileDiscovery;
use Drupal\d8plugin\ModuleInfoCollection;
use Drupal\d8plugin_field\DIC\FieldServiceContainer;
use Drupal\d8plugin_field\Formatter\FormatterPluginManager;
use Drupal\d8plugin\PluginDefinition\PluginDefinition;
use Drupal\d8plugin\PluginType;
use Drupal\d8plugin_field\PluginDefinition\FormatterDefinition;
use Drupal\d8plugin_test_link\Plugin\Field\FieldFormatter\DomainLinkFormatter;
use Drupal\d8plugin_test_link\Plugin\Field\FieldFormatter\LinkFormatter;
use Drupal\Tests\d8plugin\Mock\MockTranslationResolver;
use vektah\parser_combinator\language\php\annotation\DoctrineAnnotation;
use vektah\parser_combinator\language\php\annotation\PhpAnnotationParser;

class DiscoveryTest extends \PHPUnit_Framework_TestCase {

  /**
   * @see FileDiscovery
   */
  function testFileDiscovery() {
    $fileDiscovery = new FileDiscovery();
    $classFiles = $fileDiscovery->discoverClassFiles(
      __DIR__ . '/ExampleClassFiles',
      'Drupal\Tests\d8plugin\ExampleClassFiles');

    $expected = array(
      'Drupal\Tests\d8plugin\ExampleClassFiles\Foo' => __DIR__ . '/ExampleClassFiles/Foo.php',
      'Drupal\Tests\d8plugin\ExampleClassFiles\LinkFormatter' => __DIR__ . '/ExampleClassFiles/LinkFormatter.php',
    );
    $this->assertEquals($expected, $classFiles);
  }

  /**
   * @see
   */
  function testVektahDoctrineAnnotationParser() {
    $docComment = <<<EOT
/**
 * Plugin implementation of the 'link' formatter.
 *
 * @FieldFormatter(
 *   id = "link",
 *   label = @Translation("Link"),
 *   field_types = {
 *     "link"
 *   }
 * )
 */
EOT;
    $parser = new PhpAnnotationParser();
    $result = $parser->parseString($docComment);
    $expected = [
      "Plugin implementation of the 'link' formatter.",
      new DoctrineAnnotation(
        'FieldFormatter',
        [
          'id' => 'link',
          'label' => new DoctrineAnnotation('Translation', ['value' => 'Link'], 6),
          'field_types' => ['link'],
        ],
        4),
    ];
    $this->assertEquals($expected, $result);
  }

  function testPluginDiscovery() {

    $pluginType = new PluginType(
      'Field\\FieldFormatter',
      'FieldFormatter',
      FormatterDefinition::getCalledClass()
    );

    $discovery = $this->getServiceContainer()->pluginDiscoveryFactory->getPluginDiscovery($pluginType);
    $discovery->discoverModulePlugins('d8plugin_test_link', dirname(__DIR__) . '/modules/link');

    $this->assertEquals(
      $this->getExpectedDefinitions(),
      $discovery->getCollectedInfo()
    );
  }

  function testPluginManagerDefinitions() {
    $this->assertEquals(
      $this->getExpectedDefinitions(),
      $this->getFormatterManager()->getDefinitions()
    );
  }

  function testPluginManagerInstance() {
    $this->assertEquals(
      new LinkFormatter(
        'd8plugin_link',
        $this->getExpectedDefinitions()['d8plugin_link']
      ),
      $this->getFormatterManager()->createInstance('d8plugin_link')
    );
  }

  /**
   * @return \Drupal\d8plugin_field\Formatter\FormatterPluginManager
   */
  private function getFormatterManager() {
    $services = $this->getServiceContainer();
    $fieldServices = new FieldServiceContainer($services);
    return $fieldServices->formatterPluginManager;
  }

  /**
   * @return array
   */
  private function getExpectedDefinitions() {
    return [
      'd8plugin_link' => new FormatterDefinition(
        'd8plugin_link',
        LinkFormatter::getCalledClass(),
        [
          'id' => 'd8plugin_link',
          'label' => "t('Link (d8plugin)')",
          'field_types' => ['link_field'],
        ]
      ),
      'd8plugin_link_domain' => new FormatterDefinition(
        'd8plugin_link_domain',
        DomainLinkFormatter::getCalledClass(),
        [
          'id' => 'd8plugin_link_domain',
          'label' => "t('Link domain (d8plugin)')",
          'field_types' => ['link_field']
        ]
      ),
    ];
  }

  /**
   * @param string[]|null $moduleDirs
   *
   * @return ServiceContainer
   */
  private function getServiceContainer(array $moduleDirs = null) {
    $container = new ServiceContainer();
    $annotationResolvers = ['Translation' => new MockTranslationResolver()];
    $container->argumentsResolver = new ArgumentsResolver($annotationResolvers);
    if (!isset($moduleDirs)) {
      $moduleDirs = [
        'd8plugin_field' => dirname(dirname(__DIR__)) . '/modules/field',
        'd8plugin_test_link' => dirname(__DIR__) . '/modules/link',
      ];
    }
    $container->participatingModules = new ModuleInfoCollection($moduleDirs);
    return $container;
  }

} 

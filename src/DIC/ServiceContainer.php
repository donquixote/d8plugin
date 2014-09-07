<?php


namespace Drupal\d8plugin\DIC;

use Drupal\d8plugin\Discovery\Argument\ArgumentsResolver;
use Drupal\d8plugin\Discovery\Argument\Resolver\TranslationResolver;
use Drupal\d8plugin\Discovery\PluginDiscoveryFactory;
use Drupal\d8plugin\Discovery\PluginInfoRegistry;
use Drupal\d8plugin\Discovery\PluginTypeRegistry;
use Drupal\d8plugin\ModuleInfoCollection;
use vektah\parser_combinator\language\php\annotation\PhpAnnotationParser;

/**
 * @property ModuleInfoCollection $participatingModules
 * @property PluginDiscoveryFactory $pluginDiscoveryFactory
 * @property PluginTypeRegistry $pluginTypeRegistry
 * @property PluginInfoRegistry $pluginInfoRegistry
 * @property ArgumentsResolver $argumentsResolver
 */
class ServiceContainer extends ServiceContainerBase {

  /**
   * @return ModuleInfoCollection
   */
  protected function get_participatingModules() {
    $moduleDirs = array();
    foreach (module_implements('pluginapi') as $module) {
      $moduleDirs[$module] = drupal_get_path('module', $module);
    }
    return new ModuleInfoCollection($moduleDirs);
  }

  /**
   * @return ArgumentsResolver
   */
  protected function get_argumentsResolver() {
    $annotationResolvers = [
      'Translation' => new TranslationResolver()
    ];
    return new ArgumentsResolver($annotationResolvers);
  }

  /**
   * @return PluginDiscoveryFactory
   */
  protected function get_pluginDiscoveryFactory() {
    $parser = new PhpAnnotationParser();
    return new PluginDiscoveryFactory($parser, $this->argumentsResolver);
  }

  /**
   * @return PluginTypeRegistry
   */
  protected function get_pluginTypeRegistry() {
    return new PluginTypeRegistry();
  }

  /**
   * @return PluginInfoRegistry
   */
  protected function get_pluginInfoRegistry() {
    return new PluginInfoRegistry(
      $this->pluginDiscoveryFactory,
      $this->participatingModules);
  }

}

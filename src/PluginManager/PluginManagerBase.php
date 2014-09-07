<?php

namespace Drupal\d8plugin\PluginManager;


use Drupal\d8plugin\Discovery\PluginInfoRegistry;
use Drupal\d8plugin\Plugin\ConfigurablePluginInterface;
use Drupal\d8plugin\Plugin\PluginInterface;
use Drupal\d8plugin\PluginType;

abstract class PluginManagerBase implements PluginManagerInterface {

  /**
   * @var PluginInfoRegistry
   */
  private $pluginInfoRegistry;

  /**
   * @param PluginInfoRegistry $pluginInfoRegistry
   */
  function __construct(PluginInfoRegistry $pluginInfoRegistry) {
    $this->pluginInfoRegistry = $pluginInfoRegistry;
  }

  /**
   * @param string $plugin_id
   * @param array $configuration
   *
   * @return PluginInterface|null
   */
  function getInstance($plugin_id, array $configuration = NULL) {
    $definition = $this->getDefinition($plugin_id);
    if (!isset($definition)) {
      return NULL;
    }
    $class = $definition->getPluginClass();
    if (!class_exists($class)) {
      return NULL;
    }
    $plugin = new $class($plugin_id, $definition);
    if ($plugin instanceof ConfigurablePluginInterface && isset($configuration)) {
      $plugin->setConfiguration($configuration);
    }
    elseif (!$plugin instanceof PluginInterface) {
      return NULL;
    }
    return $plugin;
  }

  /**
   * @param $plugin_id
   *
   * @return \Drupal\d8plugin\PluginDefinition\PluginDefinitionInterface|null
   */
  function getDefinition($plugin_id) {
    $definitions = $this->getDefinitions();
    return isset($definitions[$plugin_id])
      ? $definitions[$plugin_id]
      : NULL;
  }

  /**
   * @return \Drupal\d8plugin\PluginDefinition\PluginDefinitionInterface[]
   */
  function getDefinitions() {
    $pluginType = $this->getPluginType();
    return $this->pluginInfoRegistry->getPluginDefinitions($pluginType);
  }

  /**
   * @return PluginType
   */
  protected abstract function getPluginType();

}

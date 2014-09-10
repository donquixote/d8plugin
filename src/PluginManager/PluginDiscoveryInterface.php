<?php


namespace Drupal\d8plugin\PluginManager;

use Drupal\d8plugin\PluginDefinition\PluginDefinitionInterface;

interface PluginDiscoveryInterface {

  /**
   * Gets the plugin definition for the given plugin id.
   *
   * @param string $plugin_id
   *
   * @return PluginDefinitionInterface|null
   */
  function getDefinition($plugin_id);

  /**
   * Gets all available plugin definitions for this plugin type.
   *
   * @return PluginDefinitionInterface[]
   */
  function getDefinitions();

} 

<?php


namespace Drupal\d8plugin\PluginManager;

use Drupal\d8plugin\Plugin\ConfigurablePluginInterface;

interface PluginFactoryInterface {

  /**
   * Creates a plugin for the given plugin id and configuration.
   *
   * @param string $plugin_id
   * @param array $configuration
   *
   * @return ConfigurablePluginInterface|null
   */
  function createInstance($plugin_id, array $configuration = array());

} 

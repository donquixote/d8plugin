<?php


namespace Drupal\d8plugin\PluginManager;


interface PluginFactoryInterface {

  /**
   * Creates a plugin for the given plugin id and configuration.
   *
   * @param string $plugin_id
   * @param array $configuration
   *
   * @return \Drupal\d8plugin\Plugin\PluginInterface|null
   */
  function createInstance($plugin_id, array $configuration = array());

} 

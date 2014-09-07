<?php


namespace Drupal\d8plugin\PluginManager;


use Drupal\d8plugin\Plugin\ConfigurablePluginInterface;

interface PluginManagerInterface {

  /**
   * @param string $plugin_id
   * @param array $configuration
   *
   * @return ConfigurablePluginInterface|null
   */
  function getInstance($plugin_id, array $configuration = array());

  /**
   * @param $plugin_id
   *
   * @return \Drupal\d8plugin\PluginDefinition\PluginDefinitionInterface|null
   */
  function getDefinition($plugin_id);

  /**
   * @return \Drupal\d8plugin\PluginDefinition\PluginDefinitionInterface[]
   */
  function getDefinitions();

} 

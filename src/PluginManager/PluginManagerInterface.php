<?php


namespace Drupal\d8plugin\PluginManager;


use Drupal\d8plugin\Plugin\ConfigurablePluginInterface;
use Drupal\d8plugin\PluginDefinition\PluginDefinitionInterface;

interface PluginManagerInterface {

  /**
   * @param string $plugin_id
   * @param array $configuration
   *
   * @return ConfigurablePluginInterface|null
   */
  function getInstance($plugin_id, array $configuration = array());

  /**
   * @param string $plugin_id
   *
   * @return PluginDefinitionInterface|null
   */
  function getDefinition($plugin_id);

  /**
   * @return PluginDefinitionInterface[]
   */
  function getDefinitions();

} 

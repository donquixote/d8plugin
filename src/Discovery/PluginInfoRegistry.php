<?php


namespace Drupal\d8plugin\Discovery;


use Drupal\d8plugin\ModuleInfoCollection;
use Drupal\d8plugin\PluginDefinition\PluginDefinitionInterface;
use Drupal\d8plugin\PluginType;

class PluginInfoRegistry {

  /**
   * @var PluginDiscoveryFactory
   */
  private $pluginDiscoveryFactory;

  /**
   * @var ModuleInfoCollection
   */
  private $participatingModules;

  /**
   * @param PluginDiscoveryFactory $pluginDiscoveryFactory
   * @param ModuleInfoCollection $participatingModules
   */
  function __construct(
    PluginDiscoveryFactory $pluginDiscoveryFactory,
    ModuleInfoCollection $participatingModules
  ) {
    $this->pluginDiscoveryFactory = $pluginDiscoveryFactory;
    $this->participatingModules = $participatingModules;
  }

  /**
   * @param PluginType $pluginType
   *
   * @return \Drupal\d8plugin\PluginDefinition\PluginDefinitionInterface[]
   *   Format: $[$pluginName] = $pluginDefinition
   */
  function getPluginDefinitions($pluginType) {
    $pluginDiscovery = $this->pluginDiscoveryFactory->getPluginDiscovery($pluginType);
    foreach ($this->participatingModules->getModuleDirs() as $module => $moduleDir) {
      $pluginDiscovery->discoverModulePlugins($module, $moduleDir);
    }
    return $pluginDiscovery->getCollectedInfo();
  }

  /**
   * Gets the definition for a specific plugin.
   *
   * @param PluginType $pluginType
   * @param string $pluginName
   *
   * @return PluginDefinitionInterface
   */
  function getPluginDefinition(Plugintype $pluginType, $pluginName) {
    $definitions = $this->getPluginDefinitions($pluginType);
    if (isset($definitions[$pluginName])) {
      return $definitions[$pluginName];
    }
    return NULL;
  }

} 

<?php


namespace Drupal\d8plugin_filter;

use Drupal\d8plugin\PluginManager\PluginManagerBase;
use Drupal\d8plugin\PluginType;
use Drupal\d8plugin_filter\FilterPlugin\FilterInterface;
use Drupal\d8plugin_filter\PluginDefinition\FilterDefinition;

class FilterPluginManager extends PluginManagerBase {

  /**
   * @param string $plugin_id
   * @param array $configuration
   *
   * @return FilterInterface|null
   */
  public function getInstance($plugin_id, array $configuration = NULL) {
    $plugin = parent::getInstance($plugin_id, $configuration);
    return $plugin instanceof FilterInterface
      ? $plugin
      : NULL;
  }

  /**
   * @param string $plugin_id
   *
   * @return FilterDefinition|null
   */
  function getDefinition($plugin_id) {
    return parent::getDefinition($plugin_id);
  }

  /**
   * @return FilterDefinition[]
   */
  function getDefinitions() {
    return parent::getDefinitions();
  }

  /**
   * @return PluginType
   */
  protected function getPluginType() {
    return new PluginType('Filter', 'Filter', FilterDefinition::getCalledClass());
  }

}

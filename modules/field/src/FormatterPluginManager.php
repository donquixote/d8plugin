<?php


namespace Drupal\d8plugin_field;

use Drupal\d8plugin\PluginManager\PluginManagerBase;
use Drupal\d8plugin\PluginType;

class FormatterPluginManager extends PluginManagerBase {

  /**
   * @param string $plugin_id
   * @param array $configuration
   *
   * @return FormatterInterface|null
   */
  function getInstance($plugin_id, array $configuration = NULL) {
    $plugin = parent::getInstance($plugin_id, $configuration);
    return $plugin instanceof FormatterInterface
      ? $plugin
      : $plugin;
  }

  /**
   * @return PluginType
   */
  protected function getPluginType() {
    return new PluginType('Field\\FieldFormatter', 'FieldFormatter');
  }

}

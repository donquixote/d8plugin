<?php


namespace Drupal\d8plugin_field\Formatter;

use Drupal\d8plugin\PluginManager\PluginManagerBase;
use Drupal\d8plugin\PluginType;
use Drupal\d8plugin_field\PluginDefinition\FormatterDefinition;

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
      : NULL;
  }

  /**
   * @param string $plugin_id
   *
   * @return FormatterDefinition|null
   */
  function getDefinition($plugin_id) {
    return parent::getDefinition($plugin_id);
  }

  /**
   * @return FormatterDefinition[]
   */
  function getDefinitions() {
    return parent::getDefinitions();
  }

  /**
   * @return PluginType
   */
  protected function getPluginType() {
    return new PluginType(
      'Field\\FieldFormatter',
      'FieldFormatter',
      FormatterDefinition::getCalledClass());
  }

}

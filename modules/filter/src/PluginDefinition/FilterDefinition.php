<?php

namespace Drupal\d8plugin_filter\PluginDefinition;

use Drupal\d8plugin\PluginDefinition\LabeledPluginDefinition;
use Drupal\d8plugin_filter\FilterPlugin\FilterPrepareInterface;

/**
 * Plugin definition for FieldFormatter plugins, extracted from doc annotation.
 */
class FilterDefinition extends LabeledPluginDefinition {

  /**
   * Gets the info array for this plugin for the field formatter info hook.
   *
   * @see hook_field_formatter_info()
   * @see d8plugin_field_field_formatter_info()
   *
   * @return array
   */
  function getInfo() {
    $info = $this->getArgs();
    return $info;
  }

  /**
   * @return bool
   */
  function hasPrepare() {
    $class = $this->getPluginClass();
    return $class instanceof FilterPrepareInterface;
  }

} 

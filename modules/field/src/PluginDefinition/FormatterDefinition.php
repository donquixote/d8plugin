<?php

namespace Drupal\d8plugin_field\PluginDefinition;

use Drupal\d8plugin\PluginDefinition\LabeledPluginDefinition;
use Drupal\d8plugin_field\Formatter\FormatterPrepareViewInterface;

/**
 * Plugin definition for FieldFormatter plugins, extracted from doc annotation.
 */
class FormatterDefinition extends LabeledPluginDefinition {

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
    $info += [
      'field types' => isset($info['field_types'])
        ? $info['field_types']
        : [],
    ];
    return $info;
  }

  /**
   * @return bool
   */
  function hasPrepareView() {
    $class = $this->getPluginClass();
    return $class instanceof FormatterPrepareViewInterface;
  }

} 

<?php


namespace Drupal\d8plugin\PluginDefinition;

/**
 * Plugin definition with label and description.
 */
class LabeledPluginDefinition extends PluginDefinition implements PluginLabelInterface, PluginDescriptionInterface {
  use PluginLabelTrait;
  use PluginDescriptionTrait;

  /**
   * Set special properties. Override if needed.
   *
   * @param array $args
   */
  protected function initArguments(array $args) {
    // Do nothing by default.
    $this->initLabel($args);
    $this->initDescription($args);
  }

}

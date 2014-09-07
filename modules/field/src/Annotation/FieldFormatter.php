<?php

namespace Drupal\d8plugin_field\Annotation;

use Drupal\d8plugin\PluginDefinition\PluginDescriptionTrait;
use Drupal\d8plugin\PluginDefinition\PluginLabelInterface;
use Drupal\d8plugin\PluginDefinition\PluginLabelTrait;
use Drupal\d8plugin\PluginDefinition\PluginDefinition;
use Drupal\d8plugin\PluginDefinition\PluginDefinitionInterface;

/**
 * Defines a FieldFormatter annotation object.
 *
 * Formatters handle the display of field values. They are typically
 * instantiated and invoked by an EntityDisplay object.
 *
 * Additional annotation keys for formatters can be defined in
 * hook_field_formatter_info_alter().
 *
 * @Annotation
 *
 * @see \Drupal\Core\Field\FormatterPluginManager
 * @see \Drupal\Core\Field\FormatterInterface
 *
 * @ingroup field_formatter
 */
class FieldFormatter extends PluginDefinition implements PluginDefinitionInterface, PluginLabelInterface {
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

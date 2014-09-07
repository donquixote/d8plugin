<?php

namespace Drupal\d8plugin_field;

use Drupal\d8plugin_field\FieldInfo\EntityTypeFieldInterface;
use Drupal\d8plugin_field\FieldInfo\ViewModeFieldDisplayFormContextInterface;
use Drupal\d8plugin_field\FieldInfo\ViewModeFieldDisplayInterface;
use Drupal\d8plugin\Plugin\ConfigurablePluginTrait;
use Drupal\d8plugin\Plugin\PluginBase;

abstract class FormatterBase extends PluginBase implements FormatterInterface {
  use ConfigurablePluginTrait;

  /**
   * {@inheritdoc}
   */
  public function settingsForm(ViewModeFieldDisplayFormContextInterface $context) {
    // By default, return an empty string.
    return array();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary(ViewModeFieldDisplayInterface $context) {
    // By default, return an empty string.
    return '';
  }

  /**
   * {@inheritdoc}
   */
  public function prepareView(array $entities_items, EntityTypeFieldInterface $entity_type_field) {
    // By default, do not alter the items.
  }

}

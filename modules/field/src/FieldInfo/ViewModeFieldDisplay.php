<?php


namespace Drupal\d8plugin_field\FieldInfo;

/**
 * Argument wrapper for
 * @see \Drupal\d8plugin_field\FormatterInterface::settingsSummary()
 */
class ViewModeFieldDisplay extends FieldDisplay implements ViewModeFieldDisplayInterface {

  /**
   * @var string
   */
  private $viewMode;

  /**
   * @param string $entity_type
   * @param array $field
   * @param array $instance
   * @param string $view_mode
   */
  public function __construct($entity_type, $field, $instance, $view_mode) {
    $display = $instance['display'][$view_mode];
    $this->viewMode = $view_mode;
    parent::__construct($entity_type, $field, $instance, $display);
  }

  /**
   * Gets the view mode name.
   *
   * @return string
   */
  public function getViewMode() {
    return $this->viewMode;
  }

}

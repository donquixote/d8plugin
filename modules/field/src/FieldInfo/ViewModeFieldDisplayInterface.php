<?php


namespace Drupal\d8plugin_field\FieldInfo;

/**
 * Wraps the parameters of @see hook_field_formatter_settings_summary()
 *
 * Also acts as a parent interface for @see FieldUIFormContextInterface
 */
interface ViewModeFieldDisplayInterface extends FieldDisplayInterface {

  /**
   * Gets the view mode name.
   *
   * @return string
   */
  public function getViewMode();

} 

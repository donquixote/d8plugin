<?php


namespace Drupal\d8plugin_field\FieldInfo;

/**
 * Wraps the arguments for @see hook_field_formatter_settings_form()
 */
interface ViewModeFieldDisplayFormContextInterface extends ViewModeFieldDisplayInterface {

  /**
   * Gets the form array.
   *
   * @return array
   */
  public function getForm();

  /**
   * Gets the form state array, by reference.
   *
   * @return array
   */
  public function &getFormState();

} 

<?php


namespace Drupal\d8plugin_field\Formatter\Context;

use Drupal\d8plugin_field\FieldInfo\ViewModeFieldDisplay;
use Drupal\d8plugin_field\Formatter\Context\ViewModeFieldDisplayFormContextInterface;

/**
 * Argument wrapper for
 * @see \Drupal\d8plugin_field\FormatterInterface::settingsForm()
 */
class ViewModeFieldDisplayFormContext extends ViewModeFieldDisplay implements ViewModeFieldDisplayFormContextInterface {

  /**
   * @var array
   */
  private $form;

  /**
   * @var array
   */
  private $formState;

  /**
   * @param string $entity_type
   * @param array $field
   * @param array $instance
   * @param string $view_mode
   * @param array $form
   * @param array $form_state
   */
  public function __construct($entity_type, $field, $instance, $view_mode, $form, &$form_state) {
    parent::__construct($entity_type, $field, $instance, $view_mode);
    $this->form = $form;
    $this->formState = &$form_state;
  }

  /**
   * Gets the form array.
   *
   * @return array
   */
  public function getForm() {
    return $this->form;
  }

  /**
   * Gets the form state array, by reference.
   *
   * @return array
   */
  public function &getFormState() {
    return $this->formState;
  }
}

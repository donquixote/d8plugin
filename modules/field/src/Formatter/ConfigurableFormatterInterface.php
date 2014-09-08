<?php


namespace Drupal\d8plugin_field\Formatter;


use Drupal\d8plugin\Plugin\ConfigurablePluginInterface;
use Drupal\d8plugin_field\FieldInfo\ViewModeFieldDisplayFormContextInterface;
use Drupal\d8plugin_field\FieldInfo\ViewModeFieldDisplayInterface;

interface ConfigurableFormatterInterface extends FormatterInterface, ConfigurablePluginInterface {

  /**
   * Returns a form to configure settings for the formatter.
   *
   * Invoked from \Drupal\field_ui\Form\FieldInstanceEditForm to allow
   * administrators to configure the formatter. The field_ui module takes care
   * of handling submitted form values.
   *
   * @param ViewModeFieldDisplayFormContextInterface $context
   *
   * @return array
   *   The form elements for the formatter settings.
   *
   * @see hook_field_formatter_settings_form
   */
  public function settingsForm(ViewModeFieldDisplayFormContextInterface $context);

  /**
   * Returns a short summary for the current formatter settings.
   *
   * If an empty result is returned, a UI can still be provided to display
   * a settings form in case the formatter has configurable settings.
   *
   * @param ViewModeFieldDisplayInterface $context
   *
   * @return string
   *   A short summary of the formatter settings.
   *
   * @see hook_field_formatter_settings_summary()
   */
  public function settingsSummary(ViewModeFieldDisplayInterface $context);

} 

<?php

namespace Drupal\d8plugin_filter;

use Drupal\d8plugin\Plugin\PluginBase;

class FilterBase extends PluginBase implements FilterInterface {

  /**
   * Generates a filter's settings form.
   *
   * @param array $form
   *   A minimally prepopulated form array.
   * @param array $form_state
   *   The state of the (entire) configuration form.
   *
   * @return array
   *   The $form array with additional form elements for the settings of this
   *   filter. The submitted form values should match $this->settings.
   *
   * @see callback_filter_settings()
   */
  public function settingsForm(array $form, array &$form_state) {
    // By default, return an empty form with no settings.
  }

  /**
   * Prepares the text for processing.
   *
   * Filters should not use the prepare method for anything other than escaping,
   * because that would short-circuit the control the user has over the order in
   * which filters are applied.
   *
   * @param string $text
   *   The text string to be filtered.
   * @param string $langcode
   *   The language code of the text to be filtered.
   *
   * @return string
   *   The prepared, escaped text.
   *
   * @see callback_filter_prepare()
   */
  public function prepare($text, $langcode) {
    // By default, don't modify anything.
    return $text;
  }

  /**
   * Performs the filter processing.
   *
   * @param string $text
   *   The text string to be filtered.
   * @param string $langcode
   *   The language code of the text to be filtered.
   *
   * @return string
   *   The filtered text.
   *
   * @see \Drupal\filter\FilterProcessResult
   */
  public function process($text, $langcode) {
    // TODO: Implement process() method.
  }

  /**
   * Generates a filter's tip.
   *
   * A filter's tips should be informative and to the point. Short tips are
   * preferably one-liners.
   *
   * @param bool $long
   *   Whether this callback should return a short tip to display in a form
   *   (FALSE), or whether a more elaborate filter tips should be returned for
   *   template_preprocess_filter_tips() (TRUE).
   *
   * @return string|null
   *   Translated text to display as a tip, or NULL if this filter has no tip.
   */
  public function tips($long = FALSE) {
    // TODO: Implement tips() method.
  }

  /**
   * Defines the default settings for this plugin.
   *
   * @return array
   *   A list of default settings, keyed by the setting name.
   */
  public static function defaultSettings() {
    // TODO: Implement defaultSettings() method.
  }

  /**
   * Returns the array of settings, including defaults for missing settings.
   *
   * @return array
   *   The array of settings.
   */
  public function getSettings() {
    // TODO: Implement getSettings() method.
  }

  /**
   * Returns the value of a setting, or its default value if absent.
   *
   * @param string $key
   *   The setting name.
   *
   * @return mixed
   *   The setting value.
   */
  public function getSetting($key) {
    // TODO: Implement getSetting() method.
  }

  /**
   * Sets the settings for the plugin.
   *
   * @param array $settings
   *   The array of settings, keyed by setting names. Missing settings will be
   *   assigned their default values.
   *
   * @return $this
   */
  public function setSettings(array $settings) {
    // TODO: Implement setSettings() method.
  }

  /**
   * Sets the value of a setting for the plugin.
   *
   * @param string $key
   *   The setting name.
   * @param mixed $value
   *   The setting value.
   *
   * @return $this
   */
  public function setSetting($key, $value) {
    // TODO: Implement setSetting() method.
  }

  /**
   * Returns the value of a third-party setting, or $default if not set.
   *
   * @param string $module
   *   The module providing the third-party setting.
   * @param string $key
   *   The setting name.
   * @param mixed $default
   *   (optional) The default value if the third party setting is not set.
   *   Defaults to NULL.
   *
   * @return mixed|NULL
   *   The setting value. Returns NULL if the setting does not exist and
   *   $default is not provided.
   */
  public function getThirdPartySetting($module, $key, $default = NULL) {
    // TODO: Implement getThirdPartySetting() method.
  }

  /**
   * Sets the value of a third-party setting for the plugin.
   *
   * @param string $module
   *   The module providing the third-party setting.
   * @param string $key
   *   The setting name.
   * @param mixed $value
   *   The setting value.
   *
   * @return $this
   */
  public function setThirdPartySetting($module, $key, $value) {
    // TODO: Implement setThirdPartySetting() method.
  }
}

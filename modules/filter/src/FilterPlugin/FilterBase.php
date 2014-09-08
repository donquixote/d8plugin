<?php

namespace Drupal\d8plugin_filter\FilterPlugin;

use Drupal\d8plugin\Plugin\ConfigurablePluginTrait;
use Drupal\d8plugin\Plugin\PluginBase;
use Drupal\d8plugin_filter\FilterPlugin\FilterInterface;

abstract class FilterBase extends PluginBase implements FilterInterface {

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

}

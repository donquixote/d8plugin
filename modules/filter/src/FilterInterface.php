<?php

namespace Drupal\d8plugin_filter;

use Drupal\d8plugin\Plugin\PluginSettingsInterface;

interface FilterInterface extends PluginSettingsInterface {

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
  public function settingsForm(array $form, array &$form_state);

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
  public function prepare($text, $langcode);

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
  public function process($text, $langcode);

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
  public function tips($long = FALSE);

} 

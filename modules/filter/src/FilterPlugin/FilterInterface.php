<?php

namespace Drupal\d8plugin_filter\FilterPlugin;

use Drupal\d8plugin\Plugin\PluginInterface;

interface FilterInterface extends PluginInterface {

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

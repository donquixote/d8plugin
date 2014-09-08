<?php


namespace Drupal\d8plugin_filter\FilterPlugin;


interface FilterPrepareInterface extends FilterInterface {

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

} 

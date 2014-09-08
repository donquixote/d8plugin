<?php


namespace Drupal\d8plugin_test_filter\Plugin\Filter;

use Drupal\d8plugin_filter\FilterPlugin\FilterInterface;

/**
 * Provides a test filter to replace all content.
 *
 * @Filter(
 *   id = "filter_test_replace",
 *   title = @Translation("Testing filter (d8plugin)"),
 *   description = @Translation("Replaces all content with filter and text format information.")
 * )
 */
class FilterTestReplace implements FilterInterface {

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
    $text = array();
    $text[] = 'Filter: ' . t('Testing filter') . ' (filter_test_replace)';
    $text[] = 'Language: ' . $langcode;
    return implode("<br />\n", $text);
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
    return null;
  }
}

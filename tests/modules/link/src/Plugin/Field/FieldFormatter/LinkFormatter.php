<?php


namespace Drupal\d8plugin_test_link\Plugin\Field\FieldFormatter;


use Drupal\d8plugin_field\FormatterBase;
use Drupal\d8plugin_field\ItemList\FieldItemListInterface;

/**
 * Plugin implementation of the 'link' formatter.
 *
 * @FieldFormatter(
 *   id = "d8plugin_link",
 *   label = @Translation("Link (d8plugin)"),
 *   field_types = {
 *     "link_field"
 *   }
 * )
 */
class LinkFormatter extends FormatterBase {

  /**
   * Builds a renderable array for a fully themed field.
   *
   * @param FieldItemListInterface $items
   *   The field values to be rendered.
   *   Also provides the entity and the context.
   *
   * @return array
   *   A renderable array for a themed field with its label and all its values.
   *
   * @see hook_field_formatter_view()
   */
  public function view(FieldItemListInterface $items) {
    $elements = array();
    foreach ($items as $delta => $item) {
      $elements[$delta] = array(
        '#theme' => 'link_formatter_' . $this->getPluginId(),
        '#element' => $item,
        '#field' => $items->getFieldInstance(),
        '#display' => $items->getDisplay(),
      );
    }
    return $elements;
  }

}

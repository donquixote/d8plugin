<?php


namespace Drupal\d8plugin_test_link\Plugin\Field\FieldFormatter;


use Drupal\d8plugin_field\Formatter\Context\FormatterPrepareViewContextInterface;
use Drupal\d8plugin_field\Formatter\Context\FormatterViewContextInterface;
use Drupal\d8plugin_field\Formatter\FormatterBase;
use Drupal\d8plugin_field\Formatter\FormatterPrepareViewInterface;

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
class LinkFormatter extends FormatterBase implements FormatterPrepareViewInterface {

  /**
   * Allows formatters to load information for field values being displayed.
   *
   * This should be used when a formatter needs to load additional information
   * from the database in order to render a field, for example a reference
   * field that displays properties of the referenced entities such as name or
   * type.
   *
   * This method operates on multiple entities. The $entities_items parameter
   * is an array keyed by entity ID. For performance reasons, information for
   * all involved entities should be loaded in a single query where possible.
   *
   * Changes or additions to field values are done by directly altering the
   * items.
   *
   * @param array $items_grouped
   * @param FormatterPrepareViewContextInterface $context
   *
   * @see hook_field_formatter_prepare_view()
   * @see PrepareViewHandler
   */
  public function prepareView(array &$items_grouped, FormatterPrepareViewContextInterface $context) {
    dpm($items_grouped);
  }

  /**
   * Builds a renderable array for a fully themed field.
   *
   * @param array $items
   * @param FormatterViewContextInterface $context
   *   The field values to be rendered.
   *   Also provides the entity and the context.
   *
   * @return array
   *   A renderable array for a themed field with its label and all its values.
   *
   * @see hook_field_formatter_view()
   */
  public function view(array $items, FormatterViewContextInterface $context) {
    $themeHook = $this->getThemeHook();
    $elements = array();
    foreach ($context as $delta => $item) {
      $elements[$delta] = array(
        '#theme' => $themeHook,
        '#element' => $item,
        '#field' => $context->getFieldInstance(),
        '#display' => $context->getDisplay(),
      );
    }
    return $elements;
  }

  /**
   * @return string
   */
  protected function getThemeHook() {
    $pluginId = $this->getPluginId();
    if ('d8plugin_link' === $pluginId) {
      return 'link_formatter_link_default';
    }
    return 'link_formatter_' . substr($this->getPluginId(), 9);
  }

}

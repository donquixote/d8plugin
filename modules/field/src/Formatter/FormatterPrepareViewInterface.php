<?php


namespace Drupal\d8plugin_field\Formatter;

use Drupal\d8plugin_field\Formatter\Context\FormatterPrepareViewContextInterface;

interface FormatterPrepareViewInterface extends FormatterInterface {

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
   * @param array[][] $items_grouped
   * @param FormatterPrepareViewContextInterface $context
   *
   * @see hook_field_formatter_prepare_view()
   * @see PrepareViewHandler
   */
  public function prepareView(array &$items_grouped, FormatterPrepareViewContextInterface $context);

} 

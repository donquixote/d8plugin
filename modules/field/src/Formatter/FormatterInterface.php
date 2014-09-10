<?php

namespace Drupal\d8plugin_field\Formatter;

use Drupal\d8plugin\Plugin\PluginInterface;
use Drupal\d8plugin_field\Formatter\Context\FormatterViewContextInterface;

/**
 * Interface definition for field formatter plugins.
 *
 * @ingroup field_formatter
 */
interface FormatterInterface extends PluginInterface {

  /**
   * Builds a renderable array for a fully themed field.
   *
   * @param array[] $items
   * @param FormatterViewContextInterface $context
   *   The field values to be rendered.
   *   Also provides the entity and the context.
   *
   * @return array
   *   A renderable array for a themed field with its label and all its values.
   *
   * @see hook_field_formatter_view()
   */
  public function view(array $items, FormatterViewContextInterface $context);

} 

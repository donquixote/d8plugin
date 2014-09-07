<?php


namespace Drupal\d8plugin_field\FieldInfo;

/**
 * Wraps some of the arguments of
 * - @see hook_field_formatter_view().
 * - @see hook_field_formatter_prepare_view().
 * to pass them to
 * - @see FormatterInterface::view()
 * - @see FormatterInterface::prepareView()
 *
 * Also acts as a base interface for @see FieldUIContextInterface.
 */
interface EntityTypeFieldInterface {

  /**
   * Gets the entity type.
   *
   * @return string
   */
  public function getEntityType();

  /**
   * @return string
   *   The field name.
   */
  public function getFieldName();

  /**
   * Gets the field definition array.
   *
   * @return array
   */
  public function getField();

} 

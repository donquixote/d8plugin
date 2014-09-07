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
interface FieldInstanceInterface extends EntityTypeFieldInterface {

  /**
   * Gets the field instance definition array.
   *
   * @return array
   */
  public function getFieldInstance();

} 

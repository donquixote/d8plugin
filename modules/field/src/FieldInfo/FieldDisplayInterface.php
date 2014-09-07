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
interface FieldDisplayInterface extends FieldInstanceInterface {

  /**
   * Gets the display settings for this view mode.
   *
   * @return array
   */
  public function getDisplay();

  /**
   * Gets the formatter settings.
   *
   * @return array
   */
  public function getFormatterSettings();

  /**
   * Gets a specific formatter setting.
   *
   * @param string $key
   * @param mixed $default
   *   The default value to return if
   *
   * @return mixed
   */
  public function getFormatterSetting($key, $default = NULL);

} 

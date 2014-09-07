<?php


namespace Drupal\d8plugin_field\FieldInfo;


class FieldDisplay extends FieldInstance implements FieldDisplayInterface {

  /**
   * @var array
   */
  private $display;

  /**
   * @param string $entity_type
   * @param array $field
   * @param array $instance
   * @param array $display
   */
  public function __construct($entity_type, $field, $instance, $display) {
    parent::__construct($entity_type, $field, $instance);
    $this->display = $display;
  }

  /**
   * Gets the display settings for this view mode.
   *
   * @return array
   */
  public function getDisplay() {
    return $this->display;
  }

  /**
   * Gets the formatter settings.
   *
   * @return array
   */
  public function getFormatterSettings() {
    return $this->display['settings'];
  }

  /**
   * Gets a specific formatter setting.
   *
   * @param string $key
   * @param mixed $default
   *   The default value to return if
   *
   * @return mixed
   */
  public function getFormatterSetting($key, $default = NULL) {
    return isset($this->display['settings'][$key])
      ? $this->display['settings'][$key]
      : $default;
  }
}

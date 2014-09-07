<?php


namespace Drupal\d8plugin_field\FieldInfo;


class FieldInstance extends EntityTypeField implements FieldInstanceInterface {

  /**
   * @var array
   */
  private $instance;

  /**
   * @param string $entity_type
   * @param array $field
   * @param array $instance
   */
  public function __construct($entity_type, $field, $instance) {
    parent::__construct($entity_type, $field);
    $this->instance = $instance;
  }

  /**
   * Gets the field instance definition array.
   *
   * @return array
   */
  public function getFieldInstance() {
    return $this->instance;
  }

}

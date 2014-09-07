<?php


namespace Drupal\d8plugin_field\FieldInfo;

/**
 * Wrapper for some of the arguments for field API hooks.
 */
class EntityTypeField implements EntityTypeFieldInterface {

  /**
   * @var string
   */
  private $entityType;

  /**
   * @var array
   */
  private $field;

  /**
   * @param string $entity_type
   * @param array $field
   */
  public function __construct($entity_type, array $field) {
    $this->entityType = $entity_type;
    $this->field = $field;
  }

  /**
   * Gets the entity type.
   *
   * @return string
   */
  public function getEntityType() {
    return $this->entityType;
  }

  /**
   * @return string
   *   The field name.
   */
  public function getFieldName() {
    return $this->field['field_name'];
  }

  /**
   * Gets the field definition array.
   *
   * @return array
   */
  public function getField() {
    return $this->field;
  }
}

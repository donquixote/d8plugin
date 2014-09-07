<?php


namespace Drupal\d8plugin_field\ItemList;


use Drupal\d8plugin_field\FieldInfo\FieldDisplayInterface;

/**
 * Abstract base class for
 * @see FieldItemlist
 * @see AlterableFieldItemList
 */
abstract class FieldItemListBase implements FieldItemListInterface {

  /**
   * @var object
   */
  private $entity;

  /**
   * @var FieldDisplayInterface
   */
  private $context;

  /**
   * @var string
   */
  private $langcode;

  /**
   * @param object $entity
   * @param FieldDisplayInterface $context
   * @param string $langcode
   */
  public function __construct($entity, FieldDisplayInterface $context, $langcode) {
    $this->entity = $entity;
    $this->context = $context;
    $this->langcode = $langcode;
  }

  /**
   * Gets the entity that field belongs to.
   *
   * @return object|\Entity
   *   The entity object.
   */
  public function getEntity() {
    return $this->entity;
  }

  /**
   * Gets the langcode of the field values held in the object.
   *
   * @return string $langcode
   *   The langcode.
   */
  public function getLangcode() {
    return $this->langcode;
  }

  /**
   * Gets the entity type.
   *
   * @return string
   */
  public function getEntityType() {
    return $this->context->getEntityType();
  }

  /**
   * @return string
   *   The field name.
   */
  public function getFieldName() {
    return $this->context->getFieldName();
  }

  /**
   * Gets the field definition.
   *
   * @return array
   *   The field definition.
   */
  public function getField() {
    return $this->context->getField();
  }

  /**
   * Gets the field instance definition.
   *
   * @return array
   *   The field instance definition.
   */
  public function getFieldInstance() {
    return $this->context->getFieldInstance();
  }

  /**
   * Gets the display settings for this view mode.
   *
   * @return array
   */
  public function getDisplay() {
    return $this->context->getDisplay();
  }

  /**
   * Gets the formatter settings.
   *
   * @return array
   */
  public function getFormatterSettings() {
    return $this->context->getFormatterSettings();
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
    return $this->context->getFormatterSetting($key, $default);
  }

}

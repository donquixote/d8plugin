<?php


namespace Drupal\d8plugin_field\Formatter\Context;


use Drupal\d8plugin_field\FieldInfo\EntityTypeField;
use Drupal\d8plugin_field\FieldInfo\FieldDisplay;

class FormatterPrepareViewContext extends EntityTypeField implements FormatterPrepareViewContextInterface {

  /**
   * @var FormatterViewContext[]
   */
  private $byEntity = array();

  /**
   * @var object[]
   */
  private $entities;

  /**
   * @var array[]
   */
  private $instances;

  /**
   * @var array[]
   */
  private $displays;

  /**
   * @var string
   */
  private $langcode;

  /**
   * @param string $entity_type
   * @param object[] $entities
   * @param array $field
   * @param array[] $instances
   * @param string $langcode
   * @param array[] $displays
   */
  function __construct($entity_type, $entities, $field, $instances, $langcode, $displays) {
    parent::__construct($entity_type, $field);
    $this->entities = $entities;
    $this->instances = $instances;
    $this->displays = $displays;
    $this->langcode = $langcode;
  }

  /**
   * @param int $entityId
   *
   * @return object
   */
  function getEntity($entityId) {
    return $this->entities[$entityId];
  }

  /**
   * @param int $entityId
   *
   * @return array
   */
  function getInstance($entityId) {
    return $this->instances[$entityId];
  }

  /**
   * @param int $entityId
   *
   * @return array
   */
  function getDisplay($entityId) {
    return $this->displays[$entityId];
  }

  /**
   * @param int $entityId
   *
   * @return mixed
   */
  function getSettings($entityId) {
    return $this->displays[$entityId]['settings'];
  }

  /**
   * @return string
   */
  function getLangcode() {
    return $this->langcode;
  }

  /**
   * @param int $entityId
   *
   * @return bool
   *   TRUE on success or FALSE on failure.
   *   The return value will be casted to boolean if non-boolean was returned.
   */
  public function offsetExists($entityId) {
    return isset($this->entities[$entityId]);
  }

  /**
   * @param int $entityId
   *
   * @return mixed Can return all value types.
   */
  public function offsetGet($entityId) {
    return isset($this->byEntity[$entityId])
      ? $this->byEntity[$entityId]
      : $this->byEntity[$entityId] = new FormatterViewContext(
        $this->entities[$entityId],
        new FieldDisplay(
          $this->getEntityType(),
          $this->getField(),
          $this->instances[$entityId],
          $this->displays[$entityId]),
        $this->langcode);
  }

  /**
   * @param mixed $offset
   * @param mixed $value
   *
   * @throws \Exception
   */
  public function offsetSet($offset, $value) {
    throw new \Exception("offsetSet() not supported.");
  }

  /**
   * @param mixed $offset
   *
   * @throws \Exception
   */
  public function offsetUnset($offset) {
    throw new \Exception("offsetUnset() not supported.");
}}

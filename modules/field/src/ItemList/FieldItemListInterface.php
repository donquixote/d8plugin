<?php

namespace Drupal\d8plugin_field\ItemList;

use Drupal\d8plugin_field\FieldInfo\FieldDisplayInterface;

/**
 * Interface for fields, being lists of field items.
 *
 * This interface must be implemented by every entity field, whereas contained
 * field items must implement the FieldItemInterface.
 * Some methods of the fields are delegated to the first contained item, in
 * particular get() and set() as well as their magic equivalences.
 *
 * Optionally, a typed data object implementing
 * Drupal\Core\TypedData\TypedDataInterface may be passed to
 * ArrayAccess::offsetSet() instead of a plain value.
 *
 * When implementing this interface which extends Traversable, make sure to list
 * IteratorAggregate or Iterator before this interface in the implements clause.
 */
interface FieldItemListInterface extends FieldDisplayInterface, \IteratorAggregate {

  /**
   * Gets the entity that field belongs to.
   *
   * @return object|\Entity
   *   The entity object.
   */
  public function getEntity();

  /**
   * Gets the langcode of the field values held in the object.
   *
   * @return string $langcode
   *   The langcode.
   */
  public function getLangcode();

  /**
   * @return string
   *   The field name.
   */
  public function getFieldName();

  /**
   * Gets the field definition.
   *
   * @return array
   *   The field definition.
   */
  public function getField();

  /**
   * Gets the field instance definition.
   *
   * @return array
   *   The field instance definition.
   */
  public function getFieldInstance();

  /**
   * Gets the field items.
   *
   * @return array[]
   *   The field items.
   */
  public function getItems();

} 

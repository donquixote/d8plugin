<?php

namespace Drupal\d8plugin_field\ItemList;

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
interface AlterableFieldItemListInterface extends FieldItemListInterface {

  /**
   * Gets a reference to the array of field items, so they can be altered.
   *
   * @return &array[]
   *   Reference to the array of field items.
   *   Format: &array($delta => $item).
   */
  public function &getItemsByReference();

  /**
   * Removes a field item at a given position in the $items array.
   *
   * @param string $delta
   */
  public function removeItem($delta);

} 

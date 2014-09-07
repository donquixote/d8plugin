<?php


namespace Drupal\d8plugin_field\ItemList;


use Drupal\d8plugin_field\FieldInfo\FieldDisplayInterface;

class AlterableFieldItemList extends FieldItemListBase implements AlterableFieldItemListInterface {

  /**
   * Reference to the array of field items.
   *
   * @var array[]
   */
  private $items;

  /**
   * @param object $entity
   * @param FieldDisplayInterface $context
   * @param string $langcode
   * @param array $items
   */
  public function __construct($entity, FieldDisplayInterface $context, $langcode, &$items) {
    parent::__construct($entity, $context, $langcode);
    $this->items = &$items;
  }

  /**
   * Gets the field items.
   *
   * @return array[]
   *   The field items.
   */
  public function getItems() {
    return $this->items;
  }

  /**
   * Gets a reference to the array of field items, so they can be altered.
   *
   * @return array[]
   *   Reference to the array of field items.
   *   Format: &array($delta => $item).
   */
  public function &getItemsByReference() {
    return $this->items;
  }

  /**
   * Removes a field item at a given position in the $items array.
   *
   * @param string $delta
   */
  public function removeItem($delta) {
    unset($this->items[$delta]);
  }

}

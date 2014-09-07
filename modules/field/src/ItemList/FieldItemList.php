<?php


namespace Drupal\d8plugin_field\ItemList;


use Drupal\d8plugin_field\FieldInfo\FieldDisplayInterface;

class FieldItemList extends FieldItemListBase {

  /**
   * @var array[]
   */
  private $items;

  /**
   * @param object $entity
   * @param FieldDisplayInterface $context
   * @param string $langcode
   * @param array $items
   */
  function __construct($entity, FieldDisplayInterface $context, $langcode, $items) {
    parent::__construct($entity, $context, $langcode);
    $this->items = $items;
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

}

<?php


namespace Drupal\d8plugin\Utility;


class ArrayIteratorAggregate {

  /**
   * @var array
   */
  private $array;

  /**
   * @param array $array
   */
  function __construct(array $array) {
    $this->array = $array;
  }

  /**
   * @return \ArrayIterator
   */
  function getIterator() {
    return new \ArrayIterator($this->array);
  }

} 

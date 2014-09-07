<?php


namespace Drupal\d8plugin\Utility;


trait GetCalledClassTrait {

  /**
   * @return string
   */
  static function getCalledClass() {
    return \get_called_class();
  }

} 

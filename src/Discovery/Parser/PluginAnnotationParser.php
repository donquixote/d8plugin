<?php


namespace Drupal\d8plugin\Discovery\Parser;


class PluginAnnotationParser extends ParserDecoratorBase {

  /**
   * @var string
   */
  private $annotationName;

  /**
   * @param string $annotationName
   */
  function __construct($annotationName) {
    $this->annotationName = $annotationName;
  }

  /**
   * @param $tree
   *
   * @return mixed
   */
  protected function enhanceTree($tree) {

  }

} 

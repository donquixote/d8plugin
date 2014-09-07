<?php


namespace Drupal\d8plugin\Reflection;


use Doctrine\Common\Reflection\ClassFinderInterface;

class FakeClassFinder implements ClassFinderInterface {

  /**
   * @var string
   */
  private $className;

  /**
   * @var string
   */
  private $file;

  /**
   * @param string $className
   * @param string $file
   */
  function __construct($className, $file) {
    $this->className = $className;
    $this->file = $file;
  }

  /**
   * Finds a class.
   *
   * @param string $class The name of the class.
   *
   * @return string|null The name of the class or NULL if not found.
   */
  public function findFile($class) {
    return $class === $this->className
      ? $this->file
      : NULL;
  }

}

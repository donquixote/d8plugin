<?php


namespace Drupal\d8plugin\PluginDefinition;


use Drupal\d8plugin\Utility\GetCalledClassTrait;

class PluginDefinition implements PluginDefinitionInterface {
  use GetCalledClassTrait;

  /**
   * @var string
   */
  private $class;

  /**
   * @var int|string
   */
  private $id;

  /**
   * @var array
   */
  private $args;

  /**
   * @param int|string $id
   * @param string $class
   * @param array $args
   */
  function __construct($id, $class, array $args) {
    $this->id = $id;
    $this->class = $class;
    $this->args = $args;
    $this->initArguments($args);
  }

  /**
   * @return string
   */
  function getPluginClass() {
    return $this->class;
  }

  /**
   * @return string
   */
  function getPluginId() {
    return $this->id;
  }

  /**
   * @return array
   */
  function getArgs() {
    return $this->args;
  }

  /**
   * Set special properties. Override if needed.
   *
   * @param array $args
   */
  protected function initArguments(array $args) {
    // Do nothing by default.
  }

}

<?php


namespace Drupal\d8plugin\PluginDefinition;

/**
 * @see PluginDescriptionInterface
 */
trait PluginDescriptionTrait {

  /**
   * @var string
   */
  private $description;

  /**
   * @param string|null $description
   */
  protected function __construct_($description) {
    $this->description = $description;
  }

  /**
   * @param array $args
   */
  protected function initDescription(array $args) {
    if (isset($args['description'])) {
      $this->description = $args['description'];
    }
  }

  /**
   * @return string|null
   */
  public function getDescription() {
    return $this->description;
  }

} 

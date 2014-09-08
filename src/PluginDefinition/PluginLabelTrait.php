<?php


namespace Drupal\d8plugin\PluginDefinition;

/**
 * @see PluginLabelInterface
 */
trait PluginLabelTrait {

  /**
   * @var string
   */
  private $label;

  /**
   * @param array $args
   */
  protected function initLabel(array $args) {
    if (isset($args['label'])) {
      $this->label = $args['label'];
    }
    else {
      $this->label = $args['id'];
    }
  }

  /**
   * @return string
   */
  public function getLabel() {
    return $this->label;
  }

} 

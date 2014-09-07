<?php


namespace Drupal\d8plugin_field\DIC;

use Drupal\d8plugin\DIC\ServiceContainer;
use Drupal\d8plugin\DIC\ServiceContainerBase;
use Drupal\d8plugin_field\FormatterPluginManager;

/**
 * @property FormatterPluginManager $formatterPluginManager
 */
class FieldServiceContainer extends ServiceContainerBase {

  /**
   * @var ServiceContainer
   */
  private $parentServices;

  function __construct(ServiceContainer $parentServices) {
    $this->parentServices = $parentServices;
  }

  /**
   * @return FormatterPluginManager
   */
  protected function get_formatterPluginManager() {
    return new FormatterPluginManager(
      $this->parentServices->pluginInfoRegistry);
  }

}

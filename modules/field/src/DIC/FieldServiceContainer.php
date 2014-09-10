<?php


namespace Drupal\d8plugin_field\DIC;

use Drupal\d8plugin\DIC\ServiceContainer;
use Drupal\d8plugin\DIC\ServiceContainerBase;
use Drupal\d8plugin_field\Formatter\FormatterPluginManager;
use Drupal\d8plugin_field\PrepareViewHandler;

/**
 * @property \Drupal\d8plugin_field\Formatter\FormatterPluginManager $formatterPluginManager
 */
class FieldServiceContainer extends ServiceContainerBase {

  /**
   * @var ServiceContainer
   */
  private $parentServices;

  /**
   * @param ServiceContainer $parentServices
   */
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

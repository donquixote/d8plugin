<?php


namespace Drupal\d8plugin_filter\DIC;

use Drupal\d8plugin\DIC\ServiceContainer;
use Drupal\d8plugin\DIC\ServiceContainerBase;
use Drupal\d8plugin_filter\FilterPluginManager;

/**
 * @property FilterPluginManager $filterPluginManager
 */
class FilterServiceContainer extends ServiceContainerBase {

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
   * @return FilterPluginManager
   */
  protected function get_filterPluginManager() {
    return new FilterPluginManager(
      $this->parentServices->pluginInfoRegistry);
  }

}

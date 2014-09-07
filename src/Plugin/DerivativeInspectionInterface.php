<?php


namespace Drupal\d8plugin\Plugin;


interface DerivativeInspectionInterface {

  /**
   * Returns the base_plugin_id of the plugin instance.
   *
   * @return string
   *   The base_plugin_id of the plugin instance.
   */
  public function getBaseId();

  /**
   * Returns the derivative_id of the plugin instance.
   *
   * @return string|null
   *   The derivative_id of the plugin instance NULL otherwise.
   */
  public function getDerivativeId();

} 

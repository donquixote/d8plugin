<?php

namespace Drupal\d8plugin\Plugin;

trait ConfigurablePluginTrait {

  /**
   * @var array
   */
  private $configuration;

  /**
   * Returns this plugin's configuration.
   *
   * @return array
   *   An array of this plugin's configuration.
   */
  public function getConfiguration() {
    return $this->configuration + $this->defaultConfiguration();
  }

  /**
   * Sets the configuration for this plugin instance.
   *
   * @param array $configuration
   *   An associative array containing the plugin's configuration.
   */
  public function setConfiguration(array $configuration) {
    $this->configuration = $configuration;
  }

  /**
   * Returns default configuration for this plugin.
   *
   * @return array
   *   An associative array with the default configuration.
   */
  public function defaultConfiguration() {
    return array();
  }

}

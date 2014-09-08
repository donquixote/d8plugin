<?php


namespace Drupal\d8plugin\Plugin;

/**
 * Interface for configurable plugins.
 *
 * This interface has no methods for settings form or settings summary, since
 * these might need a signature unique to the plugin type.
 *
 * @see \Drupal\d8plugin_field\Formatter\ConfigurableFormatterInterface
 */
interface ConfigurablePluginInterface extends PluginInterface {

  /**
   * Returns this plugin's configuration.
   *
   * @return array
   *   An array of this plugin's configuration.
   */
  public function getConfiguration();

  /**
   * Sets the configuration for this plugin instance.
   *
   * @param array $configuration
   *   An associative array containing the plugin's configuration.
   */
  public function setConfiguration(array $configuration);

  /**
   * Returns default configuration for this plugin.
   *
   * @return array
   *   An associative array with the default configuration.
   */
  public function defaultConfiguration();

}

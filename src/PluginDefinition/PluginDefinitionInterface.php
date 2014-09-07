<?php


namespace Drupal\d8plugin\PluginDefinition;


use Drupal\d8plugin\Utility\GetCalledClassInterface;

interface PluginDefinitionInterface extends GetCalledClassInterface {

  /**
   * @return string
   */
  function getPluginClass();

  /**
   * @return string
   */
  function getPluginId();

  /**
   * @return array
   */
  function getArgs();

} 

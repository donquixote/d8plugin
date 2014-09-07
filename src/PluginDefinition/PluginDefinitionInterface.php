<?php


namespace Drupal\d8plugin\PluginDefinition;


interface PluginDefinitionInterface {

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

  /**
   * @return string
   */
  static function getDefinitionClass();

} 

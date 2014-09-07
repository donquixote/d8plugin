<?php


namespace Drupal\d8plugin\Discovery;


use Drupal\d8plugin\PluginType;

class PluginTypeRegistry {

  /**
   * @param string $pluginTypeName
   *
   * @return PluginType
   */
  function getPluginType($pluginTypeName) {
    $annotationClass = 'Drupal\pluginapi\Field\Annotation\FieldFormatter';
    return new PluginType($pluginTypeName, $annotationClass);
  }

} 

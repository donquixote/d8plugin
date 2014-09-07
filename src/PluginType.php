<?php


namespace Drupal\d8plugin;


use Drupal\d8plugin\PluginDefinition\PluginDefinition;

class PluginType {

  /**
   * @var string
   */
  private $namespaceSuffix;

  /**
   * Class to instantiate as a plugin definition.
   *
   * @var string
   */
  private $pluginDefinitionClass;

  /**
   * @var string
   */
  private $annotationName;

  /**
   * @param string $namespaceSuffix
   * @param string $annotationName
   * @param string|null $definitionClass
   *
   * @throws \Exception
   */
  function __construct($namespaceSuffix, $annotationName, $definitionClass = NULL) {
    $this->namespaceSuffix = $namespaceSuffix;
    $this->annotationName = $annotationName;
    if (isset($definitionClass)) {
      if (!class_exists($definitionClass)) {
        throw new \Exception("Definition class does not exist.");
      }
      $this->pluginDefinitionClass = $definitionClass;
    }
    else {
      $this->pluginDefinitionClass = PluginDefinition::getCalledClass();
    }
  }

  /**
   * @return string
   */
  function getNamespaceSuffix() {
    return $this->namespaceSuffix;
  }

  /**
   * @return string
   */
  public function getAnnotationClass() {
    return $this->pluginDefinitionClass;
  }

  /**
   * @return string
   */
  public function getAnnotationName() {
    return $this->annotationName;
  }

  /**
   * @param int|string $id
   * @param string $pluginClass
   * @param array $arguments
   *
   * @return mixed
   */
  public function buildPluginDefinition($id, $pluginClass, array $arguments) {
    $definitionClass = $this->pluginDefinitionClass;
    return new $definitionClass($id, $pluginClass, $arguments);
  }

} 

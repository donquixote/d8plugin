<?php

namespace Drupal\d8plugin;

/**
 * Collection of enabled modules with some info about them.
 *
 * In this module this is used ot wrap the array of all modules that participate
 * by providing plugins.
 */
class ModuleInfoCollection {

  /**
   * @var string[]
   */
  private $moduleDirs;

  /**
   * @param string[] $moduleDirs
   */
  public function __construct(array $moduleDirs) {
    $this->moduleDirs = $moduleDirs;
  }

  /**
   * @return string[]
   */
  public function getModuleDirs() {
    return $this->moduleDirs;
  }
}

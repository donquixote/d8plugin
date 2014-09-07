<?php


namespace Drupal\Tests\d8plugin;


class Psr4ProviderScan {

  /**
   * @var string[][]
   */
  private $arglist = [];

  /**
   * @return string[][]
   */
  public function getArgList() {
    return $this->arglist;
  }

  /**
   * @param $moduleNamePrefix
   * @param $modulesDir
   *
   * @return array
   */
  public function checkSubModules($moduleNamePrefix, $modulesDir) {
    foreach (new \DirectoryIterator($modulesDir) as $fileInfo) {
      if ($fileInfo->isDot()) {
        continue;
      }
      if ($fileInfo->isDir()) {
        $key = $fileInfo->getFilename();
        $module = $moduleNamePrefix . $key;
        $this->checkModulePsr4($module, $fileInfo->getPathname());
      }
    }
  }

  /**
   * @param $module
   * @param $moduleDir
   */
  public function checkModulePsr4($module, $moduleDir) {
    $this->checkPsr4("Drupal\\$module", "$moduleDir/src");
    if (is_dir("$moduleDir/tests/src")) {
      $this->checkPsr4("Drupal\\Tests\\$module", "$moduleDir/tests/src");
    }
  }

  /**
   * @param string $namespace
   * @param string $dir
   */
  public function checkPsr4($namespace, $dir) {
    foreach (new \DirectoryIterator($dir) as $fileInfo) {
      if ($fileInfo->isDot()) {
        continue;
      }
      if ($fileInfo->isDir()) {
        $this->checkPsr4(
          $namespace . '\\' . $fileInfo->getFilename(),
          $fileInfo->getPathname());
      }
      elseif ($fileInfo->isFile()) {
        if ('php' === $fileInfo->getExtension()) {
          $class = $namespace . '\\' . $fileInfo->getBasename('.php');
          $this->arglist[] = [$class, $fileInfo->getPathname()];
        }
      }
    }
  }

} 

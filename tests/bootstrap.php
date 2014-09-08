<?php

call_user_func(
  function(){
    $moduleDir = dirname(__DIR__);
    $loader = require_once $moduleDir . '/vendor/autoload.php';
    if (!$loader instanceof \Composer\Autoload\ClassLoader) {
      throw new \Exception("Not a class loader.");
    }
    $loader->addPsr4('Drupal\d8plugin\\', $moduleDir . '/src');
    $loader->addPsr4('Drupal\Tests\d8plugin\\', $moduleDir . '/tests/src');
    foreach (
      [
        __DIR__ => 'Drupal\\d8plugin_test_',
        $moduleDir => 'Drupal\\d8plugin_'
      ]
      as $basedir => $prefix
    ) {
      foreach (new \DirectoryIterator($basedir . '/modules') as $fileInfo) {
        if ($fileInfo->isDot()) {
          continue;
        }
        if ($fileInfo->isDir()) {
          $key = $fileInfo->getFilename();
          $loader->addPsr4($ns = $prefix . $key . '\\', $ph = $basedir . "/modules/$key/src");
          print "\n($ns => $ph)\n";
        }
      }
    }
  }
);

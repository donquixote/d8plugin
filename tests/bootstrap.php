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
    foreach (['field'] as $key) {
      $loader->addPsr4("Drupal\\d8plugin_{$key}\\", $moduleDir . "/modules/$key/src");
    }
  }
);

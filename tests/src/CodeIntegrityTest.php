<?php


namespace Drupal\Tests\d8plugin;



class CodeIntegrityTest extends \PHPUnit_Framework_TestCase {

  /**
   * @dataProvider providerTestClassFile
   *
   * @param string $class
   * @param string $file
   */
  function testClassFile($class, $file) {
    $fileContents = file_get_contents($file);
    $identifier = '[a-zA-Z_][a-zA-Z0-9_]+';
    $br = preg_quote("\n");
    $fileNamespace = '';
    if (preg_match("#{$br}namespace ($identifier(\\\\$identifier)*);#", $fileContents, $m)) {
      $fileNamespace = $m[1] . '\\';
    }
    if (preg_match("#$br(abstract |final |)(class|class|interface|trait) ($identifier) #", $fileContents, $m)) {
      $fileShortName = $m[3];
    }
    else {
      $this->fail('File does not define a class.');
      return;
    }
    $fileClassName = $fileNamespace . $fileShortName;
    $this->assertEquals($class, $fileClassName);
  }
  /**
   * @dataProvider providerTestClassFile
   *
   * @param string $class
   * @param string $file
   */
  function testClassFileInclusion(
    /** @noinspection PhpUnusedParameterInspection */
    $class,
    $file
  ) {
    require_once $file;
  }

  /**
   * @return string[][]
   */
  function providerTestClassFile() {
    $testsDir = dirname(__DIR__);
    $moduleDir = dirname($testsDir);
    $scan = new Psr4ProviderScan();
    $scan->checkPsr4('Drupal\\d8plugin', $moduleDir . '/src');
    $scan->checkModulePsr4('d8plugin', $moduleDir);
    $scan->checkSubModules('d8plugin_', $moduleDir . '/modules');
    $scan->checkSubModules('d8plugin_test_', $testsDir . '/modules');
    return $scan->getArgList();
  }

} 

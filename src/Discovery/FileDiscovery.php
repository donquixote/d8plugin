<?php


namespace Drupal\d8plugin\Discovery;


class FileDiscovery {

  /**
   * Discovers plugins in a PSR-4 base directory mapped to a namespace.
   *
   * @param string $dir
   *   The base directory, without trailing slash.
   * @param string $namespace
   *   The namespace, without trailing namespace separator.
   *
   * @return string[]
   *   Format: $[$fullClassName] = $pathToFile
   */
  function discoverClassFiles($dir, $namespace) {
    $classFiles = array();
    foreach (new \DirectoryIterator($dir) as $candidate) {
      if ($candidate->isFile()) {
        if ('php' === $candidate->getExtension()) {
          $class = $namespace . '\\' . $candidate->getBasename('.php');
          $classFiles[$class] = $candidate->getPathname();
        }
      }
    }
    return $classFiles;
  }

} 

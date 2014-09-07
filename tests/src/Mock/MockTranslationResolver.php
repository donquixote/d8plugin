<?php


namespace Drupal\Tests\d8plugin\Mock;


use Drupal\d8plugin\Discovery\Argument\AnnotationResolverInterface;
use vektah\parser_combinator\language\php\annotation\DoctrineAnnotation;

class MockTranslationResolver implements AnnotationResolverInterface {

  /**
   * @param DoctrineAnnotation $annotation
   *
   * @return mixed|null
   */
  function resolve(DoctrineAnnotation $annotation) {
    return isset($annotation->arguments['value'])
      ? 't(' . var_export($annotation->arguments['value'], true) . ')'
      : null;
  }
}

<?php


namespace Drupal\d8plugin\Discovery\Argument\Resolver;


use Drupal\d8plugin\Discovery\Argument\AnnotationResolverInterface;
use vektah\parser_combinator\language\php\annotation\DoctrineAnnotation;

class TranslationResolver implements AnnotationResolverInterface {

  /**
   * @param DoctrineAnnotation $annotation
   *
   * @return mixed|null
   */
  function resolve(DoctrineAnnotation $annotation) {
    return isset($annotation->arguments['value'])
      ? t($annotation->arguments['value'])
      : null;
  }
}

<?php


namespace Drupal\d8plugin\Discovery\Argument;


use vektah\parser_combinator\language\php\annotation\DoctrineAnnotation;

class ArgumentsResolver {

  /**
   * @var AnnotationResolverInterface[]
   */
  private $annotationResolvers;

  /**
   * @param AnnotationResolverInterface[] $annotationResolvers
   */
  function __construct(array $annotationResolvers) {
    $this->annotationResolvers = $annotationResolvers;
  }

  /**
   * @param array $args
   *
   * @return array
   */
  function resolveArguments(array $args) {
    foreach ($args as &$arg) {
      if ($arg instanceof DoctrineAnnotation) {
        $arg = $this->resolveNestedAnnotation($arg);
      }
      elseif (is_array($arg)) {
        $arg = $this->resolveArguments($arg);
      }
    }
    return $args;
  }

  /**
   * @param DoctrineAnnotation $nestedAnnotation
   *
   * @return null|mixed
   */
  private function resolveNestedAnnotation($nestedAnnotation) {
    if (isset($this->annotationResolvers[$nestedAnnotation->name])) {
      return $this->annotationResolvers[$nestedAnnotation->name]->resolve($nestedAnnotation);
    }
    return NULL;
  }

} 

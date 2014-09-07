<?php


namespace Drupal\d8plugin\Discovery\Grammar;

use vektah\parser_combinator\combinator\Choice;
use vektah\parser_combinator\combinator\Many;
use vektah\parser_combinator\combinator\OptionalChoice;
use vektah\parser_combinator\combinator\Sequence;
use vektah\parser_combinator\formatter\Closure;
use vektah\parser_combinator\formatter\ClosureWithResult;
use vektah\parser_combinator\formatter\Ignore;
use vektah\parser_combinator\Input;
use vektah\parser_combinator\language\php\annotation\DoctrineAnnotation;
use vektah\parser_combinator\language\php\annotation\NonDoctrineAnnotation;
use vektah\parser_combinator\parser\Parser;
use vektah\parser_combinator\parser\PositiveMatch;
use vektah\parser_combinator\parser\RegexParser;
use vektah\parser_combinator\Result;

/**
 * @property Parser $rawDoctrineAnnotation
 * @property Parser $doctrineAnnotation
 * @property Parser $nestedDoctrineAnnotation
 * @property Parser $nonDoctrineAnnotations
 * @property Parser $annotatedComment
 */
class AnnotationGrammar extends AnnotationGrammarBase {

  function __construct() {
    parent::__construct();
    $this->type->append($this->nestedDoctrineAnnotation);
  }

  protected function get_rawDoctrineAnnotation() {
    return new ClosureWithResult(
      new Sequence(
        new Ignore('@'),
        $this->ident,
        $this->ws,
        new OptionalChoice(
          new Sequence(
            new Ignore('('),
            PositiveMatch::instance(),
            $this->arguments,
            new Ignore(')')
          )
        )
      ),
      function(Result $result, Input $input) {
        $data = $result->data;
        $arguments = $data[1][0] ? $data[1][0] : [];
        return new DoctrineAnnotation($data[0], $arguments, $input->getLine($result->offset));
      }
    );
  }

  protected function get_doctrineAnnotation() {
    return $this->rawDoctrineAnnotation;
  }

  protected function get_nestedDoctrineAnnotation() {
    return $this->rawDoctrineAnnotation;
  }

  protected function get_nonDoctrineAnnotations() {
    return new ClosureWithResult(
      new Sequence('@', '[a-z][a-zA-Z0-9_\[\]]*', $this->ws, new RegexParser('[^@]*', 'ms')),
      function (Result $result, Input $input) {
        $value = str_replace('*/', '', $result->data[2]);
        $value = str_replace('*', '', $value);
        return new NonDoctrineAnnotation($result->data[1], trim($value), $input->getLine($result->offset));
      }
    );
  }

  protected function get_annotatedComment() {
    return new Closure(
      new Sequence(
        $this->ws,
        new Many(
          new Sequence(
            new Choice(
              $this->nonDoctrineAnnotations,
              $this->doctrineAnnotation,
              $this->comment
            ),
            $this->ws
          )
        )
      ),
      function($data) {
        return array_map(
          function($value) {
            return $value[0];
          },
          $data[0]
        );
      }
    );
  }

} 

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
use vektah\parser_combinator\language\php\annotation\ConstLookup;
use vektah\parser_combinator\parser\literal\FloatLiteral;
use vektah\parser_combinator\parser\literal\IntLiteral;
use vektah\parser_combinator\parser\literal\StringLiteral;
use vektah\parser_combinator\parser\Parser;
use vektah\parser_combinator\parser\RegexParser;
use vektah\parser_combinator\parser\RepSep;
use vektah\parser_combinator\parser\WhitespaceParser;
use vektah\parser_combinator\Result;

/**
 * @property Parser $ws
 * @property Parser $ident
 * @property Parser $string
 * @property Parser $float
 * @property Parser $int
 * @property Parser $const
 * @property Choice $type
 * @property Parser $arguments
 * @property Parser $array
 * @property Parser $comment
 */
class AnnotationGrammarBase extends GrammarBase {

  function __construct() {
    parent::__construct(
      [
        'ws' => new Ignore(new Many(new WhitespaceParser(1), '(/\*\*|\*/|\*)')),
        'ident' => '[a-zA-Z_][a-zA-Z0-9_]*',
        'string' => new StringLiteral(),
        'float' => new FloatLiteral(),
        'int' => new IntLiteral(),
        'comment' => '[^@].*',
      ]
    );

    $this->type->append($this->array);
  }

  protected function get_const() {
    return new ClosureWithResult(
      new Sequence(
        $this->ident,
        new OptionalChoice(
          new Sequence(
            '::',
            $this->ident
          )
        )
      ),
      function(Result $result, Input $input) {
        $data = $result->data;
        $line = $input->getLine($result->offset);

        if ($data[1]) {
          return new ConstLookup($data[1][1], $data[0], $line);
        }

        return new ConstLookup($data[0], null, $line);
      }
    );
  }

  protected function get_type() {
    return new Choice(
      $this->string,
      $this->float,
      $this->int,
      $this->const,
      new RegexParser('true', 'i'),
      new RegexParser('false', 'i'),
      new RegexParser('null', 'i')
    );
  }

  protected function get_arguments() {
    return new Closure(
      new RepSep(
        new Sequence(
          $this->ws,
          new OptionalChoice(
            new Sequence(
              $this->ident,
              $this->ws,
              '=',
              $this->ws
            )
          ),
          $this->type,
          $this->ws
        )
      ),
      function($data) {
        $arguments = [];

        foreach ($data as $datum) {
          if ($datum[0]) {
            $arguments[$datum[0][0]] = $datum[1];
          } else {
            $arguments['value'] = $datum[1];
          }
        }

        return $arguments;
      }
    );
  }

  protected function get_array() {
    return new Closure(
      new Sequence(
        new Ignore('{'),
        new RepSep(
          new Sequence(
            $this->ws,
            new OptionalChoice(new Sequence(
                $this->string,
                $this->ws,
                '=',
                $this->ws
              )),
            $this->type,
            $this->ws
          )
        ),
        new Ignore('}')
      ),
      function($data) {
        $result = [];
        foreach ($data[0] as $datum) {
          if ($datum[0]) {
            $result[$datum[0][0]] = $datum[1];
          } else {
            $result[] = $datum[1];
          }
        }

        return $result;
      }
    );
  }

} 

<?php


namespace Drupal\d8plugin\Discovery\Parser;


use vektah\parser_combinator\Input;
use vektah\parser_combinator\parser\Parser;
use vektah\parser_combinator\Result;

abstract class ParserDecoratorBase extends Parser {

  /**
   * @var Parser
   */
  private $decorated;

  /**
   * @param Parser $decorated
   */
  function __construct(Parser $decorated) {
    $this->decorated = $decorated;
  }

  /**
   * Parse the given input
   *
   * @param Input $input
   *
   * @return Result result
   */
  public function parse(Input $input) {
    $tree = $this->decorated->parse($input);
    return $this->enhanceTree($tree);
  }

  /**
   * This can be overridden.
   *
   * @param $tree
   *
   * @return mixed
   */
  abstract protected function enhanceTree($tree);

}

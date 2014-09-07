<?php


namespace Drupal\d8plugin\Discovery\Grammar;


use vektah\parser_combinator\combinator\Choice;
use vektah\parser_combinator\parser\Parser;

abstract class GrammarBase {

  /**
   * @var Parser[]
   */
  private $symbols = array();

  /**
   * @param mixed[] $symbols
   */
  function __construct($symbols = array()) {
    foreach ($symbols as $key => $symbol) {
      $this->symbols[$key] = Parser::sanitize($symbol);
    }
  }

  /**
   * @param string $key
   *
   * @return Parser
   */
  function __get($key) {
    return isset($this->symbols[$key])
      ? $this->symbols[$key]
      : $this->symbols[$key] = $this->createSymbol($key);
  }

  /**
   * @param string $key
   *
   * @return mixed
   */
  protected function createSymbol($key) {
    $f = 'get_' . $key;
    if (method_exists($this, $f)) {
      $parser = $this->$f($key);
      return Parser::sanitize($parser);
    }
    else {
      return new Choice();
    }
  }

}

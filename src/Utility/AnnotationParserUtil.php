<?php


namespace Drupal\d8plugin\Utility;


class AnnotationParserUtil {

  /**
   * @param string $input
   *
   * @return string
   */
  public static function trimDocComment($input) {
    $pos = self::findInitialTokenPosition($input);
    if ($pos === null) {
      return null;
    }

    // Trim everything before the first '@'.
    $input = substr($input, $pos);

    // Trim irrelevant characters at the end.
    return rtrim($input, '* /');
  }

  /**
   * Finds the first valid annotation position.
   *
   * That is, the first occurence of @ that is either
   * - at the beginning of the input, or
   * - preceded with a space ' ', or
   * - preceded with a an asterisk '*'.
   *
   * @param string $input
   *   The docblock string to parse
   *
   * @return int|null
   */
  public static function findInitialTokenPosition($input) {
    $pos = 0;

    // search for first valid annotation
    while (FALSE !== $pos = strpos($input, '@', $pos)) {
      // if the @ is preceded by a space or * it is valid
      if ($pos === 0 || $input[$pos - 1] === ' ' || $input[$pos - 1] === '*') {
        return $pos;
      }

      $pos++;
    }

    return NULL;
  }

} 

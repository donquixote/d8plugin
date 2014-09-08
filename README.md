d8plugin
========

Backport of the Drupal 8 plugin API as a Drupal 7 module.

Not a complete 1:1 backport, but in a way that is meant to be useful in a D7 context.

Instead of the Doctrine AnnotationParser, it uses the [Parser Combinator from Vektah](https://github.com/Vektah/parser-combinator), which is way cleaner.

It still uses Doctrine components though, to exract the docblock from a class file.

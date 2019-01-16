<?php

namespace App\GenDiff;

//use function Docopt\Handler;
class Differ
{
  const HELP = <<<DOC
  Generate diff.

  Usage:
    gendiff (-h|--help)
    gendiff [--format <fmt>] <firstFile> <secondFile>

  Options:
    -h --help                     Show this screen
    --format <fmt>                Report format [default: pretty]
DOC;

  public static function run()
  {
    $args = \Docopt::handle(self::HELP);
  
  }
}

//self::run();
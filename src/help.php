<?php

namespace Generate_gendiff;

//use function Docopt\Handler;
const HELP = <<<DOC
Generate diff.

Usage:
  gendiff (-h|--help)
  gendiff [--format <fmt>] <firstFile> <secondFile>

Options:
  -h --help                     Show this screen
  --format <fmt>                Report format [default: pretty]
DOC;

function run()
{
	$args = \Docopt::handle(HELP);
}

run();
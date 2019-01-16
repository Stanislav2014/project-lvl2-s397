<?php

namespace App\GenDiff;

class Cli
{
    const DOC = <<<DOC
  Generate diff.

  Usage:
    gendiff (-h|--help)
    gendiff [--format <fmt>] <firstFile> <secondFile>

  Options:
    -h --help                     Show this screen
    --format <fmt>                Report format [default: pretty]
DOC;

    public function run()
    {
        $args = \Docopt::handle(self::DOC);

        if (isset($args['<firstFile>'])) {
            $filepath1 = $args['<firstFile>'];
            if (!file_exists($filepath1)) {
                die("File {$filepath1} does not exist\n");
            }
        }
    
        if (isset($args['<secondFile>'])) {
            $filepath2 = $args['<secondFile>'];
            if (!file_exists($filepath2)) {
                die("File {$filepath2} does not exist\n");
            }
        }
        return Differ::genDiff($filepath1, $filepath2);

    }

}
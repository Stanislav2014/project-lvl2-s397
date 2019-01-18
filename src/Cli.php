<?php

namespace GenDiff;
use function GenDiff\Differ\genDiff;

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
        if (isset($args['<fmt>'])) {
            $fmt = $args['<fmt>'];
        }
        
        //return Differ::genDiff($filepath1, $filepath2);
        try {
            print_r(genDiff($filepath1, $filepath2));
        } catch (\Exception $exception) {
            echo $exception->getMessage() . PHP_EOL;
        }
    
    }

}
<?php

namespace GenDiff;

use function Funct\Collection\union;
use function Funct\Collection\flattenAll;
use function GenDiff\Parser\parse;
use function GenDiff\Ast\dataToAst;
use function GenDiff\Ast\astToString;

function genDiff($filepath1, $filepath2, $format = 'json'):string
{
    $content1 = parse(getType($filepath1), getData($filepath1));
    $content2 = parse(getType($filepath2), getData($filepath2));
    $ast = dataToAst($content1, $content2);
    $string = astToString($ast);

    return $string;
}

function getData($path)
{
    if (is_readable($path)) {
        $content = file_get_contents($path, true);
        if (empty($content)) {
            throw new \Exception("File {$path} is empty");
        }
        
        return $content;
    }
    throw new \Exception('File is not readable');
    
}

function getType($path) 
{
    $extension = pathinfo($path, PATHINFO_EXTENSION);
    return $extension;
}
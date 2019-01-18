<?php

namespace GenDiff\Differ;

use function Funct\Collection\union;
use function Funct\Collection\flattenAll;
use function GenDiff\Parse\parse;
use function GenDiff\Parse\getType;
use function GenDiff\Parse\getData;
use function GenDiff\Ast\dataToAst;
use function GenDiff\Ast\astToStr;

function genDiff($pathFile1, $pathFile2, $format = ""):string
{
    $content1 = parse(getType($pathFile1), getData($pathFile1));
    $content2 = parse(getType($pathFile2), getData($pathFile2));
    $ast = dataToAst($content1, $content2);
    $string = astToStr($ast);

    return $string;
}

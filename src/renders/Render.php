<?php

namespace Gendiff\Render;

use function Gendiff\Render\Pretty\pretty;
use function Gendiff\Render\Plain\plain;


function render($ast, $format)
{
    switch ($format) {
        case 'pretty':
            return pretty($ast);
            break;
        case 'plain':
            return plain($ast);
            break;
        case 'json':
            return json_encode($ast, JSON_PRETTY_PRINT);
        default:
            throw new \Exception("Format '{$format}' is unknown");
    }
}
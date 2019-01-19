<?php

namespace GenDiff\Render\Pretty;

use function Funct\Collection\flattenAll;


function pretty($ast)
{
    $arr = array_map(function ($item) {
        return getPretty($item, 0);
    }, $ast);
    return '{' . PHP_EOL . implode("\n", array_filter(flattenAll($arr))) . PHP_EOL . '}';
}

function getPretty($i, $depth)
{
        //print_r($item);
        [
            'type' => $type,
            'key' => $key,
            'beforeValue' => $before,
            'afterValue' => $after,
            'children' => $children
        ] = $i;
    
        $before = arrToString($before, $depth);
        $after = arrToString($after, $depth);

        //var_dump($item);
        switch ($type) {
            case 'nested':
                return [
            getSpace($depth) . "  $key: {",
            array_map(function ($item) use ($depth) {
                return getPretty($item, $depth + 1);
            }, $children),
            getSpace($depth) . "  }"
                ];

            break;

            case 'unchanged':
                return getSpace($depth) . "  $key: $before";
            break;

            case 'changed':
                return [getSpace($depth) . "+ $key: $after", getSpace($depth) . "- $key: $before"];
            break;

            case 'deleted':
                return getSpace($depth) . "- $key: $before";
            break;

            case 'added':
                return getSpace($depth) . "+ $key: $after";
            break;
        }
}

function arrToString($value, $depth)
{
    if (is_bool($value)) {
        return boolToStr($value);
    }

    if (!is_array($value)) {
        return $value;
    }
        $keys = array_keys($value);
        $result = array_map(function ($item) use ($value, $depth) {
            return [PHP_EOL . getSpace($depth + 1) . "$item: $value[$item]"];
        }, $keys);
        return implode("", flattenAll(array_merge(["{"], $result, [PHP_EOL . getSpace($depth) . "  }"])));
}

function getSpace($depth)
{
    return str_repeat(' ', $depth * 4);
}

function boolToStr($bool)
{
    return $bool ? 'true' : 'false';
}

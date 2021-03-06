<?php

namespace GenDiff\Render\Plain;

use function Funct\Collection\flattenAll;

function plain($ast)
{
    $arr = array_map(function ($item) {
        return getPlain($item, '');
    }, $ast);
    return implode("\n", array_filter(flattenAll($arr))) . PHP_EOL;
}
function getPlain($item, $path)
{
    [
        'type' => $type,
        'key' =>  $key,
        'beforeValue' => $before,
        'afterValue' => $after,
        'children' => $children
    ] = $item;
    
    $before = is_array($before) ? 'complex value' : $before;
    $after = is_array($after) ? 'complex value' : $after;
    $name = "{$path}{$key}";
    $nameChildren = "{$path}{$key}.";
    switch ($type) {
        case 'nested':
            return array_map(function ($item) use ($nameChildren) {
                return getPlain($item, $nameChildren);
            }, $children);
        
        case 'changed':
            return "Property '{$name}' was changed. From '{$before}' to '{$after}'";
        
        case 'deleted':
            return "Property '{$name}' was removed";
        
        case 'added':
            return "Property '{$name}' was added with value: '{$after}'";
    }
}

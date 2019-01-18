<?php

namespace GenDiff\Ast;

use function GenDiff\Parser\boolToStr;
use function Funct\Collection\flattenAll;


function dataToAst($before, $after)
{
        $keys = array_keys(array_merge($before, $after));
        //var_dump($keys);

        $diff = array_map(function ($key) use ($before, $after) {
            $beforeValue = $before[$key] ?? "" ;
            $afterValue = $after[$key] ?? "";

            if (array_key_exists($key, $before) && array_key_exists($key, $after)) {
                if (is_array($before[$key]) && is_array($after[$key])) {
                    $ast = createNode('nested', $key, null, null, dataToAst($beforeValue, $afterValue));
                } elseif ($before[$key] === $after[$key]) {
                    $ast = createNode('unchanged', $key, $beforeValue, $afterValue, null);
                } else {
                    $ast = createNode('changed', $key, $beforeValue, $afterValue, null);
                }

            } elseif (array_key_exists($key, $before) && !array_key_exists($key, $after)) {
                $ast = createNode('deleted', $key, $beforeValue, null, null);

            } elseif (!array_key_exists($key, $before) && array_key_exists($key, $after)) {

                $ast = createNode('added', $key, null, $afterValue, null);
            }
            return $ast; 
        }, $keys);

        //var_dump($diff);

        return $diff;
    }

function createNode($type, $key, $beforeValue, $afterValue, $children)
    {
        return [
            'type' => $type,
            'key' => $key,
            'beforeValue' => is_bool($beforeValue)? boolToStr($beforeValue) : $beforeValue ,
            'afterValue' => is_bool($afterValue)? boolToStr($afterValue) : $afterValue,
            'children' => $children
        ];

    }

function astToString($ast)
    {
        $result = array_map(function ($item) {
            return render($item, 0);
        }, $ast);
        print_r($result);
        return '{' . PHP_EOL . implode("\n", array_filter(flattenAll($result))) . PHP_EOL . '}';
    }

function render($item, $depth)
    {
        [
            'type' => $type,
            'key' => $key,
            'beforeValue' => $before,
            'afterValue' => $after,
            'children' => $children
        ] = $item;

        $before = arrToString($before, $depth);
        $after = arrToString($after, $depth);

        //var_dump($item);
        switch ($type) {
        case 'nested':
        return [
            getSpace($depth) . "  $key: {",
            array_map(function ($item) use ($depth) {
                return render($item, $depth + 1);
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

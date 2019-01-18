<?php

namespace GenDiff\Ast;

use function GenDiff\Parser\boolToStr;
use function Funct\Collection\flattenAll;


function createAst($before, $after)
{
        //$keys = array_keys(array_merge($before, $after));
        //var_dump($keys);
        $keys = array_unique(array_merge(array_keys($before), array_keys($after)));

        $diff = array_map(function ($key) use ($before, $after) {
            $beforeValue = $before[$key] ?? '' ;
            $afterValue = $after[$key] ?? '';

            if (array_key_exists($key, $before) && array_key_exists($key, $after)) {
                if (is_array($before[$key]) && is_array($after[$key])) {
                    $ast = createNode('nested', $key, null, null, createAst($beforeValue, $afterValue));
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
            'beforeValue' => is_bool($beforeValue)? boolToStr($beforeValue) : $beforeValue,
            'afterValue' => is_bool($afterValue)? boolToStr($afterValue) : $afterValue,
            'children' => $children
        ];

    }

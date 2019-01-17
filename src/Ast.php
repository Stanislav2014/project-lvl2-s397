<?php

namespace App\GenDiff;
use function Funct\Collection\union;

class Ast
{
    public static function dataToAst($before, $after)
    {
        $keys = array_keys(array_merge($before, $after));
        var_dump($keys);

        $diff = array_map(function ($key) use ($before, $after) {
            $beforeValue = $before[$key] ?? "" ;
            $afterValue = $after[$key] ?? "";

            if (array_key_exists($key, $before) && array_key_exists($key, $after)) {
                if (is_array($before[$key]) && is_array($after[$key])) {
                    $ast = self::createNode('nested', $key, null, null, self::dataToAst($before, $after));
                } elseif ($before[$key] === $after[$key]) {
                    $ast = self::createNode('unchanged', $key, $beforeValue, $afterValue, null);
                } else {
                    $ast = self::createNode('changed', $key, $beforeValue, $afterValue, null);
                }

            } elseif (array_key_exists($key, $before) && !array_key_exists($key, $after)) {
                $ast = self::createNode('deleted', $key, $beforeValue, null, null);

            } elseif (!array_key_exists($key, $before) && array_key_exists($key, $after)) {

                $ast = self::createNode('added', $key, null, $afterValue, null);
            }
            return $ast; 
        }, $keys);

        //var_dump($diff);
    }

    public static function createNode($type, $key, $beforeValue, $afterValue, $children)
    {
        return [
            'type' => $type,
            'key' => $key,
            'beforeValue' => is_bool($beforeValue)? Parse::boolToStr($beforeValue) : $beforeValue ,
            'afterValue' => is_bool($afterValue)? Parse::boolToStr($afterValue) : $afterValue,
            'children' => $children
        ];

    }

    public static function astToStr()
    {

    }
}
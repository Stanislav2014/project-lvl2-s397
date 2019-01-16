<?php

namespace App\GenDiff;

use function Funct\Collection\union;
use function Funct\Collection\flattenAll;
use App\GenDiff\Parse;

const ADD = "+";
const DELETE = "-";
const EQUAL = " ";

class Differ
{
    public function genDiff($pathFile1, $pathFile2):string
    {
        $content1 = json_decode(file_get_contents($pathFile1), true);
        $content2 = json_decode(file_get_contents($pathFile2), true);

        $union = union($content1, $content2);

        $diff = array_map(function ($key, $value) use ($content1, $content2) {
            $value = is_bool($value) ? Parse::boolToStr($value) : $value;
            if (array_key_exists($key, $content1) && array_key_exists($key, $content2)) {
                if ($value !== $content1[$key]) {
                    return [
                    ADD . " {$key}: {$value}",
                    DELETE . " {$key}: {$content1[$key]}"
                    ];
                } else {
                    return EQUAL . " {$key}: {$value}";
                }

            } elseif (array_key_exists($key, $content1)) {

                return DELETE . " {$key}: {$value}";

            } elseif (array_key_exists($key, $content2)) {

                return ADD . " {$key}: {$value}";
            }

        }, array_keys($union), $union);

        //var_dump($union);
        //var_dump(flattenAll($diff));

        $result = "{" . implode("\n", flattenAll($diff)) . "}";
        print_r($result);
        return $result;
    }

}

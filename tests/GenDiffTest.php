<?php

namespace GenDiff\Tests;

use \PHPUnit\Framework\TestCase;
use function GenDiff\Differ\genDiff;
//use function GenDiff\Ast;
//use function GenDiff\Parse\parse;

class GenDiffTest extends TestCase
{

    public function testGenDiff_Json()
    {
        $expected = file_get_contents("./tests/fixtures/expected");
        $pathFile1 = "./tests/fixtures/beforerecursive.yml";

        $pathToFile1 = "./tests/fixtures/before.json";
        $pathToFile2 = "./tests/fixtures/after.json"; 

        $actual = genDiff($pathToFile1, $pathToFile2);
    
        $this->assertEquals($expected, $actual);
    }

    public function testGenDiff_yml()
    {
        $expected = file_get_contents("./tests/fixtures/expected");

        $pathToFile1 = "./tests/fixtures/before.yml";
        $pathToFile2 = "./tests/fixtures/after.yml"; 

        $actual = genDiff($pathToFile1, $pathToFile2);
    
        $this->assertEquals($expected, $actual);
    }

    public function testGenDiff_recursive()
    {
        $expected = file_get_contents("./tests/fixtures/expected_recursive");

        $pathToFile1 = "./tests/fixtures/before_recursive.json";
        $pathToFile2 = "./tests/fixtures/after_recursive.json"; 

        $actual = genDiff($pathToFile1, $pathToFile2);
    
        $this->assertEquals($expected, $actual);
    }

}

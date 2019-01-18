<?php

namespace GenDiff\Tests;

use \PHPUnit\Framework\TestCase;
use function GenDiff\genDiff;

class GenDiffTest extends TestCase
{

    public function testGenDiff_Json()
    {
        $expected = file_get_contents("./tests/fixtures/expected");

        $filepath1 = "./tests/fixtures/before.json";
        $filepath2 = "./tests/fixtures/after.json"; 

        $actual = genDiff($filepath1, $filepath2);
    
        $this->assertEquals($expected, $actual);
    }

    public function testGenDiff_yml()
    {
        $expected = file_get_contents("./tests/fixtures/expected");

        $filepath1 = "./tests/fixtures/before.yml";
        $filepath2 = "./tests/fixtures/after.yml"; 

        $actual = genDiff($filepath1, $filepath2);
    
        $this->assertEquals($expected, $actual);
    }

    public function testGenDiff_recursive()
    {
        $expected = file_get_contents("./tests/fixtures/expected_recursive");

        $filepath1 = "./tests/fixtures/before_recursive.json";
        $filepath2 = "./tests/fixtures/after_recursive.json"; 

        $actual = genDiff($filepath1, $filepath2);
    
        $this->assertEquals($expected, $actual);
    }

    public function testGenDiff_plain()
    {
        $expected = file_get_contents("./tests/fixtures/expected_plain");

        $filepath1 = "./tests/fixtures/before_recursive.json";
        $filepath2 = "./tests/fixtures/after_recursive.json"; 

        $actual = genDiff($filepath1, $filepath2, 'plain');
        //var_dump($expected);
        //var_dump($actual);
        $this->assertEquals($expected, $actual);
    }


}

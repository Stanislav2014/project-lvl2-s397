<?php

namespace App\GenDiff\Tests;

use \PHPUnit\Framework\TestCase;
use App\GenDiff\Differ;

class GenDiffTest extends TestCase
{
    public function testGetDiff()
    {
        $expected = file_get_contents("./tests/fixtures/expected");

        $pathToFile1 = "./tests/fixtures/before.json";
        $pathToFile2 = "./tests/fixtures/after.json"; 

        $actual = Differ::genDiff($pathToFile1, $pathToFile2);
    
        $this->assertEquals($expected, $actual);
    }
}

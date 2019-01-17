<?php

namespace App\GenDiff\Tests;

use \PHPUnit\Framework\TestCase;
use App\GenDiff\Differ;
use App\GenDiff\Ast;
use App\GenDiff\Parse;

class GenDiffTest extends TestCase
{

    public function testGetDiff_Json()
    {
        $expected = file_get_contents("./tests/fixtures/expected");
        $pathFile1 = "./tests/fixtures/beforerecursive.yml";

        $pathToFile1 = "./tests/fixtures/before.json";
        $pathToFile2 = "./tests/fixtures/after.json"; 

        $actual = Differ::genDiff($pathToFile1, $pathToFile2);
    
        $this->assertEquals($expected, $actual);
    }
    public function testGetDiff_yml()
    {
        $expected = file_get_contents("./tests/fixtures/expected");

        $pathToFile1 = "./tests/fixtures/before.yml";
        $pathToFile2 = "./tests/fixtures/after.yml"; 

        $actual = Differ::genDiff($pathToFile1, $pathToFile2);
    
        $this->assertEquals($expected, $actual);
    }
    public function testAst()
    {
        $expected = file_get_contents("./tests/fixtures/expected");

        $pathFile1 = "./tests/fixtures/beforerecursive.json";
        $pathFile2 = "./tests/fixtures/afterrecursive.json";

        $content1 = Parse::parse($pathFile1, Parse::getData($pathFile1));
        $content2 = Parse::parse($pathFile2, Parse::getData($pathFile2));

        $actual = Ast::dataToAst($content1, $content2);

        $this->assertEquals($expected, $actual);
    }
}

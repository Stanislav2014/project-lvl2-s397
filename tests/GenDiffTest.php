<?php

namespace App\GenDiff\Tests;

use \PHPUnit\Framework\TestCase;
use App\GenDiff\Differ;

class GenDiffTest extends TestCase
{
    public function testGetDiff()
    {
        //$differ = \Docopt::handle(Differ::HELP);

        $jsonExpected = "{  host: hexlet.io". "\n" . 
                         "+ timeout: 20" . "\n" .
                         "- timeout: 50" . "\n" .
                         "- proxy: 123.234.53.22" . "\n" .
                         "+ verbose: true}";

        $pathToFile1 = "./jsonfiles/before.json";
        $pathToFile2 = "./jsonfiles/after.json"; 

        $actual = Differ::genDiff($pathToFile1, $pathToFile2);
        //var_dump(json_decode($jsonExpected, true));

        $this->assertEquals($actual, $jsonExpected);
    }
}

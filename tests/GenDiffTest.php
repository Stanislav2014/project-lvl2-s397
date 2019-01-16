<?php

namespace App\GenDiff\Tests;

use \PHPUnit\Framework\TestCase;
use App\GenDiff\Differ;

class GenDiffTest extends TestCase
{
    public function testGetDiff()
    {
        //$differ = \Docopt::handle(Differ::HELP);

        $jsonExpected = '{
          "  host": hexlet.io,
          "+ timeout": 20,
          "- timeout": 50,
          "- proxy": 123.234.53.22,
          "+ verbose": true
        }';

        $arr = [];

        $this->assertEquals($arr, json_decode($jsonExpected, true));
    }
}
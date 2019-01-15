<?php
namespace GenDiff\Tests;

use \PHPUnit\Framework\TestCase;
use \GenDiff\HELP as h;

class GenDiffTest extends TestCase
{
    public function testGetDiff()
    {
        $differ = \Docopt::handle(h);
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
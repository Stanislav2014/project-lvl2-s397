<?php

namespace GenDiff\Tests;

use \PHPUnit\Framework\TestCase;
use function GenDiff\genDiff;
//use function GenDiff\Ast;
//use function GenDiff\Parse\parse;

class ExceptionTest extends TestCase
{

    public function testFileIsEmpty()
    {
        $beforeFile = './tests/fixtures/before.json';
        $emptyFile = './tests/fixtures/empty.json';
        try {
            gendiff($beforeFile, $emptyFile, 'json');
            $this->fail('exception expected');
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }
    }
}
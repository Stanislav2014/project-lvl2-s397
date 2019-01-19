<?php

namespace GenDiff\Parser;

use Symfony\Component\Yaml\Yaml;

function parse($type, $data)
{
    switch ($type) {
        case 'yml':
            return Yaml::parse($data);

        break;
            
        case 'json':
            return json_decode($data, true);

        break;

        default:
            throw new \Exception("This is '{$format}' unknowm format");
        
        break;
    }
}

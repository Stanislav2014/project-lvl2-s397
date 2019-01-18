<?php

namespace GenDiff\Parse;

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

function getType($path) 
{
    $extension = pathinfo($path, PATHINFO_EXTENSION);
    return $extension;
}

function getData($path)
{
    if (file_exists($path) && is_readable($path)) {
        return file_get_contents($path);
    }
    
}

function boolToStr($bool)
{
    return $bool? 'true' : 'false';
}

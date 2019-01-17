<?php

namespace App\GenDiff;

use Symfony\Component\Yaml\Yaml;

class Parse
{
    public function parse($path, $data)
    {
        switch (self::getFormat($path)) {
        case 'yml':

            return Yaml::parse($data);

            break;
            
        case 'json':

            return json_decode($data, true);

            break;

        default:
            return "unknown format";
            break;
        }
        
    }

    public function getFormat($path) 
    {
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        return $extension;
    }

    public function getData($path)
    {
        if (file_exists($path) && is_readable($path)) {
            return file_get_contents($path);
        }
        

    }

    function boolToStr($bool)
    {
        return $bool? 'true' : 'false';
    }
}
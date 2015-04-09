<?php

namespace Uhull\Helpers;

class Route
{
    public static $controller = "index";
    public static $action = "index";
    
    public static function run()
    {
        
        $parts = array_values(array_filter(explode("/",$_SERVER["REQUEST_URI"])));

        self::$controller = isset($parts[1])?$parts[1]:"index";
        self::$action = isset($parts[2])?$parts[2]:"index";

    }
    
}

?>

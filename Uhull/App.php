<?php
namespace Uhull;

require_once 'Helpers/Html.php';
require_once 'Helpers/Layout.php';
require_once 'Helpers/Route.php';

use Uhull\Helpers\Layout;
use Uhull\Helpers\Route;

class App
{

    public static $data = array();

    public static function run()
    {

        self::loadConfig();
        Route::run();
        return Layout::render();
        
    }

    public static function loadConfig()
    {
        $file = "config.xml";
        $xml = simplexml_load_file($file, 'SimpleXMLElement', LIBXML_NOCDATA);
        self::$data = json_decode(json_encode((array) $xml), TRUE);
    }

    public static function config($key, $default = null)
    {
        return self::array_get(self::$data,$key,$default);
    }
    
    public static function array_get($array, $key, $default = null)
    {
        if (is_null($key))
            return $array;

        if (isset($array[$key]))
            return $array[$key];

        foreach (explode('.', $key) as $segment) {
            if (!is_array($array) || !array_key_exists($segment, $array)) {
                return self::value($default);
            }

            $array = $array[$segment];
        }

        return $array;
    }

    public static function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }

}


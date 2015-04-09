<?php

namespace Uhull\Helpers;

class Html
{

    public static function tag($name, $content = null, $options=array())
    {
        $attributes = "";
        
        foreach ($options as $key => $value) {
            $attributes .= sprintf('%s="%s"', $key, $value);
        }

        if (!is_null($content)) {
            return sprintf("<%s %s>%s</%s>",$name,$attributes,  is_callable($content)?$content():$content,$name);
        }
        else
        {
            return sprintf("<%s %s/>", $name,$attributes);
        }
        
    }

}

?>

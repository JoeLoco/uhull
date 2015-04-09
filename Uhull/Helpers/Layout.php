<?php

namespace Uhull\Helpers;

use Uhull\App;

class Layout
{
     public static function render()
     {
         $html = "<!DOCTYPE html>"; 
         
         $head = Html::tag("head",function(){
             
             $html = "";
             $html .= Html::tag("meta",null,array("charset"=>"utf-8"));
             $html .= Html::tag("meta",null,array("http-equiv"=>"X-UA-Compatible","content"=>"IE=edge"));
             $html .= Html::tag("meta",null,array("name"=>"viewport","content"=>"width=device-width, initial-scale=1"));
             $html .= Html::tag("title",App::config("app.name"));
             
             $html .= Html::tag("link",null,array("href"=>"css/bootstrap.min.css","rel"=>"stylesheet"));

             $html .= "<!--[if lt IE 9]>";
             $html .= Html::tag("script",null,array("src"=>"https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"));
             $html .= Html::tag("script",null,array("src"=>"https://oss.maxcdn.com/respond/1.4.2/respond.min.js"));
             $html .= "<![endif]-->";
             
             return $html; 
         
         });
         
         $body = self::renderBody();
         
         $html .= Html::tag("html",$head.$body,array("lang"=>"en"));
         
         return $html;
     }
     
     public static function renderBody()
     {
         $content = self::renderNav();
         
         $content .= Html::tag("script","",array("src"=>"js/jquery.min.js"));
         $content .= Html::tag("script","",array("src"=>"js/bootstrap.min.js"));
         
         return Html::tag("body",$content);
     }
     
     public static function renderNav()
     {
         
         $button = Html::tag("button",function(){
             
             $content = "";
             $content .=  Html::tag("span","Toggle navigation",array("class"=>"sr-only"));
             $content .=  Html::tag("span","",array("class"=>"icon-bar"));
             $content .=  Html::tag("span","",array("class"=>"icon-bar"));
             $content .=  Html::tag("span","",array("class"=>"icon-bar"));
             return $content;
             
         },array("class"=>"navbar-toggle collapsed","data-toggle"=>"collapse","data-target"=>"navbar-collapse"));
         
         $ul = Html::tag("ul",function(){
             
             $content = "";
             $content .=  Html::tag("li",Html::tag("a","Home",array("href"=>"#")),array("class"=>"active"));
             $content .=  Html::tag("li",Html::tag("a","Item 1",array("href"=>"#")));
             $content .=  Html::tag("li",Html::tag("a","Item 2",array("href"=>"#")));
             
             return $content;
             
         },array("class"=>"nav navbar-nav"));
         
         $dropdown = Html::tag("div",$ul,array("class"=>"collapse navbar-collapse","id"=>"navbar-collapse"));
         
         $brand = Html::tag("a",App::config("app.name"),array("class"=>"navbar-brand"));
         
         $header = Html::tag("div",$button.$brand,array("class"=>"navbar-header"));
         
         $container = Html::tag("div",$header.$dropdown,array("class"=>"container-fluid"));
         
         return Html::tag("nav",$container,array("class"=>"navbar navbar-default navbar-fixed-top"));
     }
     
}

?>

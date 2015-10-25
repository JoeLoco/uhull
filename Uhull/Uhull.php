<?php
require_once 'rb.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Uhull
 *
 * @author joeloco
 */
class Uhull {
    
    public $resource = null;
    
    public function run()
    {   
        $this->init();
        return $this->route();        
    }
    
    private function init()
    {
        R::setup('sqlite:uhull.db');
        R::setAutoResolve(TRUE);        //Recommended as of version 4.2
    }
   
    
    private function route()
    {
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $path = parse_url($url, PHP_URL_PATH);
        $segments = array_values(array_filter(explode('/', $path)));
        
        $this->resource = isset($segments[0])?$segments[0]:null;
        $this->resource_id = isset($segments[1])?$segments[1]:null;
        $this->method = $_SERVER['REQUEST_METHOD'];
        
        //var_dump($segments);
        //var_dump($this->resource);
        //var_dump($this->method);
        
        if(is_null($this->resource))
        {
            return $this->error404();
        }
        
        if(is_null($this->resource_id) && $this->method == "GET")
        {
            return $this->index();
        }
        
        if(is_null($this->resource_id) && $this->method == "POST")
        {
            return $this->store();
        }
        
        return error404();
        
    }
    
    private function error404()
    {
        header("HTTP/1.0 404 Not Found");
        return "Ops! Resource not found";
    }
    
    private function response($result,$data = array())
    {
        header('Content-Type: application/json');
        return json_encode(array(
            "result" => $result,
            "data" => $data,
        ));
    }
    
    private function index()
    {
        $resources = R::findAll($this->resource,"LIMIT 10");
        
        $data = array();
        
        foreach($resources as $resource)
        {
            $data[] = $resource->export();
        }
        
        return $this->response(true,$data);
    }
    
    private function create()
    {
        
    }

    private function store()
    {
        $resource = R::dispense($this->resource);
        
        foreach($_POST as $key => $value)
        {
            $resource->$key = $value;
        }
         
        $id = R::store($resource);
        return $this->response(true,array("id"=>$id));        
    }
    
    
    private function show()
    {
        
    }
    
    private function edit()
    {
        
    }
    
    private function update()
    {
        
    }
    
    private function destroy()
    {
        
    }
    
}

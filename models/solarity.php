<?php

/**

* Solarity
* An all-purpose PHP framework.

* Author: Kimmy Andersson
* Website: http://www.solar-designworks.com/

**/

class SolarityModel
{
    public function load_library($library)
    {
        $result = false;
        $path = SOLARITY_ROOT . 'libraries/' . $library . '/';
        $result = is_dir($path) && include_once($path . 'model.php');
        $result =($path) && include_once($path . 'controller.php');
        
        if(!$result)
        {
            $path = SOLARITY_ROOT . 'libraries/' . $library . '.php';
            $result = is_file($path) && include_once($path);
        }
        
        return $result;
    }
    
    public function bootstrap()
    {
        $tokens = $this->_tokenize_uri($_GET['uri']);
        return $this->_bootstrap($tokens);
    }
    
    private function _tokenize_uri($uri)
    {
        $explode = explode('/', trim($uri, '/'));
        $tokens = array();
        
        $tokens['controller'] = (sizeof($tokens) > 0) ? array_shift($explode) : INDEX;
        $tokens['method'] = (sizeof($tokens) > 0) ? array_shift($explode) : null;
        $tokens['arguments'] = (sizeof($tokens) > 0) ? $explode : array();
        
        return $tokens;
    }
    
    private function _bootstrap($tokens)
    {
        $controller = $tokens['controller'];
        $method = $tokens['method'];
        $arguments = $tokens['arguments'];
        
        $controller_path = APP_ROOT . 'controllers/' . $controller . '.php';
        $model_path = APP_ROOT . 'models/' . $controller . '.php';
        if(!file_exists($path))
        {
            die('debug1');
            //header('Location: ' . APP_URL . 'error/show/404/');
        }
        
        include_once($controller_path);
        @include_once($model_path);
        
        var_dump($tokens);
        $controller = new $controller();
        if(!method_exists($controller, $method))
        {
            die('debug2');
            //header('Location: ' . APP_URL . 'error/show/404/');
        }
        
        call_user_func_array(array($controller, $method), $arguments);
        return $controller;
    }
}

?>
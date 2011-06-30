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
        $path = SOLARITY_ROOT . 'libraries/' . $library . '/';
        if(is_dir($path))
        {
            include_once($path . 'model.php');
            include_once($path . 'controller.php');
            return true;
        }
        
        $path = SOLARITY_ROOT . 'libraries/' . $library . '.php';
        if(is_file($path))
        {
            include_once($path);
            return true;
        }
        
        return false;
    }
    
    public function bootstrap()
    {
        $_GET['uri'] = (!isset($_GET['uri'])) ? '' : $_GET['uri'];
        $tokens = $this->_tokenize_uri($_GET['uri']);
        return $this->_bootstrap($tokens);
    }
    
    private function _tokenize_uri($uri)
    {
        $explode = explode('/', rtrim($uri, '/'));
        $tokens = array();
        
        $tokens['controller'] = ($explode[0] != '') ? array_shift($explode) : INDEX;
        $tokens['method'] = (sizeof($explode) > 0) ? array_shift($explode) : null;
        $tokens['arguments'] = (sizeof($explode) > 0) ? $explode : array();
        
        return $tokens;
    }
    
    private function _bootstrap($tokens)
    {
        $controller = $tokens['controller'];
        $method = $tokens['method'];
        $arguments = $tokens['arguments'];
        
        $controller_path = APP_ROOT . 'controllers/' . $controller . '.php';
        $model_path = APP_ROOT . 'models/' . $controller . '.php';
        
        if(!file_exists($controller_path))
        {
            header('Location: ' . APP_URL . 'error/404/');
        }
        
        include_once($controller_path);
        @include_once($model_path);
        
        $controller = new $controller();
        if($method == null || !method_exists($controller, $method))
        {
			array_unshift($arguments, $method);
			call_user_func_array(array($controller, $controller->method), $arguments);
        }
        else
		{
			call_user_func_array(array($controller, $method), $arguments);
		}
        return $controller;
    }
}

?>
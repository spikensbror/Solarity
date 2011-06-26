<?php

/**

* Solarity
* An all-purpose PHP framework.

* Author: Kimmy Andersson
* Website: http://www.solar-designworks.com/

**/

class Solarity extends Controller
{
    private static $_instance = null;
    public static function get_instance()
    {
        if(self::$_instance == null)
        {
            self::$_instance = new self();
        }
        
        return self::$_instance;
    }
    
    function __construct()
    {
        parent::__construct('SolarityModel', false);
    }
    
    public function initialize($app_root, $index, $app_url)
    {
        define('APP_ROOT', dirname($app_root) . '/'); // Define global app root constant.
        define('INDEX', $index); // Index controller.
        define('APP_URL', $app_url);
    }
    
    public function bootstrap()
    {
        return $this->_model->bootstrap();
    }
    
    public function load_library($library)
    {
        $this->_model->load_library($library);
    }
    
    public function register($library, $class)
    {
        $this->{$library} = $class;
    }
}

?>
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
    
    public function initialize($app_index_file)
    {
        $this->_model->initialize($app_index_file);
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
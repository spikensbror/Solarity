<?php

/**

* Solarity
* An all-purpose PHP framework.

* Author: Kimmy Andersson
* Website: http://www.solar-designworks.com/

**/

class SolarityModel
{
    public function initialize($app_root)
    {
        define('APP_ROOT', $app_root . '/'); // Define global app root constant.
        
        // Automatic .htaccess duplication.
        if(!file_exists(APP_ROOT . '.htaccess'))
        {
            copy(SOLARITY_ROOT . 'htaccess', APP_ROOT . '.htaccess');
        }
    }
    
    public function load_solarity_library($library)
    {
        $this->_load_library($library, SOLARITY_ROOT);
    }
    
    public function load_library($library)
    {
        $this->_load_library($library, APP_ROOT);
    }
    
    private function _load_library($library, $root)
    {
        $path = $root . 'libraries/' . $library . '.php';
        file_exists($path) && include_once($path);
    }
}

?>
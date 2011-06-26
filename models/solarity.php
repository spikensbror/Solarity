<?php

/**

* Solarity
* An all-purpose PHP framework.

* Author: Kimmy Andersson
* Website: http://www.solar-designworks.com/

**/

class SolarityModel
{
    public function initialize($app_index_file)
    {
        define('APP_ROOT', dirname($app_index_file) . '/'); // Define global app root constant.
    }
    
    public function load_library($library)
    {
        $path = SOLARITY_ROOT . 'libraries/' . $library . '/';
        is_dir($path) && include_once($path . 'controller.php');
        is_dir($path) && include_once($path . 'model.php');
    }
}

?>
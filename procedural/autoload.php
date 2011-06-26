<?php

/**

* Solarity
* An all-purpose PHP framework.

* Author: Kimmy Andersson
* Website: http://www.solar-designworks.com/

**/

// Main autoload function. (called from others but never bound)
function _autoload($class, $path)
{
    $path = SOLARITY_ROOT . $path . strtolower($class) . '.php';
    if(!file_exists($path))
    {
        return false;
    }
    
    include_once($path);
    return true;
}

// Model(not-required) and Controller autoload function.
function _mc_autoload($class)
{
    _autoload($class, 'models/'); // Since model's not required, we only try to autoload it.
    return _autoload($class, 'controllers/');
}
spl_autoload_register('_mc_autoload');

// View autoload function.
function _core_autoload($class)
{
    return _autoload($class, 'core/');
}
spl_autoload_register('_core_autoload');

?>
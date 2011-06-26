<?php

/**

* Solarity
* An all-purpose PHP framework.

* Author: Kimmy Andersson
* Website: http://www.solar-designworks.com/

**/

class Controller
{
    private $_model = null;
    private $_view = null;
    
    function __construct($model, $view = true)
    {
        $this->_model = new $model();
        $this->_view = ($view) ? new View() : null;
    }
}

?>
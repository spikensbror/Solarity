<?php

/**
*
* Solarity
* An all-purpose PHP framework.
*
* Author: Kimmy Andersson
* Website: http://www.solar-designworks.com/
*
**/

abstract class Controller
{
    protected $_model = null;
    protected $_view = null;
	public $method = null;
    
    protected function __construct($method = null, $model = null, $view = true)
    {
		$this->method = $method;
        $this->_model = ($model == null) ? $model : new $model();
        $this->_view = ($view) ? new View() : null;
    }
}

?>
<?php

/**

* Solarity
* An all-purpose PHP framework.

* Author: Kimmy Andersson
* Website: http://www.solar-designworks.com/

**/

abstract class Controller
{
    protected $_model = null;
    protected $_view = null;
	public $method = null;
    
    protected function __construct($model = false, $view = true, $method = false)
    {
        $this->_model = (!$model) ? null : new $model();
        $this->_view = ($view) ? new View() : null;
		$this->method = (!$method) ? null : $method;
    }
}

?>
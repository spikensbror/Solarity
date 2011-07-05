<?php

/**
*
* Solarity
* An all-purpose PHP framework.
*
* Author: Kimmy Andersson
* Website: http://www.solar-designworks.com/
*
* Mustache MVC Wrapper
*
**/

class Mustache extends Controller
{
    function __construct()
    {
        parent::__construct(null, 'MustacheModel', false);
    }
    
    public function render($path, $tags, $json = false)
    {
        echo($this->_model->render($path, ($json) ? json_decode($tags) : $tags));
    }
}
Solarity::get_instance()->register('mustache', new Mustache());

?>
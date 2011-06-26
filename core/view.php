<?php

/**

* Solarity
* An all-purpose PHP framework.

* Author: Kimmy Andersson
* Website: http://www.solar-designworks.com/

**/

class View
{
    private $_tags = array();
    
    function __construct()
    {
        Solarity::get_instance()->load_library('mustache');
        
        $this->add_tags
        (
            array
            (
                'APP_URL' => APP_URL
            );
        );
    }
    
    public function add_tags($tags)
    {
        $this->_tags = array_merge($this->_tags, $tags);
    }
    
    public function render($view, $tags = false, $extras = true)
    {
        $path = APP_ROOT . 'views/' . $view . '.php';
        if(!file_exists($path))
        {
            return false;
        }
        
        ($extras) ? $this->render('core/header', false, false) : null;
        echo(Solarity::get_instance()->mustache->render($view, (!$tags) ? $this->_tags : array_merge($this->_tags, $tags)));
        ($extras) ? $this->render('core/footer', false, false) : null;
    }
}

?>
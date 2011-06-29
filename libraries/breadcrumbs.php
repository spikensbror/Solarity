<?php

/**

* Solarity
* An all-purpose PHP framework.

* Author: Kimmy Andersson
* Website: http://www.solar-designworks.com/

* Breadcrumbs Library

**/

class Breadcrumbs
{
    private $_breadcrumbs = array();
    private $_format = array('breadcrumb', 'url');
    
    public function set_format($format = null)
    {
        if(is_array($format) && sizeof($format) == 2)
        {
            $this->_format = $format;
        }
    }
    
    public function add($breadcrumb, $uri)
    {
        $this->_breadcrumbs[] = array($this->_format[0] => $breadcrumb, $this->_format[1] => APP_URL . $uri);
    }
    
    public function get()
    {
        return $this->_breadcrumbs;
    }
    
}
Solarity::get_instance()->register('breadcrumbs', new Breadcrumbs());

?>
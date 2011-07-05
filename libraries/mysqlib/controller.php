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

class MySQLib extends Controller
{
    function __construct()
    {
        parent::__construct(null, 'MySQLibModel', false);
    }
    
    public function connect($id, $server, $username, $password, $database)
    {
        return $this->_model->connect($id, $server, $username, $password, $database);
    }
    
    public function get($id)
    {
        return $this->_model->get($id);
    }
    
    public function close($id)
    {
        return $this->_model->close($id);
    }
}
Solarity::get_instance()->register('mysqlib', new MySQLib());

?>
<?php

/**

* Solarity
* An all-purpose PHP framework.

* Author: Kimmy Andersson
* Website: http://www.solar-designworks.com/

* Mustache MVC Wrapper

**/

class MySQLibModel
{
    private $_server_pool = array();
    
    function __destruct()
    {
        while(sizeof($this->_server_pool) > 0)
        {
            $object = array_pop($this->_server_pool);
            $object->close();
            unset($object);
        }
    }
    
    public function connect($id, $server, $username, $password, $database)
    {
        if(!isset($this->_server_pool[$id]))
        {
            $connection = new MySQLibConnection($server, $username, $password, $database);
            if($connection->is_error())
            {
                unset($connection);
            }
            else
            {
                $this->_server_pool[$id] = $connection;
            }
        }
        
        return $this->get($id);
    }
    
    public function get($id)
    {
        return (isset($this->_server_pool[$id])) ? $this->_server_pool[$id] : false;
    }
    
    public function close($id)
    {
        if(!$this->get($id))
        {
            return false;
        }
        
        $this->get($id)->close();
        unset($this->_server_pool[$id]);
        
        return true;
    }
}

class MySQLibConnection
{
    private $_connection = null;
    private $_error = false;
    
    function __construct($server, $username, $password, $database)
    {
        $connection = @mysql_connect($server, $username, $password);
        $database = @mysql_select_db($database, $connection);
        if(!$connection || !$database)
        {
            $this->_error = true;
            unset($connection);
            unset($database);
        }
        else
        {
            $this->_connection = $connection;
        }
    }
    
    public function is_error()
    {
        return $this->_error;
    }
    
    public function close()
    {
        return @mysql_close($this->_connection);
    }
    
    public function query($string, $arguments = array())
    {
        if(sizeof($arguments) != substr_count($string, '?'))
        {
            return false;
        }
        foreach($arguments as $argument)
        {
            $argument = $this->_sanitize($argument);
            $string = preg_replace('/\?/', $argument, $string, 1);
        }
        
        return mysql_query($string, $this->_connection);
    }
    
    public function fetch($string, $arguments = array())
    {
        $query = $this->query($string, $arguments);
        if(!$query)
        {
            return false;
        }
        
        $buffer = array();
        while($fetch = mysql_fetch_assoc($query))
        {
            foreach($fetch as $key => &$value)
            {
                $value = $this->_desanitize($value);
            }
            $buffer[] = $fetch;
        }
        
        return $buffer;
    }
    
    private function _sanitize($string)
    {
        return mysql_real_escape_string((get_magic_quotes_gpc()) ? stripslashes($string) : $string);
    }
    
    public function _desanitize($string)
    {
        return stripslashes($string);
    }
}

?>
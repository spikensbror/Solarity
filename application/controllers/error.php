<?php

class Error extends Controller
{
    function __construct()
    {
        parent::__construct();
    }
    
    public function show($error)
    {
        $this->_view->render('error/' . $error);
    }
}

?>
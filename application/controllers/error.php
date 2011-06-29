<?php

class Error extends Controller
{
    function __construct()
    {
        parent::__construct('show');
    }
    
    public function show($error)
    {
        $this->_view->render('error/' . $error);
    }
}

?>
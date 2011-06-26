<?php

class Error extends Controller
{
    function __construct()
    {
        parent::__construct(null);
    }
    
    public function show($error)
    {
        $this->_view->render('error/' . $error);
    }
}

?>
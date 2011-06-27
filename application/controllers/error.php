<?php

class Error extends Controller
{
    function __construct()
    {
        parent::__construct(false, true, 'show');
    }
    
    public function show($error)
    {
        $this->_view->render('error/' . $error);
    }
}

?>
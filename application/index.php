<?php

/**

* Solarity
* An all-purpose PHP framework.

* Author: Kimmy Andersson
* Website: http://www.solar-designworks.com/

**/

// Include solarity. (change to the root solarity php file)
include_once('../solarity.php');

// Initialize. (change index_controller to your index controller and the url to the url of your application)
Solarity::get_instance()->initialize(__FILE__, 'index_controller', 'http://solarity/');

// Bootstrap. (returns the controller given determined)
$application = Solarity::get_instance()->bootstrap();

?>
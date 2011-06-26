<?php

/**

* Solarity
* An all-purpose PHP framework.

* Author: Kimmy Andersson
* Website: http://www.solar-designworks.com/

**/

// Include solarity. (change to the root solarity php file)
include_once('../solarity.php');

// Initialize and bootstrap.
Solarity::get_instance()->initialize(__FILE__);
Solarity::get_instance()->bootstrap();

?>
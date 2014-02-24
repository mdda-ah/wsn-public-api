<?php

class API {

	function hello() {
    echo 'Hi there! This is the MDDA WSN API v1.0. Glad to be of service.';
	}

}

$f3 = require('../lib/base.php');

$f3->route('GET /', 'API->hello');

$f3->run();

?>
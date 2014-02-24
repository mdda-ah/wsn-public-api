<?php

$f3 = require('../lib/base.php');

$f3->route('GET /',
    function() {
        echo 'Hi there! This is the MDDA WSN API v1.0. Glad to be of service.';
    }
);

$f3->run();

?>
<?php

/*
Include Fat Free Framework
*/
$f3 = require('../lib/base.php');

/*
Include application classes
*/
$f3->set('AUTOLOAD', '../classes/');

/*
Include configuration files
Setup
Routes and maps
*/
$f3->config('../config/setup.cfg');
$f3->config('../config/routesmaps.cfg');

/*
Run Fat Free Framework
*/
$f3->run();

?>
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
Create the database object and connection
*/
$db = new DB\SQL(
	$f3->get('dbc.host'),
	$f3->get('dbc.user'),
	$f3->get('dbc.pass')
);

/*
Run Fat Free Framework
*/
$f3->run();

/*
Destroy the database object
*/
unset($db);

?>
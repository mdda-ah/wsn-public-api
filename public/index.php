<?php

/*
Include Fat Free Framework
*/
$f3 = require('../lib/base.php');

/*
Include configuration files
Setup
Routes and maps
Database
Debug flag - on development copy only
*/
$f3->config('../config/setup.cfg');
$f3->config('../config/routesmaps.cfg');
$f3->config('../config/db.cfg');
try {
	$f3->config('../config/debug.cfg');
} catch (\ErrorException $e) {
	//	This is my care face
}

/*
Run Fat Free Framework
*/
$f3->run();

/*
Destroy the database object
*/
unset($db);

?>
<?php

//	Set timezone for this app to UTC
date_default_timezone_set('UTC');

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
Custom error handler
*/
$f3->set('ONERROR',
  function($f3) {
		$tmp = array();
		$tmp["message"] = sprintf(
			"%s. %s. Please see the API documentation at http://wsn-api.manchesterdda.net/docs/",
			$f3->get('ERROR.status'),
			$f3->get('ERROR.text')
		);
		$f3->status($f3->get('ERROR.code'));

		header('Content-Type: application/json');
		echo json_encode($tmp, JSON_NUMERIC_CHECK);

		unset($tmp);
  }
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
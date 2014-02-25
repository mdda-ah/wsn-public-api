<?php

/*
Include Fat Free Framework and application classes
*/
$f3 = require('../lib/base.php');
$f3->set('AUTOLOAD', '../classes/');

/*
Util methods

GET		/
GET 	/ping
*/
$f3->route('GET @hello: /', 'Util->hello');
$f3->route('GET @ping: /ping', 'Util->ping');

/*
Info methods

GET		/units/info/all
GET		/units/info/sensor_types
GET		/units/info/@id
*/
$f3->route('GET @units_info_all: /units/info/all', 'Info->all');
$f3->route('GET @units_info_sensor_types: /units/info/sensor_types', 'Info->sensor_types');
$f3->map('/units/info/@id', 'Info');

/*
Data methods

GET		/data/all
GET		/data/@id
*/
$f3->route('GET @data_all: /units/data/all', 'Data->all');
$f3->map('/units/data/@id',	'Data');

/*
Run Fat Free Framework
*/
$f3->run();

?>
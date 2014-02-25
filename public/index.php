<?php

/*
Include Fat Free Framework and application classes
*/
$f3 = require('../lib/base.php');
$f3->set('AUTOLOAD', '../classes/');

/*
Util methods
hello
ping
*/
$f3->route('GET @hello: /', 'Util->hello');
$f3->route('GET @ping: /ping', 'Util->ping');

/*
Info methods
unit/@id
units
sensor_types
*/
$f3->route('GET @info_units: /info/@action', 'Info->@action');
$f3->route('GET @info_unit: /info/@action/@id', 'Info->@action');

/*
Data methods
all
unit/@id
*/
$f3->route('GET @data_all: /data/@action', 'Data->@action');
$f3->route('GET @data_unit: /data/@action/@id',	'Data->@action');

/*
Run Fat Free Framework
*/
$f3->run();

?>
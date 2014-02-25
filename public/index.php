<?php

$f3 = require('../lib/base.php');
$f3->set('AUTOLOAD', '../classes/');

//	Util methods
$f3->route('GET @hello: /', 'Util->hello');
$f3->route('GET @ping: /util/ping', 'Util->ping');

//	Info methods
$f3->route('GET @info_units: /info/units', 'Info->units');
$f3->route('GET @info_unit: /info/unit/@id', 'Info->unit');
$f3->route('GET @info_sensor_types: /info/sensortypes', 'Info->sensor_types');

//	Data methods
$f3->route('GET @data_all: /data/all', 'Data->all');
$f3->route('GET @data_unit: /data/unit/@id', 'Data->unit');

$f3->run();

?>
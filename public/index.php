<?php

class API {

	function hello() {
    echo 'Hi there! This is the MDDA WSN API v1.0. Glad to be of service.';
	}

	function ping() {
    echo 'OK';
	}

	function info_units() {
		echo 'info/units';
	}

	function info_unit($f3) {
		$id = $f3->get('PARAMS.id');
		echo 'info/unit/' . $id;
	}

	function info_sensor_types() {
		echo 'info/sensortypes';
	}

	function data_all() {
		echo 'data/all';
	}

	function data_unit($f3) {
		$id = $f3->get('PARAMS.id');
		echo 'data/unit/' . $id;
	}

}

$f3 = require('../lib/base.php');

$f3->route('GET @root: /', 'API->hello');;

$f3->route('GET @ping: /util/ping', 'API->ping');

$f3->route('GET @info_units: /info/units', 'API->info_units');

$f3->route('GET @info_unit: /info/unit/@id', 'API->info_unit');

$f3->route('GET @info_sensor_types: /info/sensortypes', 'API->info_sensor_types');

$f3->route('GET @data_all: /data/all', 'API->data_all');

$f3->route('GET @data_unit: /data/unit/@id', 'API->data_unit');

$f3->run();

?>
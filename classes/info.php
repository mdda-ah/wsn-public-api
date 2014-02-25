<?php

class Info {

	function get($f3) {
		$id = $f3->get('PARAMS.id');
		echo '/units/info/' . $id;
	}

	function all() {
		echo '/units/info/all';
	}

	function sensor_types() {
		echo '/units/info/sensor_types';
	}

}

?>
<?php

class Info {

	function units() {
		echo 'info/units';
	}

	function unit($f3) {
		$id = $f3->get('PARAMS.id');
		echo 'info/unit/' . $id;
	}

	function sensor_types() {
		echo 'info/sensor_types';
	}

}

?>
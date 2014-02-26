<?php

class Info {

	function get($f3) {
		$id = $f3->get('PARAMS.id');
		echo '/units/info/' . $id;
	}

	function all() {
		echo '/units/info/all';
	}

	function sensor_types($f3) {
		$helper = new Helper();

		$f3->set(
			'response_data',
			$f3->get('sensor_types')
		);

		$helper->send_response($f3);
	}

}

?>
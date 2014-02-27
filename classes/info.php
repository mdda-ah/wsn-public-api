<?php

class Info {

	function get($f3) {
		global $db;

		$helper = new Helper();

		$f3->set(
			'result',
			$db->exec(
				$f3->get('dbq.info_get'),
				array (
					':device_id' => $f3->get('PARAMS.id')
				)
			)
		);

		$f3->set(
			'response_data',
			($f3->get('result') ? $f3->get('result') : "No results")
		);

		$helper->send_response($f3);
	}

	function all($f3) {
		global $db;

		$helper = new Helper();

		$helper->set_database_query_limit($f3);

		$f3->set(
			'result',
			$db->exec(
				$f3->get('dbq.info_all'),
				$f3->get('database_query_limit')
			)
		);

		$f3->set(
			'response_data',
			($f3->get('result') ? $f3->get('result') : "No results")
		);

		$helper->send_response($f3);
	}

	function sensor_types($f3) {
		global $db;

		$helper = new Helper();

		$f3->set(
			'result',
			$db->exec(
				$f3->get('dbq.info_sensor_types')
			)
		);

		$f3->set(
			'response_data',
			($f3->get('result') ? $f3->get('result') : "No results")
		);

		$helper->send_response($f3);
	}

}

?>
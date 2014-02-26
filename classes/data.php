<?php

class Data {

	function get($f3) {
		global $db;

		$helper = new Helper();

		$helper->set_database_query_limit($f3);

		$f3->set(
			'result',
			$db->exec(
				'SELECT * FROM readings WHERE device_id=:device_id LIMIT 0,:database_query_limit',
				array (
					':device_id' => $f3->get('PARAMS.id'),
					':database_query_limit' => $f3->get('database_query_limit')
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
				'SELECT * FROM readings LIMIT 0,?',
				$f3->get('database_query_limit')
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
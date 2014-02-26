<?php

class Data {

	function get($f3) {
		$id = $f3->get('PARAMS.id');
		echo '/units/data/' . $id;
	}

	function all($f3) {
		$helper = new Helper();

		$db = new DB\SQL(
			'mysql:host=localhost;port=3306;dbname=sensors',
			'sensors',
			'sensors23'
		);

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
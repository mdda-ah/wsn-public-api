<?php

class Data {

	function get($f3) {
		$id = $f3->get('PARAMS.id');
		echo '/units/data/' . $id;
	}

	function all($f3) {
		$db = new DB\SQL(
			'mysql:host=localhost;port=3306;dbname=sensors',
			'sensors',
			'sensors23'
		);

		//	Get the limit parameter from the request, if present. If NAN or less than 1 then use the default limit.
		$f3->set(
			'database_query_limit',
			(
				//	Check that GET.limit is a number
				preg_match("/[0-9]/us", $f3->get('GET.limit'))
				//	Check that GET.limit is greater than 0 and ensure does not exceed maximum query limit
				? ($f3->get('GET.limit') > 0 ? min((int)$f3->get('GET.limit'),(int)$f3->get('db_defaults["query_limit_max"]')) : (int)$f3->get('db_defaults["query_limit"]'))
				//	Use the default query limit
				: (int)$f3->get('db_defaults["query_limit"]')
			)
		);

		$f3->set(
			'result',
			$db->exec(
				'SELECT * FROM readings LIMIT 0,?',
				$f3->get('database_query_limit')
			)
		);

		$response_data = ($f3->get('result') ? $f3->get('result') : "No results");

	 	header('Content-Type: application/json');
		echo json_encode($response_data);
	}

}

?>
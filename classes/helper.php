<?php

class Helper {

	//	Get the limit parameter from the request, if present. If NAN or less than 1 then use the default limit.
	function set_database_query_limit($f3) {
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
	}

	function send_response($f3) {
	 	header('Content-Type: application/json');
		echo json_encode($f3->get('response_data'), JSON_NUMERIC_CHECK);
	}

}

?>
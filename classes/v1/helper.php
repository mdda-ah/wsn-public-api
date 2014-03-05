<?php

namespace v1;

class Helper {

	//	Get the limit parameter from the request, if present. If NAN or less than 1 then use the default limit.
	function set_database_query_limit($f3) {
		$f3->set(
			'database_query_limit',
			(
				//	Check that GET.limit is a number
				preg_match("/[0-9]/us", $f3->get('GET.limit'))
				//	Check that GET.limit is greater than 0 and ensure does not exceed maximum query limit
				? (
						$f3->get('GET.limit') > 0
						? min((int)$f3->get('GET.limit'),(int)$f3->get('db_defaults.query_limit_max'))
						: (int)$f3->get('db_defaults.query_limit')
					)
				//	Use the default query limit
				: (int)$f3->get('db_defaults.query_limit')
			)
		);
	}

	//	Get the sensor_type_id parameter from the request, if present. If NAN or less than 1 then set to null
	function set_sensor_type_id($f3) {
		$f3->set(
			'sensor_type_id',
			(preg_match("/[0-9]/us", $f3->get('GET.sensor_type_id')) ? $f3->get('GET.sensor_type_id') : null)
		);
	}

	function send_response($f3) {
	 	header('Content-Type: application/json');

	 	$to_send = array();

	 	$to_send["message"] = $f3->get('response_message');

	 	if ($f3->get('response_data') != null) {
		 	$to_send["data"] = $f3->get('response_data');
	 	}

		echo json_encode($to_send, JSON_NUMERIC_CHECK);

		unset($to_send);
	}

}

?>
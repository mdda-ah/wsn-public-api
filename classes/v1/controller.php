<?php

namespace v1;

class Controller {

	protected
		$db;

	function __construct() {

		$f3 = \Base::instance();

		// Create the database object and connection
		$db = new \DB\SQL(
			$f3->get('db.host'),
			$f3->get('db.user'),
			$f3->get('db.pass')
		);

		$this->db = $db;

	}

	function beforeroute($f3) {
	}

	function afterroute($f3) {
	 	$tmp = array();

	 	$tmp["message"] = $f3->get('wsn.message');
	 	if ($f3->get('wsn.data') != null) {$tmp["data"] = $f3->get('wsn.data');}

	 	header('Content-Type: application/json');
		echo json_encode($tmp, JSON_NUMERIC_CHECK);

		unset($tmp);
	}

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

}

?>
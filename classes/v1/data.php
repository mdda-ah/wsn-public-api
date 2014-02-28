<?php

namespace v1;

class Data {

	function get($f3) {
		global $db;

		$helper = new Helper();

		$helper->set_database_query_limit($f3);

		$f3->set(
			'result',
			$db->exec(
				'select coordcounter, datetime, device_id, reading, nodecounter, sensor_id from readings where device_id=:device_id and sensor_id in (select sensor_type_id from sensors where sensors.available=1 and sensors.device_id=readings.device_id) order by datetime desc limit 0,:database_query_limit',
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
				'select coordcounter, datetime, device_id, reading, nodecounter, sensor_id from readings where sensor_id in (select sensor_type_id from sensors where sensors.available=1 and sensors.device_id=readings.device_id) order by datetime desc limit 0,?',
				$f3->get('database_query_limit')
			)
		);

		$f3->set(
			'response_data',
			($f3->get('result') ? $f3->get('result') : "No results")
		);

		$helper->send_response($f3);
	}

	function latest($f3) {
		global $db;

		$helper = new Helper();

		$helper->set_database_query_limit($f3);

		$f3->set(
			'result',
			$db->exec(
				'select coordcounter, datetime, device_id, reading, nodecounter, sensor_id from readings where readings.id in (select * from (select max(readings.id) from readings group by readings.device_id, readings.sensor_id) as subquery) and sensor_id in (select sensor_type_id from sensors where sensors.available=1 and sensors.device_id=readings.device_id) order by device_id asc, datetime desc'
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
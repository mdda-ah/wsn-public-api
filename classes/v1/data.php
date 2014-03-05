<?php

namespace v1;

class Data {

	function get($f3) {
		global $db;

		$helper = new Helper();

		$helper->set_database_query_limit($f3);
		$helper->set_sensor_type_id($f3);

		if ($f3->get('sensor_type_id') == null) {
			$f3->set(
				'result',
				$db->exec(
					'select datetime, device_id, sensor_id, value, bounds_flag, latitude, longitude, elevation_above_ground, nodecounter, coordcounter from readings where device_id=:device_id and sensor_id in (select sensor_type_id from sensors where sensors.available=1 and sensors.device_id=readings.device_id) order by datetime desc limit 0,:database_query_limit',
					array (
						':device_id' => $f3->get('PARAMS.id'),
						':database_query_limit' => $f3->get('database_query_limit')
					)
				)
			);
		} else {
			$f3->set(
				'result',
				$db->exec(
					'select datetime, device_id, sensor_id, value, bounds_flag, latitude, longitude, elevation_above_ground, nodecounter, coordcounter from readings where device_id=:device_id and sensor_id=:sensor_type_id and sensor_id in (select sensor_type_id from sensors where sensors.available=1 and sensors.device_id=readings.device_id) order by datetime desc limit 0,:database_query_limit',
					array (
						':device_id' => $f3->get('PARAMS.id'),
						':database_query_limit' => $f3->get('database_query_limit'),
						':sensor_type_id' => $f3->get('sensor_type_id')
					)
				)
			);
		}


		if ($f3->get('result')) {

			$f3->set(
				'response_message',
				'OK'
			);
			$f3->set(
				'response_data',
				$f3->get('result')
			);

		} else {

			$f3->set(
				'response_message',
				"No results. Please refer to /v1/units/info/all method to get a list of device_ids to use for this method as /v1/units/data/device_id"
			);
			$f3->set(
				'response_data',
				null
			);

		}

		$helper->send_response($f3);
	}

	function all($f3) {
		global $db;

		$helper = new Helper();

		$helper->set_database_query_limit($f3);
		$helper->set_sensor_type_id($f3);

		if ($f3->get('sensor_type_id') == null) {
			$f3->set(
				'result',
				$db->exec(
					'select datetime, device_id, sensor_id, value, bounds_flag, latitude, longitude, elevation_above_ground, nodecounter, coordcounter from readings where sensor_id in (select sensor_type_id from sensors where sensors.available=1 and sensors.device_id=readings.device_id) order by datetime desc limit 0,?',
					$f3->get('database_query_limit')
				)
			);
		} else {
			$f3->set(
				'result',
				$db->exec(
					'select datetime, device_id, sensor_id, value, bounds_flag, latitude, longitude, elevation_above_ground, nodecounter, coordcounter from readings where sensor_id=:sensor_type_id and sensor_id in (select sensor_type_id from sensors where sensors.available=1 and sensors.device_id=readings.device_id) order by datetime desc limit 0,:database_query_limit',
					array (
						':database_query_limit' => $f3->get('database_query_limit'),
						':sensor_type_id' => $f3->get('sensor_type_id')
					)
				)
			);
		}

		if ($f3->get('result')) {

			$f3->set(
				'response_message',
				'OK'
			);
			$f3->set(
				'response_data',
				$f3->get('result')
			);

		} else {

			$f3->set(
				'response_message',
				"No results."
			);
			$f3->set(
				'response_data',
				null
			);

		}
		$helper->send_response($f3);
	}

	function latest($f3) {
		global $db;

		$helper = new Helper();

		$helper->set_database_query_limit($f3);

		$f3->set(
			'result',
			$db->exec(
				'select datetime, device_id, sensor_id, value, bounds_flag, latitude, longitude, elevation_above_ground, nodecounter, coordcounter from readings where readings.id in (select * from (select max(readings.id) from readings group by readings.device_id, readings.sensor_id) as subquery) and sensor_id in (select sensor_type_id from sensors where sensors.available=1 and sensors.device_id=readings.device_id) order by device_id asc, datetime desc'
			)
		);

		if ($f3->get('result')) {

			$f3->set(
				'response_message',
				'OK'
			);
			$f3->set(
				'response_data',
				$f3->get('result')
			);

		} else {

			$f3->set(
				'response_message',
				"No results."
			);
			$f3->set(
				'response_data',
				null
			);

		}
		$helper->send_response($f3);
	}

}

?>
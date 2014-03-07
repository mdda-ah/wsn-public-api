<?php

namespace v1;

class Info extends Controller {

	function get($f3,$params) {

		$f3->set(
			'result',
			$this->db->exec(
				'select device_id, location_name, longitude, latitude, elevation_above_ground, date_deployed, (select group_concat(sensor_type_id) from sensors where device_id=:device_id and sensors.available=1) as sensor_types_available from devices where device_id=:device_id',
				array (
					':device_id' => $params["id"]
				)
			)
		);

		if ($f3->get('result')) {

			$f3->set(
				'wsn.message',
				'OK'
			);
			$f3->set(
				'wsn.data',
				$f3->get('result')
			);

		} else {

			$f3->set(
				'wsn.message',
				"No results. Please refer to /v1/units/info/all method to get a list of device_ids to use for this method as /v1/units/info/device_id"
			);
			$f3->set(
				'wsn.message',
				null
			);

		}
	}

	function all($f3) {

		$this->set_database_query_limit($f3);

		$f3->set(
			'result',
			$this->db->exec(
				'select device_id, location_name, longitude, latitude, elevation_above_ground, date_deployed, (select group_concat(sensor_type_id) from sensors where sensors.device_id=devices.device_id and sensors.available=1) as sensor_types_available from devices order by device_id asc limit 0,?',
				$f3->get('database_query_limit')
			)
		);

		if ($f3->get('result')) {

			$f3->set(
				'wsn.message',
				'OK'
			);
			$f3->set(
				'wsn.data',
				$f3->get('result')
			);

		} else {

			$f3->set(
				'wsn.message',
				'No results.'
			);
			$f3->set(
				'wsn.data',
				null
			);

		}

	}

	function sensor_types($f3) {

		$f3->set(
			'result',
			$this->db->exec(
				'select sensor_type_id, name, data_type, bounds_low, bounds_high from sensor_types order by sensor_type_id asc'
			)
		);

		if ($f3->get('result')) {
			$f3->set(
				'wsn.message',
				'OK'
			);
			$f3->set(
				'wsn.data',
				$f3->get('result')
			);
		} else {
			$f3->set(
				'wsn.message',
				'No results.'
			);
			$f3->set(
				'wsn.data',
				null
			);
		}

	}

}

?>
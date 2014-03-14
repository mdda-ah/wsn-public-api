<?php

namespace v1;

class Status extends Controller {

	function battery($f3) {
		$this->check_database_is_up($f3);

		$f3->set(
			'result',
			$this->db->exec(
				'select readings.device_id, devices.location_name, readings.datetime, readings.value as battery_charge from readings, devices where readings.id in (select * from (select max(readings.id) from readings group by readings.device_id, readings.sensor_id) as subquery) and sensor_id=999 and sensor_id in (select sensor_type_id from sensors where sensors.available=1 and sensors.device_id=readings.device_id) and readings.device_id=devices.device_id order by device_id asc, datetime desc'
			)
		);

		if ($f3->get('result')) {
			$f3->mset(array(
	    	'wsn.message'	=>	$f3->get('message_ok'),
				'wsn.data'		=>	$f3->get('result')
	    ));
		} else {
			$f3->mset(array(
	    	'wsn.message'	=>	$f3->get('message_no_results'),
				'wsn.data'		=>	null
			));
		}

	}

}

?>
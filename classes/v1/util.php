<?php

namespace v1;

class Util {

	function hello($f3) {
		$helper = new Helper();

		$f3->set(
			'response_message',
			'Hi. This is the MDDA Wireless Sensor Network API v1.0'
		);

		$f3->set(
			'response_data',
			null
		);

		$helper->send_response($f3);
	}

	function ping($f3) {
		$helper = new Helper();

		$f3->set(
			'response_message',
			'OK'
		);

		$f3->set(
			'response_data',
			null
		);

		$helper->send_response($f3);
	}

}

?>
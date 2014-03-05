<?php

namespace v1;

class Util {

	function hello($f3) {
		$helper = new Helper();

		$f3->set(
			'response_data',
			'Hi there! This is the MDDA WSN API v1.0.'
		);

		$helper->send_response($f3);
	}

	function ping($f3) {
		$helper = new Helper();

		$f3->set(
			'response_data',
			'OK'
		);

		$helper->send_response($f3);
	}

}

?>
<?php

namespace v1;

class Util extends Controller {

	function hello($f3) {
		$f3->set(
			'wsn.message',
			'Hi. This is the MDDA Wireless Sensor Network API v1.0'
		);

		$f3->set(
			'wsn.data',
			null
		);
	}

	function ping($f3) {
		$f3->set(
			'wsn.message',
			'OK'
		);

		$f3->set(
			'wsn.data',
			null
		);
	}

}

?>
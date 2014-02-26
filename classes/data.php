<?php

class Data {

	function get($f3) {
		$id = $f3->get('PARAMS.id');
		echo '/units/data/' . $id;
	}

	function all($f3) {
		$db = new DB\SQL(
			'mysql:host=localhost;port=3306;dbname=sensors',
			'sensors',
			'sensors23'
		);

		$f3->set(
			'result',
			$db->exec(
				'SELECT * FROM readings LIMIT 0,?',
				25
			)
		);

  	header('Content-Type: application/json');
		echo json_encode($f3->get('result'));
	}

}

?>
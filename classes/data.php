<?php

class Data {

	function get($f3) {
		$id = $f3->get('PARAMS.id');
		echo '/units/data/' . $id;
	}

	function all() {
		echo '/units/data/all';
	}

}

?>
<?php

class Data {

	function all() {
		echo 'data/all';
	}

	function unit($f3) {
		$id = $f3->get('PARAMS.id');
		echo 'data/unit/' . $id;
	}

}

?>
<?php

namespace v1;

class Util extends Controller {

	function hello($f3) {
		$f3->mset(array(
    	'wsn.message'	=>	$f3->get('message_hi'),
			'wsn.data'		=>	null
    ));
	}

	function ping($f3) {
		$this->check_database_is_up($f3);
		$f3->mset(array(
    	'wsn.message'	=>	$f3->get('message_ok'),
			'wsn.data'		=>	null
    ));
	}

}

?>
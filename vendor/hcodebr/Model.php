<?php

namespace Hcode;

class Model {
	
	private $value = [];

	public function __call($name, $args)
	{

		$method = substr($name, 0, 3);
		$fieldName = substr($name, 3, strlen($name));

		//var_damp($method, $fieldName);
		exit;
	}
}

?>
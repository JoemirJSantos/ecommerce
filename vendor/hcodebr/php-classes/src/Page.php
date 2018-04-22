<?php

namespace Hcode;

use Rain\Tpl;

class Page{

	private $tpl;
	private $options;
	private $defaults = [
		"data"=>[]
	];

	//metodo construtor
	public  function __construct($opts = array()){

		//se não passar parametro no $opts ele pegar o $defaults, havendo conflito
		//ele pega o valor passado em $opts (sobrescreve)
		$this->options = array_merge($this->defaults,$opts);
		
		// config
		$config = array(
			"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/views/",
			"cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
			"debug"         => false // set to false to improve the speed
		 );

		Tpl::configure( $config );

		$this->tpl = new Tpl;

		$this->setData($this->options["data"]);

		$this->tpl->draw("header");

	}

	private function setData($data = array())
	{
		foreach ($data as $key => $value) {
			$this->tpl->assign($key,$value);
		}
	}

	public function setTpl($name, $data = array(), $returnHTML = false){

		$this->setData($data);

		return $this->tpl->draw($name, $returnHTML);


	}

	public function __destruct(){

		$this->tpl->draw("footer");


	}
}

?>
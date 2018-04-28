<?php

//extendendo a classe Page
namespace Hcode;
//herança -> acessamos tudo que é publico e protegido na classe Page
class PageAdmin extends Page{

	public  function __construct($opts = array(), $tpl_dir = "/views/admin/")
	{
		//chamando o construtor da classe Page.
		// parent:: -> pegando da herança, chmando o construtor da classe pai
		parent::__construct($opts,$tpl_dir); 
	}


}

?>
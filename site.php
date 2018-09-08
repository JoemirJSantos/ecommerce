<?php

use \Hcode\Page;
use \Hcode\Model\Product;

$app->get('/', function() {

	$products = Product::listAll();
    
	$page = new Page(); // vai chamar o construtct

	$page->setTpl("index", [
		'products'=>Product::checkList($products)
	]); // apos esta linha vai chamar o destruct da classe Page
 
	// $sql = new Hcode\DB\Sql(); --> utilizado o use para localizar na linha 6
	// $sql = new Sql();
	// $resuts = $sql->select("SELECT * FROM tb_users");	
	// echo json_encode($resuts);

});

?>
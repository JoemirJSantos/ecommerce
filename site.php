<?php

use \Hcode\Page;
use \Hcode\Model\Product;
use \Hcode\Model\Category;

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


$app->get("/categories/:idcategory", function($idcategory){

	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	$category = new Category();

	$category->get((int)$idcategory);
	// por parametros seria: $pagination = $category->getProductsPage($page, $itemsPerPage);
	$pagination = $category->getProductsPage($page);

	$pages = [];

	for ($i=1; $i <= $pagination['pages'] ; $i++) { 
		array_push($pages, [
			'link' => '/categories/'.$category->getidcategory().'?page='. $i,
			'page' => $i

		]);
		
	}

	$page = new Page();

	$page->setTpl("category", [
		'category'=>$category->getValues(), 
		'products'=>$pagination["data"],
		'pages'=>$pages
	]);
});

$app->get("/products/:desurl", function($desurl){
	
	$product = new Product();

	$product->getFromURL($desurl);

	$page = new Page();

	$page->setTpl("product-detail",[
		'product'=>$product->getValues(),
		'categories'=>$product->getCategories()
	]);

});


?>
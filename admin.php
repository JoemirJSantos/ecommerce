<?php

use \Hcode\PageAdmin;
use \Hcode\Model\User;


$app->get('/admin', function() {
    
    User::verifyLogin();

	$page = new PageAdmin(); // vai chamar o construtct

	$page->setTpl("index"); // apos esta linha vai chamar o destruct da classe Page

});

$app->get('/admin/login', function() {
    
	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]); // vai chamar o construtct

	$page->setTpl("login"); // apos esta linha vai chamar o destruct da classe Page

});

$app->post('/admin/login', function(){
   
 	User::login($_POST["login"], $_POST["password"]);
 	
 	header("Location: /admin"); //redireciona a para esta pagina
 	exit;

});

$app->get('/admin/logout', function(){

	User::logout();

	header("Location: /admin/login");
	exit;
});

// pode se usar aspas simples ou duplas na rotas
$app->get("/admin/forgot", function(){

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]); // vai chamar o construtct


	$page->setTpl("forgot");

});

$app->post("/admin/forgot", function(){
	// recebendo o post do campo email do arquivo forgot.html nesta rota.
	$user = User::getForgot($_POST["email"]); 

	header("Location:/admin/forgot/sent");
	exit;

});

$app->get("/admin/forgot/sent", function(){
	
	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]); 

	$page->setTpl("forgot-sent");

});

$app->get("/admin/forgot/reset", function(){
	
	$user = User::validForgotDecrypt($_GET["code"]);

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]); 

	$page->setTpl("forgot-reset", array(
		"name"=>$user["desperson"],
		"code"=>$_GET["code"]
	));

});

$app->post("/admin/forgot/reset", function(){

	$forgot = User::validForgotDecrypt($_POST["code"]);

	User::setForgotUsed($forgot["idrecovery"]);

	$user = new User();

	$user->get((int)$forgot["iduser"]);


	$password = password_hash($_POST["password"], PASSWORD_DEFAULT, [
		"cost"=>12
	]);
	// posto do campo password do formulario forgot-reset.html
	$user->setPassword($password);

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]); 

	$page->setTpl("forgot-reset-success");

});


?>
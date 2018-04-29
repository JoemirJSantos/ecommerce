<?php 
session_start();
require_once("vendor/autoload.php");

// namespaces
use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\Model\User;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {
    
	$page = new Page(); // vai chamar o construtct

	$page->setTpl("index"); // apos esta linha vai chamar o destruct da classe Page
 

	// $sql = new Hcode\DB\Sql(); --> utilizado o use para localizar na linha 6
	// $sql = new Sql();
	// $resuts = $sql->select("SELECT * FROM tb_users");	
	// echo json_encode($resuts);

});

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


$app->run();

 ?>
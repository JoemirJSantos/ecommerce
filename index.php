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


$app->get('/admin/users', function(){

	User::verifyLogin();

	$users = User::listAll();

	$page = new PageAdmin(); // vai chamar o construtct

	$page->setTpl("users", array(
		"users"=>$users
	)); // apos esta linha vai chamar o destruct da classe Page
});

$app->get('/admin/users/create', function(){

	User::verifyLogin();

	$page = new PageAdmin(); // vai chamar o construtct

	$page->setTpl("users-create"); 
	// apos a linha acima vai chamar o destruct da classe Page
});

$app->get('/admin/users/:iduser/delete', function($iduser){

	User::verifyLogin();

	$user = new User();

	$user->get((int)$iduser);

	$user->delete();

	header("Location: /admin/users");
	exit;

});

$app->get('/admin/users/:iduser', function($iduser){

	User::verifyLogin();

	$user = new User();

	$user->get((int)$iduser);

	$page = new PageAdmin(); // vai chamar o construtct

	$page->setTpl("users-update", array(
		"user"=>$user->getValues()
	)); 
	// apos a linha acima vai chamar o destruct da classe Page
});
//rota para salvar os dados, entra nela via post
$app->post('/admin/users/create', function(){

	User::verifyLogin();
	//var_dump($_POST);
	$user = new User();

	$_POST["inadmin"] = (isset($_POST["inadmin"]))?1:0;

	$user->setData($_POST);

	$user->save();

	header("Location: /admin/users");
	exit;

});

$app->post('/admin/users/:iduser', function($iduser){

	User::verifyLogin();

	$user = new User();

	$_POST["inadmin"] = (isset($_POST["inadmin"]))?1:0;

	$user->get((int)$iduser);

	$user->setData($_POST);

	$user->update();

	header("Location: /admin/users");
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


$app->run();

 ?>
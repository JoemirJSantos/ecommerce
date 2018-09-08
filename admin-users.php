<?php 

use \Hcode\PageAdmin;
use \Hcode\Model\User;


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

 ?>
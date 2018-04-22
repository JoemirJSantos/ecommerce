<?php 

require_once("vendor/autoload.php");

// namespaces
use \Slim\Slim;
use Hcode\Page;

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

$app->run();

 ?>
<?php 
// local onde esta a classe
namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;
use \Hcode\Mailer;

class Product extends Model{

	public static function listAll()
	{
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_products ORDER BY desproduct");
	}

	public static function checkList($list)
	{
		foreach ($list as &$row) {
			$p = new Product();
			$p->setData($row);
			$row = $p->getValues();

		}

		return $list;
	}

	public function save()
	{
		$sql = new Sql();

		$results = $sql->select("CALL sp_products_save(:idproduct, :desproduct, :vlprice, :vlwidth, :vlheight, :vllength, :vlweight, :desurl )", array(
			":idproduct"=>$this->getidproduct(),
			":desproduct"=>$this->getdesproduct(),
			":vlprice"=>$this->getvlprice(),
			":vlwidth"=>$this->getvlwidth(),
			":vlheight"=>$this->getvlheight(),
			":vllength"=>$this->getvllength(),
			":vlweight"=>$this->getvlweight(),
			":desurl"=>$this->getdesurl()
		));

		$this->setData($results[0]);

		
	}
	
	public function get($idproduct)
	{
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_products a WHERE a.idproduct = :idproduct", array(
			":idproduct"=>$idproduct
		));

		$this->setData($results[0]);
	}

	public function delete()
	{
		$sql = new Sql();

		$sql->query("DELETE FROM tb_products WHERE idproduct = :idproduct  ", array(
			":idproduct"=>$this->getidproduct()
		));
		// ou assim com colchetes
		/*	
			$sql->query("DELETE FROM tb_categories WHERE idcategory = :idcategory   ", [
			":idcategory"=>$this->getidcategory()
		] */		
	}

	public function checkPhoto()
	{
		if(file_exists(
			$_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
			"res" . DIRECTORY_SEPARATOR .
			"site" . DIRECTORY_SEPARATOR .
			"img" . DIRECTORY_SEPARATOR .
			"products" . DIRECTORY_SEPARATOR .
			$this->getidproduct() . ".jpg"
			)){
			// aqui não precisa do DIRECTORY_SEPARATOR por ser a URL e não a pasta
			$url = "/res/site/img/products/" . $this->getidproduct() . ".jpg";

		}else {

			$url =  "/res/site/img/product.jpg";
		}
		
		return $this->setdesphoto($url);
	}


	//public function getValues()
	public function getValues($data = array())	
	{

		$this->checkPhoto();

		$values = parent::getValues();

		return $values;

	}

	public function setPhoto($file)
	{
		$extension = explode('.', $file['name']);
		$extension = end($extension);

		switch ($extension) {
			case 'jpeg':
			case 'jpg':
				$image = imagecreatefromjpeg($file["tmp_name"]);
				break;
			case 'gif':
				$image = imagecreatefromgif($file["tmp_name"]);
				break;
			case 'png':
				$image = imagecreatefrompng($file["tmp_name"]);
				break;

		}

		$dist = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
			"res" . DIRECTORY_SEPARATOR .
			"site" . DIRECTORY_SEPARATOR .
			"img" . DIRECTORY_SEPARATOR .
			"products" . DIRECTORY_SEPARATOR .
			$this->getidproduct() . ".jpg";

		imagejpeg($image, $dist);
		
		imagedestroy($image);

		$this->checkPhoto();

	}






}

 ?>
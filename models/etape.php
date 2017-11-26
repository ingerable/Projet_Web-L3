<?php

require_once 'models/model_base.php';

/**
* 
*/
class Etape extends Model_Base
{
	private $_Ordre;
	private $_temps;
	private $_illustration;
	private $_description_etape;
	private $_autoIdRecette;


	function __construct(array $data)
	{
		parent::__construct($data);
	}

	public static function create(array $data)
	{
		$u = new Etape($data);

		$q = self::$_db->prepare('INSERT INTO etape SET Ordre = :o, temps = :t, illustration = :i, description_etape = :de, autoIdRecette = :air');
		$q->bindValue(':o', $u->Ordre(), PDO::PARAM_STR);
		$q->bindValue(':t', $u->temps(), PDO::PARAM_STR);
		$q->bindValue(':i', $u->illustration(), PDO::PARAM_STR);
		$q->bindValue(':de', $u->description_etape(), PDO::PARAM_STR);
		$q->bindValue(':air', $u->autoIdRecette(), PDO::PARAM_STR);
		$q->execute();
		return $u;
	}


	public function Ordre()
	{
		return $this->_Ordre;
	}
	public function set_Ordre($l)
	{
		if(is_numeric($l)) {
			$this->_Ordre = $l;
		}
	}

	public function temps()
	{
		return $this->_temps;
	}
	public function set_temps($l)
	{
		if(is_numeric($l)) {
			$this->_temps = $l;
		}
	}

	public function illustration()
	{
		return $this->_illustration;
	}
	public function set_illustration($l)
	{
		if(is_string($l)) {
			$this->_illustration = $l;
		}
	}

	public function description_etape()
	{
		return $this->_description_etape;
	}
	public function set_description_etape($l)
	{
		if(is_string($l)) {
			$this->_description_etape = $l;
		}
	}

	public function autoIdRecette()
	{
		return $this->_autoIdRecette;
	}
	public function set_autoIdRecette($l)
	{
		if(is_numeric($l)) {
			$this->_autoIdRecette = $l;
		}
	}

		public function save()
	{
		if(!is_null($this->_autoIdRecette) && !is_null($this->_Ordre) ) {
		$q = self::$_db->prepare('UPDATE etape SET Ordre = :o, temps = :t, illustration = :i, description_etape = :de, autoIdRecette = :air');
		$q->bindValue(':o', $u->Ordre(), PDO::PARAM_STR);
		$q->bindValue(':t', $u->temps(), PDO::PARAM_STR);
		$q->bindValue(':i', $u->illustration(), PDO::PARAM_STR);
		$q->bindValue(':de', $u->description_etape(), PDO::PARAM_STR);
		$q->bindValue(':air', $u->autoIdRecette(), PDO::PARAM_STR);
		$q->execute();


		return $u;
		}
	}


	public function delete()
	{
		if(!is_null($this->_autoIdRecette) && !is_null($this->_Ordre) ) {
			$q = self::$_db->prepare('DELETE FROM etape WHERE Ordre = :o AND autoIdRecette = :air');
			$q->bindValue(':o', $this->_Ordre);
			$q->bindValue(':air', $this->_autoIdRecette);
			$q->execute();
			$this->_autoIdRecette = null;
			$this->_Ordre = null;
		}
	}


}



?>
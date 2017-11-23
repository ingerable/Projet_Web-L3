<?php

require_once 'models/model_base.php';

/**
* 
*/
class Ingredient extends Model_Base
{

	private $_nomIngredient;
	private $_calories;
	private $_Lipides;
	private $_Glucides;
	private $_Proteines;
	private $_Popularite;


	public function __construct(array $data)
	{
		parent::__construct($data);
	}

	public static function create(array $data)
	{
		$u = new Ingredient($data);

		$q = self::$_db->prepare('INSERT INTO ingredient SET nomIngredient = :ni, calories = :c, Lipides = :l, Glucides = :g, Proteines = :prot, Popularite = :pop');
		$q->bindValue(':ni', $u->nomIngredient(), PDO::PARAM_STR);
		$q->bindValue(':c', $u->calories(), PDO::PARAM_STR);
		$q->bindValue(':l', $u->Lipides(), PDO::PARAM_STR);
		$q->bindValue(':g', $u->Glucides(), PDO::PARAM_STR);
		$q->bindValue(':prot', $u->Proteines(), PDO::PARAM_STR);
		$q->bindValue(':pop', $u->Popularite(), PDO::PARAM_STR);
		$q->execute();

		return $u;
	}


	public static function get_by_nomIngredient($ni)
	{
		if(is_string($ni)) {
			$q = self::$_db->prepare('SELECT * FROM ingredient WHERE nomIngredient = :l');
			$q->bindValue(':l', $ni, PDO::PARAM_STR);
			$q->execute();
			if($data = $q->fetch(PDO::FETCH_ASSOC)) {
				return new Ingredient($data);
			} else {
				return null;
			}
		} else {
			return null;
		}
	}

	public static function get_all()
	{
		$p = array();
		$q = self::$_db->prepare('SELECT * FROM ingeredient ORDER BY nomIngredient');
		$q->execute();
		while($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$p[] = new User($data);
		}
		return $p;
	}


	public function nomIngredient()
	{
		return $this->_nomIngredient;
	}
	public function set_nomIngredient($l)
	{
		if(is_string($l)) {
			$this->_nomIngredient = $l;
		}
	}

	public function calories()
	{
		return $this->_calories;
	}
	public function set_calories($l)
	{
		if(is_string($l)) {
			$this->_calories = $l;
		}
	}

	public function Lipides()
	{
		return $this->_Lipides;
	}
	public function set_Lipides($l)
	{
		if(is_string($l)) {
			$this->_Lipides = $l;
		}
	}

	public function Glucides()
	{
		return $this->_Glucides;
	}
	public function set_Glucides($l)
	{
		if(is_string($l)) {
			$this->_Glucides = $l;
		}
	}

	public function Proteines()
	{
		return $this->_Proteines;
	}
	public function set_Proteines($p)
	{
		if(is_string($p)) {
			$this->_Proteines = $p;
		}
	}


	public function Popularite()
	{
		return $this->_Proteines;
	}
	public function set_Popularite($p)
	{
		if(is_string($p)) {
			$this->_Popularite = $p;
		}
	}


	public function save()
	{
		if(!is_null($this->_nomIngredient)) {
		$q = self::$_db->prepare('UPDATE ingredient SET nomIngredient = :ni, calories = :c, Lipides = :l, Glucides = :g, Proteines = :prot, Popularite = :pop 
										 WHERE nomIngredient = :ni');
		$q->bindValue(':ni', $u->nomIngredient(), PDO::PARAM_STR);
		$q->bindValue(':c', $u->calories(), PDO::PARAM_STR);
		$q->bindValue(':l', $u->Lipides(), PDO::PARAM_STR);
		$q->bindValue(':g', $u->Glucides(), PDO::PARAM_STR);
		$q->bindValue(':prot', $u->Proteines(), PDO::PARAM_STR);
		$q->bindValue(':pop', $u->Popularite(), PDO::PARAM_STR);
		$q->execute();


		return $u;
		}
	}


	public function delete()
	{
		if(!is_null($this->_nomIngredient)) {
			$q = self::$_db->prepare('DELETE FROM ingredient WHERE _nomIngredient = :ni');
			$q->bindValue(':ni', $this->_nomIngredient);
			$q->execute();
			$this->_nomIngredient = null;
		}
	}
}

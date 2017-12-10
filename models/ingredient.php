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
	private $_isGrammes;


	public function __construct(array $data)
	{
		parent::__construct($data);
	}

	public static function create(array $data)
	{
		$u = new Ingredient($data);

		$q = self::$_db->prepare('INSERT INTO ingredient SET nomIngredient = :ni, calories = :c, Lipides = :l, Glucides = :g, Proteines = :prot, Popularite = :pop, isGrammes = :gram');
		$q->bindValue(':ni', $u->nomIngredient(), PDO::PARAM_STR);
		$q->bindValue(':c', $u->calories(), PDO::PARAM_STR);
		$q->bindValue(':l', $u->Lipides(), PDO::PARAM_STR);
		$q->bindValue(':g', $u->Glucides(), PDO::PARAM_STR);
		$q->bindValue(':prot', $u->Proteines(), PDO::PARAM_STR);
		$q->bindValue(':pop', $u->Popularite(), PDO::PARAM_STR);
		$q->bindValue(':gram', $u->isGrammes(), PDO::PARAM_STR);
		$q->execute();

		return $u;
	}


	public static function get_by_nomIngredient($ni)
	{
		if(is_string($ni)) 
		{
			$q = self::$_db->prepare('SELECT * FROM ingredient WHERE nomIngredient = :l');
			$q->bindValue(':l', $ni, PDO::PARAM_STR);
			$q->execute();
			if($data = $q->fetch(PDO::FETCH_ASSOC)) 
			{
				return new Ingredient($data);
			} 
			else 
			{
				return null;
			}
		} 
		else 
		{
			return null;
		}
	}

	public static function get_all_names()
	{
		$p = array();
		$q = self::$_db->prepare('SELECT nomIngredient FROM ingredient ORDER BY nomIngredient');
		$q->execute();
		while($data = $q->fetch(PDO::FETCH_ASSOC)) 
		{
			$p[] = $data;
		}
		return $p;
	}


	public function nomIngredient()
	{
		return $this->_nomIngredient;
	}
	public function set_nomIngredient($l)
	{
		if(is_string($l)) 
		{
			$this->_nomIngredient = $l;
		}
	}

	public function calories()
	{
		return $this->_calories;
	}
	public function set_calories($l)
	{
		if(is_numeric($l)) 
		{
			$this->_calories = $l;
		}
	}

	public function isGrammes()
	{
		return $this->_isGrammes;
	}
	public function set_isGrammes($l)
	{
			$this->_isGrammes = $l;
	}

	public function Lipides()
	{
		return $this->_Lipides;
	}
	public function set_Lipides($l)
	{
		if(is_numeric($l)) 
		{
			$this->_Lipides = $l;
		}
	}

	public function Glucides()
	{
		return $this->_Glucides;
	}
	public function set_Glucides($l)
	{
		if(is_numeric($l)) 
		{
			$this->_Glucides = $l;
		}
	}

	public function Proteines()
	{
		return $this->_Proteines;
	}
	public function set_Proteines($p)
	{
		if(is_numeric($p)) 
		{
			$this->_Proteines = $p;
		}
	}


	public function Popularite()
	{
		return $this->_Proteines;
	}
	public function set_Popularite($p)
	{
		if(is_numeric($p)) 
		{
			$this->_Popularite = $p;
		}
	}

	public static function get_all()
	{
		$p = array();
		$q = self::$_db->prepare('SELECT * FROM ingredient ORDER BY nomIngredient');
		$q->execute();
		while($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$p[] = new Ingredient($data);
		}
		return $p;
	}

	//renvoie tout les ingredients contenant le mot en argument
	public static function get_Ingredient_Like($m, $sort)
	{
		$p = array();
		$q = self::$_db->prepare('SELECT * FROM ingredient where nomIngredient LIKE :mot ORDER BY '.$sort.' DESC ;');
		$q->bindValue(':mot', '%'.$m.'%', PDO::PARAM_STR);
		$q->execute();
		while($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$p[] = new Ingredient($data);
		}
		return $p;
	}

	public function save()
	{
		if(!is_null($this->_nomIngredient)) 
		{
			$q = self::$_db->prepare('UPDATE ingredient SET calories = :c, Lipides = :l, Glucides = :g, Proteines = :prot, Popularite = :pop, isGrammes = :gram WHERE nomIngredient = :ni');
			$q->bindValue(':ni', $this->nomIngredient(), PDO::PARAM_STR);
			$q->bindValue(':c', $this->calories(), PDO::PARAM_STR);
			$q->bindValue(':l', $this->Lipides(), PDO::PARAM_STR);
			$q->bindValue(':g', $this->Glucides(), PDO::PARAM_STR);
			$q->bindValue(':prot', $this->Proteines(), PDO::PARAM_STR);
			$q->bindValue(':pop', $this->Popularite(), PDO::PARAM_STR);
			$q->bindValue(':gram', $this->isGrammes(), PDO::PARAM_STR);
			if($q->execute())
			{
				return 0;
			}
			else
			{
				return NULL;
			}
		}
	}


	public function delete()
	{
		if(!is_null($this->_nomIngredient)) 
		{
			$q = self::$_db->prepare('DELETE FROM ingredient WHERE nomIngredient = :ni');
			$q->bindValue(':ni', $this->_nomIngredient);
			$q->execute();
			$this->_nomIngredient = null;
		}
	}
}

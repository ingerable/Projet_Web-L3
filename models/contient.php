<?php

require_once 'models/model_base.php';

/**
* 
*/
class Contient extends Model_Base
{
	private $_quantite;
	private $_grammes;
	private $_autoIdRecette;
	private $_nomIngredient;
	
	function __construct(array $data)
	{
		parent::__construct($data);
	}

	public static function create(array $data)
	{
		$c = new Contient($data);
		$q = self::$_db->prepare('INSERT INTO contient SET quantite = :q, grammes = :g, autoIdRecette = :air, nomIngredient = :ni');
		$q->bindValue(':q', $c->quantite(), PDO::PARAM_STR);
		$q->bindValue(':g', $c->grammes(), PDO::PARAM_STR);
		$q->bindValue(':air', $c->autoIdRecette(), PDO::PARAM_STR);
		$q->bindValue(':ni', $c->nomIngredient(), PDO::PARAM_STR);
		$q->execute();
		return $c;
	}

	public function quantite()
	{
		return $this->_quantite;
	}

	public function set_quantite($p)
	{
		if(is_numeric($p))
		{
			$this->_quantite = $p;	
		}
		else if($p == "")
		{
			$this->_quantite = null;
		}
	}

	public function grammes()
	{
		return $this->_grammes;
	}

	public function set_grammes($p)
	{
		if(is_numeric($p))
		{
			$this->_grammes = $p;	
		}
		else if($p == "")
		{
			$this->_grammes = null;
		}
	}

	public function autoIdRecette()
	{
		return $this->_autoIdRecette;
	}

	public function set_autoIdRecette($p)
	{
		if(is_numeric($p))
		{
			$this->_autoIdRecette = $p;	
		}
	}

	public function nomIngredient()
	{
		return $this->_nomIngredient;
	}

	public function set_nomIngredient($p)
	{
		if(is_string($p))
		{
			$this->_nomIngredient = $p;	
		}
	}

	public function delete()
	{
		if(!is_null($this->_autoIdRecette) && !is_null($this->nomIngredient)) 
		{
			$q = self::$_db->prepare('DELETE FROM contient WHERE autoIdRecette = :air AND nomIngredient = :ni');
			$q->bindValue(':air', $this->_autoIdRecette);
			$q->bindValue(':ni', $this->_nomIngredient);
			$q->execute();
			$this->_login = null;
		}
	}	
}
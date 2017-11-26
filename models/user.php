<?php

require_once 'models/model_base.php';

/**
* 
*/
class User extends Model_Base
{
	private $_login;
	private $_mot_de_passe;
	private $_adresse;
	private $_prenom;
	private $_nom;


	public function __construct(array $data)
	{
		parent::__construct($data);
	}

	public static function create(array $data)
	{
		$u = new User($data);
		$q = self::$_db->prepare('INSERT INTO utilisateur SET login = :l, mot_de_passe=:p, adresse = :m, nom = :nom, prenom = :pre');
		$q->bindValue(':l', $u->login(), PDO::PARAM_STR);
		$q->bindValue(':p', $u->mot_de_passe(), PDO::PARAM_STR);
		$q->bindValue(':m', $u->adresse(), PDO::PARAM_STR);
		$q->bindValue(':pre', $u->prenom(), PDO::PARAM_STR);
		$q->bindValue(':nom', $u->nom(), PDO::PARAM_STR);
		if($q->execute())
		{
			var_dump('sql query sucess !');
		}

		return $u;
	}

	public static function get_by_login($l)
	{
		if(is_string($l)) 
		{
			$q = self::$_db->prepare('SELECT * FROM Utilisateur WHERE login = :l');
			$q->bindValue(':l', $l, PDO::PARAM_STR);
			$q->execute();
			if($data = $q->fetch(PDO::FETCH_ASSOC)) 
			{
				return new User($data);
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

	public static function get_all()
	{
		$p = array();
		$q = self::$_db->prepare('SELECT * FROM Utilisateur ORDER BY login');
		$q->execute();
		while($data = $q->fetch(PDO::FETCH_ASSOC)) 
		{
			$p[] = new User($data);
		}

		return $p;
	}

	//renvoie tous les ingrédients de  l'utilisateur a chez lui
	public function getIngredients()
	{
		$p = array();
		$q = self::$_db->prepare('SELECT * FROM a_chez_lui where login = :log');
		$q->bindValue(':log', $this->_login, PDO::PARAM_STR);
		$q->execute();
		while($row = $q->fetch(PDO::FETCH_ASSOC)) 
		{
			$p[] =$row;
		}
		return $p;
	}

	//renvoie toutes les nom et id des recettes de l'utilisateur
	public function getRecipes()
	{
		$p = array();
		$q = self::$_db->prepare('SELECT nomRecette, autoIdRecette FROM recette where login = :log');
		$q->bindValue(':log', $this->_login, PDO::PARAM_STR);
		$q->execute();
		while($data = $q->fetch(PDO::FETCH_ASSOC)) 
		{
			$p[] = $data;
		}
		return $p;
	}

	public function login()
	{
		return $this->_login;
	}
	public function set_login($l)
	{
		if(is_string($l)) 
		{
			$this->_login = $l;
		}
	}

	public function nom()
	{
		return $this->_nom;
	}
	public function set_nom($l)
	{
		if(is_string($l)) 
		{
			$this->_nom = $l;
		}
	}

	public function prenom()
	{
		return $this->_prenom;
	}
	public function set_prenom($l)
	{
		if(is_string($l)) 
		{
			$this->_prenom = $l;
		}
	}

	public function adresse()
	{
		return $this->_adresse;
	}
	public function set_adresse($l)
	{
		if(is_string($l)) 
		{
			$this->_adresse = $l;
		}
	}

	public function mot_de_passe()
	{
		return $this->_mot_de_passe;
	}
	public function set_mot_de_passe($p)
	{
		if(is_string($p)) 
		{
			$this->_mot_de_passe = $p;
		}
	}

	public function save()
	{
		if(!is_null($this->_login)) 
		{
			$q = self::$_db->prepare('UPDATE Utilisateur SET mot_de_passe = :p WHERE login = :l');
			$q->bindValue(':l', $this->_login, PDO::PARAM_STR);
			$q->bindValue(':p', $this->_mot_de_passe, PDO::PARAM_STR);
			$q->execute();
		}
	}

	public function delete()
	{
		if(!is_null($this->_login)) 
		{
			$q = self::$_db->prepare('DELETE FROM Utilisateur WHERE login = :l');
			$q->bindValue(':l', $this->_login);
			$q->execute();
			$this->_login = null;
		}
	}

}

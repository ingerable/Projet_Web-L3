<?php

require_once 'models/model_base.php';

/**
* 
*/
class User extends Model_Base
{
	private $_nomRecette;
	private $_autoIdRecette;
	private $_descriptif;
	private $_calories;
	private $_difficulte;
	private $_note;
	private $_nbrPersonnes;
	private $_lipides;
	private $_Glucides;
	private $_Proteines;
	private $_duree;
	private $_login;
	private $_illustration;


	public function __construct(array $data)
	{
		parent::__construct($data);
	}

	public static function create(array $data)
	{
		$u = new Recette($data);

		$q = self::$_db->prepare('INSERT INTO recette SET login = :l, nomRecette = :np, descriptif = :d, calories = :c, difficulte = :dif, note = :n, nbrPersonnes = :nbP, 
								lipides = :lip, Glucides = :g, Proteines = :prot, duree = :d,
								   autoIdRecette = :air, illustration = :ill');
		$q->bindValue(':l', $u->login(), PDO::PARAM_STR);
		$q->bindValue(':np', $u->nomRecette(), PDO::PARAM_STR);
		$q->bindValue(':d', $u->descriptif(), PDO::PARAM_STR);
		$q->bindValue(':c', $u->calories(), PDO::PARAM_STR);
		$q->bindValue(':dif', $u->difficulte(), PDO::PARAM_STR);
		$q->bindValue(':n', $u->note(), PDO::PARAM_STR);
		$q->bindValue(':nbP', $u->nbrPersonnes(), PDO::PARAM_STR);
		$q->bindValue(':lip', $u->lipides(), PDO::PARAM_STR);
		$q->bindValue(':prot', $u->Proteines(), PDO::PARAM_STR);
		$q->bindValue(':d', $u->duree(), PDO::PARAM_STR);
		$q->bindValue(':air', $u->id(), PDO::PARAM_STR);
		$q->bindValue(':ill', $u->illustration(), PDO::PARAM_STR);			
		$q->execute();
		$u->set_id(self::$_db->lastInsertId());
		return $u;
	}

	public static function get_by_id($id)
	{
		$id = (int) $id;
		$q = self::$_db->prepare('SELECT * FROM recette WHERE autoIdRecette = :id');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		if($data = $q->fetch(PDO::FETCH_ASSOC)) {
			return new User($data);
		} else {
			return null;
		}
	}

	public static function get_by_nomRecette($nomR)
	{
		if(is_string($nomR)) {
			$q = self::$_db->prepare('SELECT * FROM recette WHERE nomRecette = :nomR');
			$q->bindValue(':nomR', $nomR, PDO::PARAM_STR);
			$q->execute();
			if($data = $q->fetch(PDO::FETCH_ASSOC)) {
				return new User($data);
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
		$q = self::$_db->prepare('SELECT * FROM recette ORDER BY nomRecette');
		$q->execute();
		while($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$p[] = new Recette($data);
		}
		return $p;
	}

	public function autoIdRecette()
	{
		return $this->_autoIdRecette;
	}
	public function set_autoIdRecette($id)
	{
		$id = (int) $id;
		if ($id > 0) {
			$this->_autoIdRecette = $id;
		}
	}

	public function login()
	{
		return $this->_login;
	}
	public function set_login($l)
	{
		if(is_string($l)) {
			$this->_login = $l;
		}
	}

	public function nomRecette()
	{
		return $this->_nomRecette;
	}
	public function set_nom($nomR)
	{
		if(is_string($nomR)) {
			$this->_nomR = $nomR;
		}
	}

	public function descriptif()
	{
		return $this->_descriptif;
	}
	public function set_descriptif($l)
	{
		if(is_string($l)) {
			$this->_descriptif = $l;
		}
	}

	public function difficulte()
	{
		return $this->_difficulte;
	}
	public function set_difficulte($l)
	{
		if(is_string($l)) {
			$this->_difficulte = $l;
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


	public function save()
	{
		if(!is_null($this->_autoIdRecette)) {
			$q = self::$_db->prepare('UPDATE recette SET nomRecette = :nr, descriptif = :des, difficulte = :dif, calories = :cal, nbrPersonnes = :nbrP, Lipides = :l, Glucides = :g, Proteines = :prot, Duree = :d, login = :log , illustration =: ill  WHERE autoIdRecette = :id');
			$q->bindValue(':nr', $this->_nomRecette, PDO::PARAM_STR);
			$q->bindValue(':id', $this->_autoIdRecette, PDO::PARAM_STR);
			$q->bindValue(':des', $this->_descriptif, PDO::PARAM_INT);
			$q->bindValue(':cal', $this->_calories, PDO::PARAM_STR);
			$q->bindValue(':dif', $this->_difficulte, PDO::PARAM_STR);
			$q->bindValue(':nbrP', $this->_nbrPersonnes, PDO::PARAM_INT);
			$q->bindValue(':l', $this->_lipides, PDO::PARAM_STR);
			$q->bindValue(':g', $this->_Glucides, PDO::PARAM_STR);
			$q->bindValue(':prot', $this->_Proteines, PDO::PARAM_INT);
			$q->bindValue(':d', $this->_duree, PDO::PARAM_STR);
			$q->bindValue(':log', $this->_login, PDO::PARAM_INT);
			$q->bindValue(':ill', $this->_illustration, PDO::PARAM_INT);
			$q->execute();
		}
	}




	public function delete()
	{
		if(!is_null($this->_autoIdRecette)) {
			$q = self::$_db->prepare('DELETE FROM recette WHERE autoIdRecette = :id');
			$q->bindValue(':id', $this->_autoIdRecette);
			$q->execute();
			$this->_autoIdRecette = null;
		}
	}
}

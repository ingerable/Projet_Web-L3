<?php

/**
* 
*/
class Planning extends model_base
{
	private $_dateRealisation;
	private $_autoIdRecette;
	private $_login;
	private $_startHour;
	private $_endHour;
	
	function __construct($data)
	{
		parent::__construct($data);
	}

	public static function create(array $data)
	{
		$p = new Planning($data);
		$q = self::$_db->prepare('INSERT INTO Planning SET dateRealisation = :d, autoIdRecette=:air, login = :l , startHour = :sh, endHour = :eh;');
		$q->bindValue(':l', $p->login(), PDO::PARAM_STR);
		$q->bindValue(':d', $p->dateRealisation(), PDO::PARAM_STR);
		$q->bindValue(':air', $p->autoIdRecette(), PDO::PARAM_STR);
		$q->bindValue(':sh', $p->startHour(), PDO::PARAM_STR);
		$q->bindValue(':eh', $p->endHour(), PDO::PARAM_STR);

		if($q->execute())
		{

			return $p;
		}
		return null;
	}

	public function delete()
	{
		$q = self::$_db->prepare('DELETE FROM planning WHERE dateRealisation = :d AND startHour = :sh AND autoIdRecette = :air AND login = :l');
		$q->bindValue(':l', $this->login(), PDO::PARAM_STR);
		$q->bindValue(':d', $this->dateRealisation(), PDO::PARAM_STR);
		$q->bindValue(':air', $this->autoIdRecette(), PDO::PARAM_STR);
		$q->bindValue(':sh', $this->startHour(), PDO::PARAM_STR);
		$q->execute();
	}

	public static function get_user_all_recipe($login)
	{

		$p = array();
		$q = self::$_db->prepare('SELECT * from planning WHERE login = :l ;');
		$q->bindValue(':l', $login, PDO::PARAM_STR);
		$q->execute();
		while($data = $q->fetch(PDO::FETCH_ASSOC)) 
		{
			$p[] = new Planning($data);
		}
		return $p;
	}

	public function dateRealisation()
	{
		return $this->_dateRealisation;
	}

	public function set_dateRealisation($l)
	{
		if(is_string($l))
		$this->_dateRealisation=$l;
	}

	public function autoIdRecette()
	{
		return $this->_autoIdRecette;
	}

	public function set_autoIdRecette($l)
	{
		if(is_numeric($l))
		 $this->_autoIdRecette=$l;
	}

	public function login()
	{
		return $this->_login;
	}

	public function set_login($l)
	{
		if(is_string($l))
		$this->_login=$l;
	}

	public function startHour()
	{
		return $this->_startHour;
	}

	public function set_startHour($l)
	{
		if(is_string($l))
		$this->_startHour=$l;
	}

	public function endHour()
	{
		return $this->_endHour;
	}

	public function set_endHour($l)
	{
		if(is_string($l))
		$this->_endHour=$l;
	}

	public static function plannedRecipe($date,$hour, $login)
	{
		$q = self::$_db->prepare('SELECT * from planning where DATE(dateRealisation) = :dr AND login = :l AND '.$hour.' BETWEEN HOUR(startHour) AND HOUR(endHour);');
		$q->bindValue(':dr', $date, PDO::PARAM_STR);
		$q->bindValue(':l', $login, PDO::PARAM_STR);
		if($q->execute()) 
		{
			$autoIdRecette = $q->fetch(PDO::FETCH_ASSOC);
			if($autoIdRecette == false)
			{
				return "";
			}
			else
			{
				$r = Recipe::get_by_id($autoIdRecette['autoIdRecette']);
				return $r->nomRecette();
			}
		}
	}

	public static function plannedRecipeObj($date,$hour, $login, $autoIdRecette)
	{
		$q = self::$_db->prepare('SELECT * from planning where DATE(dateRealisation) = :dr AND login = :l AND startHour = :sh AND autoIdRecette = :air ;');
		$q->bindValue(':dr', $date, PDO::PARAM_STR);
		$q->bindValue(':l', $login, PDO::PARAM_STR);
		$q->bindValue(':sh', $hour, PDO::PARAM_STR);
		$q->bindValue(':air', $autoIdRecette, PDO::PARAM_STR);
		$q->execute();
		if($data = $q->fetch(PDO::FETCH_ASSOC)) 
		{
			return new Planning($data);
		}
	}

}
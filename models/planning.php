<?php

/**
* 
*/
class Planning extends model_base
{
	private $_date;
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
		$q->bindValue(':d', $p->date(), PDO::PARAM_STR);
		$q->bindValue(':air', $p->autoIdRecette(), PDO::PARAM_STR);
		$q->bindValue(':sh', $p->startHour(), PDO::PARAM_STR);
		$q->bindValue(':eh', $p->endHour(), PDO::PARAM_STR);
		
		var_dump($q);
		if($q->execute())
		{

			return $p;
		}
		return null;
	}

	public function date()
	{
		return $this->_date;
	}

	public function set_date($l)
	{
		if(is_string($l))
		$this->_date=$l;
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

	public static function plannedRecipe($day, $month, $year, $hour)
	{
		$date = $year.'-'.$month.'-'.$day;

		$q = self::$_db->prepare('SELECT autoIdRecette from planning where DATE(dateRealisation) = :dr AND '.$hour.' BETWEEN HOUR(startHour) AND HOUR(endHour);');
		$q->bindValue(':dr', $date, PDO::PARAM_STR);
		if($q->execute()) 
		{
			$autoIdRecette = $q->fetch(PDO::FETCH_ASSOC);
			if($autoIdRecette == false)
			{
				return "free";
			}
			else
			{
				$r = Recipe::get_by_id($autoIdRecette['autoIdRecette']);
				return $r->nomRecette();
			}
		}
	}

}
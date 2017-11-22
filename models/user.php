<?php

require_once 'models/model_base.php';

/**
* 
*/
class User extends Model_Base
{
	private $_id;
	private $_login;
	private $_password;
	private $_mail;
	private $_prenom;
	private $_nom;


	public function __construct(array $data)
	{
		parent::__construct($data);
	}

	public static function create(array $data)
	{
		$u = new User($data);

		$q = self::$_db->prepare('INSERT INTO user SET login = :l, password=:p');
		$q->bindValue(':l', $u->login(), PDO::PARAM_STR);
		$q->bindValue(':p', $u->password(), PDO::PARAM_STR);
		$q->execute();

		$u->set_id(self::$_db->lastInsertId());
		return $u;
	}

	public static function get_by_id($id)
	{
		$id = (int) $id;
		$q = self::$_db->prepare('SELECT * FROM user WHERE id = :id');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		if($data = $q->fetch(PDO::FETCH_ASSOC)) {
			return new User($data);
		} else {
			return null;
		}
	}

	public static function get_by_login($l)
	{
		if(is_string($l)) {
			$q = self::$_db->prepare('SELECT * FROM user WHERE login = :l');
			$q->bindValue(':l', $l, PDO::PARAM_STR);
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
		$q = self::$_db->prepare('SELECT * FROM user ORDER BY login');
		$q->execute();
		while($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$p[] = new User($data);
		}
		return $p;
	}

	public function id()
	{
		return $this->_id;
	}
	public function set_id($id)
	{
		$id = (int) $id;
		if ($id > 0) {
			$this->_id = $id;
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

	public function nom()
	{
		return $this->_login;
	}
	public function set_nom($l)
	{
		if(is_string($l)) {
			$this->_login = $l;
		}
	}

	public function prenom()
	{
		return $this->_login;
	}
	public function set_prenom($l)
	{
		if(is_string($l)) {
			$this->_login = $l;
		}
	}

	public function mail()
	{
		return $this->_login;
	}
	public function set_mail($l)
	{
		if(is_string($l)) {
			$this->_login = $l;
		}
	}



	public function password()
	{
		return $this->_password;
	}
	public function set_password($p)
	{
		if(is_string($p)) {
			$this->_password = $p;
		}
	}

	public function save()
	{
		if(!is_null($this->_id)) {
			$q = self::$_db->prepare('UPDATE user SET login = :l, password = :p WHERE id = :id');
			$q->bindValue(':l', $this->_login, PDO::PARAM_STR);
			$q->bindValue(':p', $this->_password, PDO::PARAM_STR);
			$q->bindValue(':id', $this->_id, PDO::PARAM_INT);
			$q->execute();
		}
	}

	public function delete()
	{
		if(!is_null($this->_id)) {
			$q = self::$_db->prepare('DELETE FROM user WHERE id = :id');
			$q->bindValue(':id', $this->_id);
			$q->execute();
			$this->_id = null;
		}
	}
}

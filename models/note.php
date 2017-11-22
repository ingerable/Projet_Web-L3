<?php

require_once 'models/model_base.php';
require_once 'models/user.php';

/**
* 
*/
class Note extends Model_Base
{
	private $_id;
	private $_creator;
	private $_title;
	private $_keywords;
	private $_text;
	private $_text_start;
	private $_last_edit_user;
	private $_last_edit_time;

	public function __construct(array $data)
	{
		parent::__construct($data);
	}

	public static function create(array $data)
	{
		$n = new Note($data);

		$q = self::$_db->prepare('INSERT INTO note SET creator = :c, title = :t, keywords = :k, text = :txt, text_start = :txt_st, last_edit_user = :leu, last_edit_time = :let');
		$q->bindValue(':c', $n->creator(), PDO::PARAM_INT);
		$q->bindValue(':t', $n->title(), PDO::PARAM_STR);
		$q->bindValue(':k', $n->keywords(), PDO::PARAM_STR);
		$q->bindValue(':txt', $n->text(), PDO::PARAM_STR);
		$q->bindValue(':txt_st', $n->text_start(), PDO::PARAM_STR);
		$q->bindValue(':leu', $n->last_edit_user(), PDO::PARAM_INT);
		$q->bindValue(':let', $n->last_edit_time()->format('Y-m-d H:i:s'), PDO::PARAM_STR);
		$q->execute();

		$n->set_id(self::$_db->lastInsertId());
		return $n;
	}

	public static function get_by_id($id)
	{
		$id = (int) $id;
		$q = self::$_db->prepare('SELECT * FROM note WHERE id = :id');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		if($data = $q->fetch(PDO::FETCH_ASSOC)) {
			return new Note($data);
		} else {
			return null;
		}
	}

	public static function get_by_creator($creator)
	{
		if (is_object($creator) && $creator instanceof User) {
			$id = $creator->id();
		} else {
			$id = (int) $creator;
		}
		$n = array();
		$q = self::$_db->prepare('SELECT * FROM note WHERE creator = :id');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		while($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$n[] = new Note($data);
		}
		return $n;
	}

	public static function get_by_shared_with($user)
	{
		if (is_object($user) && $user instanceof User) {
			$id = $user->id();
		} else {
			$id = (int) $user;
		}
		$n = array();
		$q = self::$_db->prepare('SELECT n.* FROM share s, note n WHERE s.note_id = n.id AND s.user_id = :id');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		while($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$n[] = new Note($data);
		}
		return $n;
	}

	public static function get_all()
	{
		$n = array();
		$q = self::$_db->prepare('SELECT * FROM note');
		$q->execute();
		while($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$n[] = new Note($data);
		}
		return $n;
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

	public function creator()
	{
		return $this->_creator;
	}
	public function set_creator($c)
	{
		$c = (int) $c;
		if ($c > 0) {
			$this->_creator = $c;
		}
	}

	public function title()
	{
		return $this->_title;
	}
	public function set_title($t)
	{
		if(is_string($t)) {
			$this->_title = $t;
		}
	}

	public function keywords()
	{
		return $this->_keywords;
	}
	public function set_keywords($k)
	{
		if(is_string($k)) {
			$this->_keywords = $k;
		}
	}

	public function text()
	{
		return $this->_text;
	}
	public function set_text($t)
	{
		if(is_string($t)) {
			$this->_text = $t;
		}
	}

	public function text_start()
	{
		return $this->_text_start;
	}
	public function set_text_start($t)
	{
		if(is_string($t)) {
			$this->_text_start = $t;
		}
	}

	public function last_edit_user()
	{
		return $this->_last_edit_user;
	}
	public function set_last_edit_user($u)
	{
		$u = (int) $u;
		if ($u > 0) {
			$this->_last_edit_user = $u;
		}
	}

	public function last_edit_time()
	{
		return $this->_last_edit_time;
	}
	public function set_last_edit_time($t)
	{
		if (!is_null($t)) {
			if (is_object($t) && $t instanceof DateTime) {
				$this->_last_edit_time = $t;
			} else if(is_string($t)) {
				$this->_last_edit_time = new DateTime($t);
			}
		} else {
			$this->_last_edit_time = new DateTime();
		}
	}

	public function save()
	{
		if(!is_null($this->_id)) {
			$q = self::$_db->prepare('UPDATE note SET creator = :c, title = :t, keywords = :k, text = :txt, text_start = :txt_st, last_edit_user = :leu, last_edit_time = :let WHERE id = :id');
			$q->bindValue(':c', $this->_creator, PDO::PARAM_INT);
			$q->bindValue(':t', $this->_title, PDO::PARAM_STR);
			$q->bindValue(':k', $this->_keywords, PDO::PARAM_STR);
			$q->bindValue(':txt', $this->_text, PDO::PARAM_STR);
			$q->bindValue(':txt_st', $this->_text_start, PDO::PARAM_STR);
			$q->bindValue(':leu', $this->_last_edit_user, PDO::PARAM_INT);
			$q->bindValue(':let', $this->_last_edit_time->format('Y-m-d H:i:s'), PDO::PARAM_STR);
			$q->bindValue(':id', $this->_id, PDO::PARAM_INT);
			$q->execute();
		}
	}

	public function delete()
	{
		if(!is_null($this->_id)) {
			$q = self::$_db->prepare('DELETE FROM note WHERE id = :id');
			$q->bindValue(':id', $this->_id);
			$q->execute();
			$this->_id = null;
		}
	}

	public function is_created_by(User $u)
	{
		return $this->_creator == $u->id();
	}

	public function is_shared()
	{
		$q = self::$_db->prepare('SELECT COUNT(*) FROM share WHERE note_id = :nid');
		$q->bindValue(':nid', $this->_id, PDO::PARAM_INT);
		$q->execute();
		$s = $q->fetchColumn();
		return ($s > 0);
	}

	public function is_shared_with(User $u)
	{
		$q = self::$_db->prepare('SELECT COUNT(*) FROM share WHERE note_id = :nid AND user_id = :uid');
		$q->bindValue(':nid', $this->_id, PDO::PARAM_INT);
		$q->bindValue(':uid', $u->id(), PDO::PARAM_INT);
		$q->execute();
		$s = $q->fetchColumn();
		return ($s == 1);
	}

	public function shared_with()
	{
		$u = array();
		$q = self::$_db->prepare('SELECT u.* FROM share s, user u WHERE s.user_id = u.id AND s.note_id = :id');
		$q->bindValue(':id', $this->_id, PDO::PARAM_INT);
		$q->execute();
		while($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$u[] = new User($data);
		}
		return $u;
	}

	public function share_with(Array $users)
	{
		foreach ($users as $u) {
			$q = self::$_db->prepare('INSERT INTO share SET note_id = :nid, user_id = :uid');
			$q->bindValue(':nid', $this->_id, PDO::PARAM_INT);
			$q->bindValue(':uid', $u->id(), PDO::PARAM_INT);
			$q->execute();
		}
	}
}

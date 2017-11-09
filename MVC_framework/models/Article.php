<?php
require_once "model_base.php";

class Article extends model_base
{

  function __construct($data)
  {
    parent::__construct($data);
  }

  private $id;
  private $id_list;
  private $name;
  private $state;

  public function getId_list() { return $this->id_list;}
  public function getName() { return $this->name;}
  public function getId() { return $this->id;}
  public function getState() { return $this->state;}

  public function setId_list($id_list) { $this->id_list=$id_list;}
  public function setName($name) { $this->name=$name;}
  public function setId($id) { $this->id=$id;}
  public function setState($state) { $this->state=$state;}

  public static function create($id_list,$name,$state)
  {
    if(self::$_db!=NULL)
    {
      $statement = self::$_db->prepare("INSERT INTO articles (name,id_list,state) VALUES (:name, :id_list, :state)");
      $statement->bindValue(':name',$name,PDO::PARAM_STR);
      $statement->bindValue(':id_list',$id_list,PDO::PARAM_STR);
      $statement->bindValue(':state',$state,PDO::PARAM_STR);
      $res=$statement->execute();
      if($res)
      {
        return new Article(['id' => self::$_db->lastInsertId(), 'name' => $name, 'id_list' => $id_list, 'state' => $state]);
      }
      else {
        return NULL;
      }
    }
    else
    {
      return NULL;
    }
  }

  public static function getById($id)
  {
    if(self::$_db!=NULL)
    {
      $statement = self::$_db->prepare("Select * from articles where id= :id");
      $statement->bindValue(':id',$id,PDO::PARAM_INT);
      $statement->execute();
      if($res=$statement->fetch(PDO::FETCH_ASSOC))
      {
        $u=new Article($res);
        return $u;
      }
      else {
        return NULL;
      }
    }
    else
    {
      return NULL;
    }
  }

  public static function delete($id)
  {
    if(self::$_db!=NULL)
    {
      $statement = self::$_db->prepare("DELETE from articles WHERE id=:id");
      $statement->bindValue(':id',$id,PDO::PARAM_STR);
      $res=$statement->execute();
      if($res)
      {
        return true;
      }
      else {
        return false;
      }
    }
    else
    {
      return false;
    }
  }

  public function changearticlestate($state)
  {
    if(self::$_db!=NULL)
    {
      $statement = self::$_db->prepare("UPDATE articles set state=:state WHERE id=:id");
      $statement->bindValue(':id',$this->getId(),PDO::PARAM_STR);
      $statement->bindValue(':state',$state,PDO::PARAM_STR);
      $res=$statement->execute();
      if($res)
      {
        return true;
      }
      else {
        return false;
      }
    }
    else
    {
      return false;
    }
  }
}

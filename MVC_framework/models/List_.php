<?php
require_once "model_base.php";
/**
 *
 */
class List_ extends model_base
{
  function __construct($data)
  {
    parent::__construct($data);
  }

  private $id;
  private $name;
  private $id_owner;

  public function getId_owner() { return $this->id_owner;}
  public function getName() { return $this->name;}
  public function getId() { return $this->id;}

  public function setId_owner($id) {$this->id_owner=$id;}
  public function setName($name) {$this->name=$name;}
  public function setId($id) {$this->id=$id;}

  public function getArticlesFromList() {
    if(self::$_db!=NULL)
    {
      $statement = self::$_db->prepare("Select * from articles where id_list= :id");
      $statement->bindValue(':id',$this->getId(),PDO::PARAM_STR);
      $res=$statement->execute();
      if($res)
      {
        $data=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $data;
      }
      else {
        return NULL;
      }

    }
  }

  public static function getById($id)
  {
    if(self::$_db!=NULL)
    {
      $statement = self::$_db->prepare("Select * from lists where id= :id");
      $statement->bindValue(':id',$id,PDO::PARAM_INT);
      $statement->execute();
      if($res=$statement->fetch(PDO::FETCH_ASSOC))
      {
        $u=new List_($res);
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

  public static function getByNameAndOwner($name,$id_owner)
  {
    if(self::$_db!=NULL)
    {
      $statement = self::$_db->prepare("Select * from lists where name= :name and id_owner= :id_owner");
      $statement->bindValue(':name',$name,PDO::PARAM_STR);
      $statement->bindValue(':id_owner',$id_owner,PDO::PARAM_INT);
      $statement->execute();
      if($res=$statement->fetch(PDO::FETCH_ASSOC))
      {
        $u=new List_($res);
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


  public static function getAllListByOwner($id_ow)
  {
    if(self::$_db!=NULL)
    {
      $statement = self::$_db->prepare("Select * from lists where id_owner=:id");
      $statement->bindValue(':id',$id_ow,PDO::PARAM_INT);
      $res=$statement->execute();
      if($res)
      {
        $data=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $data;
      }
      else {
        return NULL;
      }
    }
  }

  public static function create($name,$id_owner)
  {
    if(self::$_db!=NULL)
    {
      $statement = self::$_db->prepare("INSERT INTO lists (name,id_owner) VALUES (:name, :id_owner)");
      $statement->bindValue(':name',$name,PDO::PARAM_STR);
      $statement->bindValue(':id_owner',$id_owner,PDO::PARAM_STR);
      $res=$statement->execute();
      if($res)
      {
        return new List_(['id' => self::$_db->lastInsertId(), 'name' => $name, 'id_owner' => $id_owner]);
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

  public static function deletelist($id)
  {
      if(self::$_db!=NULL)
      {
        $statement = self::$_db->prepare("DELETE from lists WHERE id=:id");
        $statement->bindValue(':id',$id,PDO::PARAM_INT);
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

<?php
require_once "model_base.php";
class User extends model_base
{
  private $id;
  private $login;
  private $pw;

  public function __construct($data)
  {
    parent::__construct($data);
  }

  public function getLogin(){return $this->login;}
  public function getId(){return $this->id;}
  public function getPassword(){return $this->pw;}

  public function setLogin($l)
  {
    if(is_string($l)){$this->login=$l;}
  }

  public function setPassword($pw)
  {
    if(is_string($pw)){$this->pw=$pw;}
  }

  public function setId($id)
  {
    $this->id=$id;
  }

  public static function create($login, $pw)//insère nouveau utilisateur dans la db
  {
    if(self::$_db!=NULL)
    {
      $statement = self::$_db->prepare("INSERT INTO users (login,password) VALUES (:login, :password)");
      $statement->bindValue(':login',$login,PDO::PARAM_STR);
      $statement->bindValue(':password',$pw,PDO::PARAM_STR);
      $res=$statement->execute();
      if($res)
      {
        return new User([ 'id' => self::$_db->lastInsertId(), 'login' => $login, 'password' => $pw ]);
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
      $statement = self::$_db->prepare("Select * from users where id= :id");
      $statement->bindValue(':id',$id,PDO::PARAM_STR);
      $statement->execute();
      if($res=$statement->fetch(PDO::FETCH_ASSOC))
      {
        $u=new User($res);
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

  public static function getByLogin($l)
  {
    if(self::$_db!=NULL)
    {
      $statement = self::$_db->prepare("Select * from users where login= :login");
      $statement->bindValue(':login',$l,PDO::PARAM_STR);
      $statement->execute();
      if($res=$statement->fetch(PDO::FETCH_ASSOC))
      {
        $u=new User($res);
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

  public function save()
  {
    if(self::$_db!=NULL)
    {
      $statement = self::$_db->prepare("UPDATE users set login=:login, password=:password WHERE id=:id");
      $statement->bindValue(':id',$this->id,PDO::PARAM_INT);
      $statement->bindValue(':login',$this->login,PDO::PARAM_STR);
      $statement->bindValue(':password',$this->pw,PDO::PARAM_STR);
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

  public function delete()
  {
      if(self::$_db!=NULL)
      {
        $statement = self::$_db->prepare("DELETE from users WHERE id=:id");
        $statement->bindValue(':id',$this->getId(),PDO::PARAM_INT);
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

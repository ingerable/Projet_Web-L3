<?php

require_once 'controller_base.php';
require_once 'models/List_.php';
require_once 'models/User.php';
require_once 'models/Article.php';

class Controller_List extends controller_base
{
  public function __construct()
	{}

  public function mylists()
  {
    if($_SERVER['REQUEST_METHOD']=='GET')
		{
      if(isset($_SESSION['user']))
      {
        $this->render_view('lists',['user'=>$_SESSION['user']]);
      }
    }
  }

  public function createlist()
  {
    if($_SERVER['REQUEST_METHOD']=='GET')
		{
      if(isset($_SESSION['user']))
      {
        $this->render_view('newlist');
      }
    }
    else if($_SERVER['REQUEST_METHOD']=='POST')
    {
      if(check_post_values(['listname']))
      {
        $u=User::getByLogin($_SESSION['user']);
        if(is_null(List_::getByNameAndOwner($_POST['listname'],$u->getId())))
        {
          $l=List_::create($_POST['listname'],$u->getId());
          if(!is_null($l))
          {
            $this->message('success','List created');
            $this->redirect(BASEURL.'/index.php/list/createlist');
          }
          else {
            $this->message('error','Error when creating list');
            $this->redirect(BASEURL.'/index.php/list/createlist');
          }
        }
        else {
          $this->message('error','One list already exists with the same name');
          $this->redirect(BASEURL.'/index.php/list/createlist');
        }
      }
    }
  }

  public function listdeleter($id)
  {
    $l=List_::getById($id);
    if(!is_null($l)) {$u=User::getById($l->getId_owner());}
    if($u->getLogin()==$_SESSION['user'] and !is_null($l))
    {
      $res=List_::deletelist($id);
      if($res)
      {
        $this->message('success','List deleted');
        $this->redirect(BASEURL.'/index.php/list/mylists');
      }
      else {
        $this->message('error','List doesn\'t exist');
        $this->redirect(BASEURL.'/index.php/list/mylists');
      }
    }
    else {
      $this->render_view('accessdenied');
    }
  }

  public function viewlist($id)
  {
    $l=List_::getById($id);
    if(!is_null($l)) {$u=User::getById($l->getId_owner());}
    if($u->getLogin()==$_SESSION['user'] and !is_null($l))
    {
      if($_SERVER['REQUEST_METHOD']=='GET')
      {
        if(isset($_SESSION['user']))
        {
          $this->render_view('listview',['id'=>$id]);
        }
      }
      else if($_SERVER['REQUEST_METHOD']=='POST')
      {
        if(check_post_values(['name','state']))
        {
          $res=Article::create($id,$_POST['name'],$_POST['state']);
          if(!is_null($res))
          {
            $this->message('success','Article added');
            $this->redirect(BASEURL.'/index.php/list/viewlist/'.$id);
          }
          else {
            $this->message('error','Error when adding article');
            $this->redirect(BASEURL.'/index.php/list/viewlist/'.$id);
          }
        }
      }
    }
    else {
      $this->render_view('accessdenied');
    }

  }
}

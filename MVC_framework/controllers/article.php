<?php

require_once 'controller_base.php';
require_once 'models/Article.php';
require_once 'models/List_.php';
require_once 'models/User.php';

class Controller_Article extends controller_base
{
  public function __construct()
	{}

    public function articledeleter($id)
    {
      $ar=Article::getById($id);
      if(!is_null($ar)) {$l=List_::getById($ar->getId_list());}
      if(!is_null($l)) {$u=User::getById($l->getId_owner());}
      if($u->getLogin()==$_SESSION['user'] and !is_null($l) and !is_null($ar))
      {
        $a=Article::getById($id);
        if(!is_null($a))
        {
          $res=Article::delete($id);
        }
        else {
          $this->message('error','Article doesn\'t exist');
          $this->redirect(BASEURL.'/index.php/list/mylists');
        }
        if($res)
        {
          $this->message('success','Article deleted');
          $this->redirect(BASEURL.'/index.php/list/viewlist/'.$a->getId_list());
        }
        else {
          $this->message('error','Error when deleting article');
          $this->redirect(BASEURL.'/index.php/list/mylists'.$a->getId_list());
        }
      }
      else {
        $this->render_view('accessdenied');
      }
    }

    public function changestate($id)
    {
      $ar=Article::getById($id);
      if(!is_null($ar)) {$l=List_::getById($ar->getId_list());}
      if(!is_null($l)) {$u=User::getById($l->getId_owner());}
      if($u->getLogin()==$_SESSION['user'] and !is_null($l) and !is_null($ar))
      {
        if($ar->getState()=='To buy')
        {
          if($ar->changearticlestate('Bought'))
          {
            $this->redirect(BASEURL.'/index.php/list/viewlist/'.$ar->getId_list());
          }
          else {
            $this->message('error','Error when changing article state');
            $this->redirect(BASEURL.'/index.php/list/viewlist/'.$ar->getId_list());
          }
        }
        else {
          if ($ar->changearticlestate('To buy'))
          {
            $this->redirect(BASEURL.'/index.php/list/viewlist/'.$ar->getId_list());
          }
          else {
            $this->message('error','Error when changing article state');
            $this->redirect(BASEURL.'/index.php/list/viewlist/'.$ar->getId_list());
          }
        }
      }
      else {
        $this->render_view('accessdenied');
      }
    }
}

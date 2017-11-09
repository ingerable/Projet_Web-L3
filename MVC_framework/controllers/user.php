<?php

require_once 'controller_base.php';
require_once 'models/User.php';

class Controller_User extends Controller_Base
{
	public function __construct()
	{}

	public function settings()
	{
		if ($_SERVER['REQUEST_METHOD']=='GET') {
	    if(!isset($_SESSION['user']))
	    {
	      $this->redirect(BASEURL.'/index.php/user/signin');
	    }
			$this->render_view('settings');
		}
	}

	public function changepassword()
	{
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			if(check_post_values(['pwd','rpwd']) && $_POST['pwd'] == $_POST['rpwd'])
			{
				$u=User::getByLogin($_SESSION['user']);
				if(!is_null($u))
				{
					$u->setPassword(hash('sha256',hash('sha256',$_POST['pwd']).md5($_POST['pwd'])));
					if($u->save())
					{
						$this->message('success','Password change succeed');
						$this->redirect(BASEURL.'/index.php/user/settings');
					}
					else {
						$this->message('error','Password change failed');
						$this->redirect(BASEURL.'/index.php/user/settings');
					}
				}
				else {
					$this->message('error','User issue');
					$this->redirect(BASEURL.'/index.php/user/settings');
				}
			}
			else {
				$this->message('error','Passwords don\'t match');
				$this->redirect(BASEURL.'/index.php/user/settings');
			}
		}
	}

	public function delete()
	{
		$u=User::getByLogin($_SESSION['user']);
		if(!is_null($u))
		{
			if($u->delete())
			{
				$this->redirect(BASEURL.'/index.php/user/signout');
			}
		}
	}

	public function signout()
	{
		unset($_SESSION['user']);
		$this->redirect(BASEURL);
	}

	public function signup()
	{
		if ($_SERVER['REQUEST_METHOD']=='GET') {
    	$this->render_view('signup');
		}
		else if ($_SERVER['REQUEST_METHOD']=='POST') {
			if(check_post_values(['log','pwd','rpwd']) && $_POST['pwd']==$_POST['rpwd'])
			{
				if(User::getByLogin($_POST['log'])==NULL)//si login n'existe pas déjà
				{
					$u=User::create($_POST['log'], hash('sha256',hash('sha256',$_POST['pwd']).md5($_POST['pwd'])));
					if(!is_null($u))
					{
						$this->redirect(BASEURL.'/index.php/user/signin');
					}
					else {
						$this->message('error','DB access issue');
						$this->redirect(BASEURL.'/index.php/user/signup');
					}
				}
				else {
					$this->message('error','Login already used');
					$this->redirect(BASEURL.'/index.php/user/signup');
				}
			}
			else {
				$this->message('error','Passwords don\'t match');
				$this->redirect(BASEURL.'/index.php/user/signup');
			}
		}
	}

	public function signin()
	{
		if ($_SERVER['REQUEST_METHOD']=='GET') {
    	$this->render_view('signin');
		}
		else if ($_SERVER['REQUEST_METHOD']=='POST') {
			if (check_post_values(['log', 'pwd']))
			{
				$u=User::getByLogin($_POST['log']);
				if($u!=NULL)
				{
					if($u->getPassword() == hash('sha256',hash('sha256',$_POST['pwd']).md5($_POST['pwd'])))
					{
						$_SESSION['user']=$_POST['log'];
						$this->redirect(BASEURL.'/index.php/list/mylists');
					}
					else {
						$this->message('error','Bad login or password');
						$this->redirect(BASEURL.'/index.php/user/signin');
					}
				}
				else
				{
					$this->message('error','Bad login or password');
					$this->redirect(BASEURL.'/index.php/user/signin');
				}
			}
		}
	}
}

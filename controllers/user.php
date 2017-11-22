<?php

require_once 'models/user.php';

class Controller_User
{
	public function __construct()
	{}

	public function signup()
	{
		switch($_SERVER['REQUEST_METHOD']) {
			case 'POST':
				if (check_post_values(array('login', 'password', 'password_check'))) {
					$u = User::get_by_login($_POST['login']);
					if (is_null($u)) {
						if ($_POST['password'] == $_POST['password_check']) {
							User::create(array(
								'login' => $_POST['login'],
								'password' => sha1($_POST['password'])
							));
							message('success', 'User '.$_POST['login'].' successfully signed up');
							header('Location: '.BASEURL.'/index.php/user/signin');
							exit;
						} else {
							message('error', 'Bad password check');
							header('Location: '.BASEURL.'/index.php/user/signup');
							exit;
						}
					} else {
						message('error', 'Login \''.$_POST['login'].'\' is already used');
						header('Location: '.BASEURL.'/index.php/user/signup');
						exit;
					}
				} else {
					http_response_code(400);
					include('views/errors/400.php');
				}
				break;
			case 'GET':
				include 'views/user/signup.php';
				break;
		}
	}

	public function signin()
	{
		switch($_SERVER['REQUEST_METHOD']) {
			case 'POST':
				if (check_post_values(array('login', 'password'))) {
					$u = User::get_by_login($_POST['login']);
					if (!is_null($u)) {
						if ($u->password() == sha1($_POST['password'])) {
							$_SESSION['user_id'] = $u->id();
							message('success', 'User '.$_POST['login']. ' successfully signed in');
							header('Location: '.BASEURL);
							exit;
						} else {
							message('error', 'Wrong password');
							header('Location: '.BASEURL.'/index.php/user/signin');
							exit;
						}
					} else {
						message('error', 'User \''.$_POST['login'].'\' is unknown');
						header('Location: '.BASEURL.'/index.php/user/signin');
						exit;
					}
				} else {
					http_response_code(400);
					include('views/errors/400.php');
				}
				break;
			case 'GET':
				include 'views/user/signin.php';
				break;
		}
	}

	public function signout()
	{
		unset($_SESSION['user_id']);
		message('success', 'User successfully signed out');
		header('Location: '.BASEURL);
		exit;
	}
}

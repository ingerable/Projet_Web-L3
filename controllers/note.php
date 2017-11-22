<?php

require_once 'models/note.php';
require_once 'models/user.php';

class Controller_Note
{
	public function __construct()
	{}

	public function create()
	{
		if (user_connected()) {
			switch($_SERVER['REQUEST_METHOD']) {
				case 'POST':
					if (check_post_values(array('title', 'text'))) {
						$u = get_connected_user();
						$n = Note::create(array(
							'creator' => $u->id(),
							'title' => $_POST['title'],
							'keywords' => '',
							'text' => $_POST['text'],
							'text_start' => substr($_POST['text'], 0, 50).'...',
							'last_edit_user' => $u->id(),
							'last_edit_time' => new DateTime()
						));
						message('success', 'Note successfully created');
						header('Location: '.BASEURL.'/index.php/note/mine');
						exit;
					} else {
						http_response_code(400);
						include('views/errors/400.php');
					}
					break;
				case 'GET':
					include 'views/note/create.php';
					break;
			}
		} else {
			header('Location: '.BASEURL);
			exit;
		}
	}

	public function mine()
	{
		if (user_connected()) {
			$u = get_connected_user();
			$notes = Note::get_by_creator($u);
			include 'views/note/list_mine.php';
		} else {
			header('Location: '.BASEURL);
			exit;
		}
	}

	public function shared()
	{
		if (user_connected()) {
			$u = get_connected_user();
			$notes = Note::get_by_shared_with($u);
			include 'views/note/list_shared.php';
		} else {
			header('Location: '.BASEURL);
			exit;
		}
	}

	public function edit($id)
	{
		if (user_connected()) {
			$u = get_connected_user();
			$note = Note::get_by_id($id);
			if (!is_null($note) && ($note->is_created_by($u) || $note->is_shared_with($u))) {
				switch($_SERVER['REQUEST_METHOD']) {
					case 'POST':
						if (check_post_values(array('title', 'text'))) {
							$note->hydrate(array(
								'title' => $_POST['title'],
								'keywords' => '',
								'text' => $_POST['text'],
								'text_start' => substr($_POST['text'], 0, 50).'...',
								'last_edit_user' => $u->id(),
								'last_edit_time' => new DateTime()
							));
							$note->save();
							message('success', 'Note successfully edited');
							header('Location: '.BASEURL.'/index.php/note/mine');
							exit;
						} else {
							http_response_code(400);
							include('views/errors/400.php');
						}
						break;
					case 'GET':
						$shared_with = $note->shared_with();
						include 'views/note/edit.php';
						break;
				}
			} else {
				http_response_code(404);
				include('views/errors/404.php');
			}
		} else {
			header('Location: '.BASEURL);
			exit;
		}
	}

	public function share($id)
	{
		if (user_connected()) {
			$u = get_connected_user();
			$note = Note::get_by_id($id);
			if (!is_null($note) && $note->is_created_by($u)) {
				switch($_SERVER['REQUEST_METHOD']) {
					case 'POST':
						if (check_post_values(array('shared_with'))) {
							$users_name = explode(',', $_POST['shared_with']);
							$users = array();
							foreach ($users_name as $user_name) {
								$u = User::get_by_login($user_name);
								if (!is_null($u)) {
									$users[] = $u;
								}
							}
							$note->share_with($users);
							message('success', 'Note successfully shared');
							header('Location: '.BASEURL.'/index.php/note/mine');
							exit;
						} else {
							http_response_code(400);
							include('views/errors/400.php');
						}
						break;
				}
			} else {
				http_response_code(404);
				include('views/errors/404.php');
			}
		} else {
			header('Location: '.BASEURL);
			exit;
		}
	}

	public function delete($id)
	{
		if (user_connected()) {
			$u = get_connected_user();
			$note = Note::get_by_id($id);
			if (!is_null($note) && $note->is_created_by($u)) {
				switch($_SERVER['REQUEST_METHOD']) {
					case 'POST':
						$note->delete();
						message('success', 'Note successfully deleted');
						header('Location: '.BASEURL.'/index.php/note/mine');
						exit;
						break;
				}
			} else {
				http_response_code(404);
				include('views/errors/404.php');
			}
		} else {
			header('Location: '.BASEURL);
			exit;
		}
	}
}

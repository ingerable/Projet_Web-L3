<?php

if (!function_exists('check_post_values')) {
	function check_post_values(Array $var) {
		foreach ($var as $v) {
			if (!isset($_POST[$v])) {
				return false;
			} else {
				$_POST[$v] = htmlspecialchars($_POST[$v]);
			}
		}
		return true;
	}
}

if (!function_exists('message')) {
	function message($type, $text) {
		$_SESSION['message'] = array(
			'type' => $type,
			'text' => $text
		);
	}
}

if (!function_exists('user_connected')) {
	function user_connected() {
		return isset($_SESSION['user_login']);
	}
}

if (!function_exists('get_connected_user')) {
	function get_connected_user() {
		if (isset($_SESSION['user_login'])) {
			$u = User::get_by_login($_SESSION['user_login']);
			return $u;
		} else {
			return null;
		}
	}
}

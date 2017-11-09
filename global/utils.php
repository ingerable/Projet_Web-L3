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

if (!function_exists('link_to')) {
	function link_to($target = '') {
		return BASEURL.'/index.php/'.$target;
	}
}

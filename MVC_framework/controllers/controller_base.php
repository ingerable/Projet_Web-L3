<?php

class Controller_Base
{
    public function __construct() {

    }

	// TODO : automatically prefix target with "BASEURL/index.php/"
    public function redirect($target) {
        header('Location: ' . $target);
        exit;
    }

    public function render_view($viewname, Array $data = array()) {
        extract($data);
        $viewfile = 'views/' . $viewname . '.php';
        ob_start();
        if (is_readable($viewfile)) {
            require_once $viewfile;
        }
        $content = ob_get_clean();
        require_once 'views/main.php';
        exit;
    }

	public function message($type, $text) {
		$_SESSION['message'] = array(
			'type' => $type,
			'text' => $text
		);
	}
}

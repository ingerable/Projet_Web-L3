<?php

require_once 'controllers/controller_base.php';

class Controller_Home extends Controller_Base
{
	public function __construct()
	{}

	public function index()
	{
        	$this->render_view('home');
	}
}

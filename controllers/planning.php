<?php

require_once 'models/recipe.php';
require_once 'models/user.php';
require_once 'models/contient.php';

class Controller_Planning
{

public function __construct()
	{}


public function planningWeek()
{

	switch ($_SERVER['REQUEST_METHOD']) 
			{
				case 'POST':
					include 'views/planning/managePlanning.php';
					break;
				
				case 'GET':

					include 'views/planning/managePlanning.php';
					break;
			}
}
}
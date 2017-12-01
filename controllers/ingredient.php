<?php

require_once 'models/recipe.php';
require_once 'models/user.php';
require_once 'models/contient.php';
require_once 'models/ingredient.php';

/**
* 
*/
class Controller_Ingredient
{
	
	function __construct()
	{}

	public function createIngredient()
	{

		switch ($_SERVER['REQUEST_METHOD']) 
		{
			case 'POST':
				# code...
				break;

			case 'GET':
				if(user_connected())
				{
					include 'views/ingredient/createIngredient.php';
				}
				
				break;
		}
	}
}

?>
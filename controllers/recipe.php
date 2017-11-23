<?php

require_once 'models/recipe.php';

class Controller_Recipe
{

public function __construct()
	{}

	public function searchRecipe()
	{
			switch ($_SERVER['REQUEST_METHOD']) 
			{
				case 'POST':
					# code...
					break;
				
				case 'GET':
					include 'views/recipe/searchRecipe.php';
					break;
			}
	}
}	

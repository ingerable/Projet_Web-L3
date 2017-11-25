<?php

require_once 'models/recipe.php';
require_once 'models/user.php';

class Controller_Recipe
{

public function __construct()
	{}

	public function searchRecipe()
	{
			switch ($_SERVER['REQUEST_METHOD']) 
			{
				case 'POST':
					include 'views/recipe/searchRecipe.php';
					break;
				
				case 'GET':
					include 'views/recipe/searchRecipe.php';
					break;
			}
	}

	public function displayRecipe()
	{
		switch ($_SERVER['REQUEST_METHOD']) 
			{
				case 'POST':
					include 'views/recipe/displayRecipe.php';
					break;
				
				case 'GET':
					include 'views/recipe/displayRecipe.php';
					break;
			}
	}

	public function createRecipe()
	{
		switch ($_SERVER['REQUEST_METHOD']) 
		{
			case 'POST':
				if (check_post_values(array('nomRecette', 'nbrPersonnes', 'illustration', 'difficulte',  'descriptif'))) 
				{
					$u = get_connected_user();
					$login = $u->login();
					$r = recipe::create(array(
						'nomRecette'=>$_POST['nomRecette'],
						'nbrPersonnes'=>$_POST['nbrPersonnes'],
						'illustration'=>$_POST['illustration'],
						'difficulte'=>$_POST['difficulte'],
						'descriptif'=>$_POST['descriptif'],
						'calories'=>0,
						'lipides'=>0,
						'Glucides'=>0,
						'Proteines'=>0,
						'duree'=>0,
						'login'=>$login,
						'note'=>0));
					message('success', 'Recipe'.$_POST['nomRecette'].' successfully created, now you can add ingredients
						and stage');
					//header('Location: '.BASEURL.'/index.php/recipe/signin');
				}
				break;
			
			case 'GET':
				include 'views/recipe/createRecipe.php';
				break;
		}
	}
}	

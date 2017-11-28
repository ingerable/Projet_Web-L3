<?php

require_once 'models/recipe.php';
require_once 'models/user.php';
require_once 'models/contient.php';

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
					//récupère nom auteur
					$u = get_connected_user();
					$login = $u->login();
					//création de la recette
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
					// on redirige l'utilisateur vers la page lui permettant de créer les ingrédients et étapes
					message('success', $r->nomRecette().' successfully created, now you can add ingredients
						and stages');
				}
				break;
			
			case 'GET':
				include 'views/recipe/createRecipe.php';
				break;
		}
	}

	public function searchRecipeIngredients()
	{
		switch ($_SERVER['REQUEST_METHOD']) 
			{
				case 'POST':
					include 'views/recipe/searchRecipeIngredients.php';
					break;
				
				case 'GET':
					include 'views/recipe/searchRecipeIngredients.php';
					break;
			}
	}
}
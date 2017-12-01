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
			if(user_connected())
			{
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
			}
			else
			{
				header('Location: '.BASEURL);
				break;
			}
			
			case 'GET':
				if(user_connected())
				{
					include 'views/recipe/createRecipe.php';
					break;
				}
				else
				{
					header('Location: '.BASEURL);
					break;
				}	
			}
		}

	public function searchRecipeIngredients()
	{
		switch ($_SERVER['REQUEST_METHOD']) 
			{
				case 'POST':
					if(user_connected())
					{
						include 'views/recipe/searchRecipeIngredients.php';
						break;	
					}
					else
					{
						header('Location: '.BASEURL);
						break;	
					}
					
				
				case 'GET':
					if(user_connected())
					{
						include 'views/recipe/searchRecipeIngredients.php';
						break;
					}
					else
					{
						header('Location: '.BASEURL);
						break;
					}	
			}
	}


	public function manageRecipe()
	{
		include 'views/recipe/manageRecipe.php';
	}

	public function editRecipe()
	{
		switch($_SERVER['REQUEST_METHOD']) {
			case 'POST':
				if(isset($_POST['cancel']))
				{
					header('Location: '.BASEURL.'/index.php/recipe/manageRecipe');
				}
				else if(isset($_POST['delete']))
				{
					$r=Recipe::get_by_id($_POST['idRecette']);
					$r->delete();
					if($r->autoIdRecette()==null) // si delete ok
					{
						message('success', 'Recipe successfully deleted');
						header('Location: '.BASEURL.'/index.php/recipe/manageRecipe');
						exit;
					}
					else
					{
						message('error', 'Error while deleting recipe');
						header('Location: '.BASEURL.'/index.php/recipe/manageRecipe');
						exit;
					}
				}
				else
				{
					if($_POST['nomRecette']!='' && $_POST['nbrPersonnes']!='' && $_POST['calories']!='' && $_POST['proteines']!='' && $_POST['lipides']!='' && $_POST['glucides']!='' && $_POST['illustration']!='' && $_POST['descriptif']!='')
					{
						$r=Recipe::get_by_id($_POST['idRecette']);
						$r->set_nomRecette($_POST['nomRecette']);
						$r->set_nbrPersonnes($_POST['nbrPersonnes']);
						$r->set_calories($_POST['calories']);
						$r->set_Proteines($_POST['proteines']);
						$r->set_lipides($_POST['lipides']);
						$r->set_Glucides($_POST['glucides']);
						$r->set_illustration($_POST['illustration']);
						$r->set_descriptif($_POST['descriptif']);
						$r->set_difficulte($_POST['difficulte']);
						if(is_null($r->save()))
						{
							//message('error', 'Error while updating database');
							//header('Location: '.BASEURL.'/index.php/recipe/manageRecipe');
							//exit;
						}
						else
						{
							message('success', 'Informations changed');
							header('Location: '.BASEURL.'/index.php/recipe/manageRecipe');
							exit;
						}
					}
					else
					{
						message('error', 'Complete all fields');
						header('Location: '.BASEURL.'/index.php/recipe/editRecipe?idRecette='.$_POST['idRecette']);
						exit;
					}
				}
				break;
			case 'GET':
				include 'views/recipe/editRecipe.php';
				break;
		}
	}

	public function manageIngredient()
	{
		include 'views/user/manageIngredient.php';
	}

	public function editIngredient()
	{
		
	}
}

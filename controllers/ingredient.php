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
			if(user_connected())
			{
				if(check_post_values(array('nomIngredient', 'calories', 'lipides', 'glucides',  'proteines')) && empty_post_values(array('nomIngredient', 'calories', 'lipides', 'glucides',  'proteines')))
				{
					var_dump($_POST['nomIngredient']);
					if(is_null(ingredient::get_by_nomIngredient($_POST['nomIngredient'])))
					{
						if(isset($_POST['isGrammes']))
						{
							$checked = 1;
						}
						else
						{
							$checked = 0;
						}
						$i=ingredient::create(array(
							'nomIngredient'=>$_POST['nomIngredient'],
							'calories'=>$_POST['calories'],
							'Lipides'=>$_POST['lipides'],
							'Glucides'=>$_POST['glucides'],
							'Proteines'=>$_POST['proteines'],
							'Popularite'=>0,
							'isGrammes'=>$checked));

						message('success', 'Ingredient '.$_POST['nomIngredient'].' successfully created');
						header('Location: '.BASEURL.'/index.php/ingredient/createIngredient');
						exit;
					}
					else
					{
						message('error', 'Ingredient '.$_POST['nomIngredient'].' already existing');
						header('Location: '.BASEURL.'/index.php/ingredient/createIngredient');
						exit;
					}
				}
				else
				{
					message('error', 'Missing fields, please fill all the fields');
					header('Location: '.BASEURL.'/index.php/ingredient/createIngredient');
					exit;
				}	
			}
			else
			{
				header('Location: '.BASEURL);
			}
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
<?php

require_once 'models/recipe.php';
require_once 'models/user.php';
require_once 'models/contient.php';
require_once 'models/ingredient.php';

/**
* 
*/
class Controller_Contient 
{
	
public function __construct()
{}

	public function addIngredient()
	{
		switch ($_SERVER['REQUEST_METHOD']) 
		{
			case 'POST':
			if(user_connected())
			{
				if(check_post_values(array('nomIngredient', 'idRecette', 'quantite')) && empty_post_values(array('nomIngredient', 'idRecette', 'quantite')))
				{
					$i = Ingredient::get_by_nomIngredient($_POST['nomIngredient']);
						if($i->isGrammes())
						{
							$r = Contient::create(array(
								'nomIngredient'=>$_POST['nomIngredient'],
								'autoIdRecette'=>$_POST['idRecette'],
								'quantite'=>"",
								'grammes'=>$_POST['quantite']));
							$r->updateRecette();
						}
						else
						{
							$r = Contient::create(array(
								'nomIngredient'=>$_POST['nomIngredient'],
								'autoIdRecette'=>$_POST['idRecette'],
								'quantite'=>$_POST['quantite'],
								'grammes'=>""));
							$r->updateRecette();
						}
						//ajout de l'ingrédient dans la table contient						
						
						
						// on redirige l'utilisateur vers la page lui permettant de créer les ingrédients et étapes
						message('success',$_POST['nomIngredient'].' successfully added in '.recipe::get_by_id($_POST['idRecette'])->nomRecette());
				} 
				else
				{
					message('error','Missing fields');
					header('Location: '.BASEURL.'/index.php/contient/addIngredient');
					exit;
				}
				include 'views/contient/addIngredient.php';
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
				include 'views/contient/addIngredient.php';
				break;
			}
			else
			{
				header('Location: '.BASEURL);
				break;
			}
				
		}
	}

}

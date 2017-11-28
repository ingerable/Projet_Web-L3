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
				if(isset($_POST['idRecette']) && isset($_POST['nomIngredient']) && isset($_POST['quantite']))
				{
						if(Ingredient::get_by_nomIngredient($_POST['nomIngredient'])->isGrammes())
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
				include 'views/contient/addIngredient.php';
				break;
				
			case 'GET':
				include 'views/contient/addIngredient.php';
				break;
		}
	}

}

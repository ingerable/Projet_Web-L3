<?php

require_once 'models/recipe.php';
require_once 'models/user.php';
require_once 'models/contient.php';

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
				if(isset($_POST['idRecette']) && isset($_POST['nomIngredient']) && isset($_POST['quantite']) && isset($_POST['grammes']) )
				{
					// on vérifie que les 2 champs ne soient pas remplies, un ingrédient est définie en unité OU en poids 
					if($_POST['quantite']!='' && $_POST['grammes']!='')
					{
						message('error', 'You can either fill grammes or quantite but not both');
					}
					else
					{
						//ajout de l'ingrédient dans la table contient						
						$r = Contient::create(array(
								'nomIngredient'=>$_POST['nomIngredient'],
								'autoIdRecette'=>$_POST['idRecette'],
								'quantite'=>$_POST['illustration'],
								'grammes'=>$_POST['grammes']));
						// on redirige l'utilisateur vers la page lui permettant de créer les ingrédients et étapes
						message('success',$_POST['nomIngredient'].' successfully added in '.recipe::get_by_id($_POST['idRecette'])->nomRecette());
					}
				} 
				include 'views/contient/addIngredient.php';
				break;
				
			case 'GET':
				include 'views/contient/addIngredient.php';
				break;
		}
	}

}

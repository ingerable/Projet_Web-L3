<?php

require_once 'models/recipe.php';
require_once 'models/user.php';
require_once 'models/contient.php';
require_once 'models/planning.php';

class Controller_Planning
{

public function __construct()
	{}


public function addOrDelete()
{

	switch ($_SERVER['REQUEST_METHOD']) 
	{

		case 'POST':
		if(user_connected())
		{
				/*
				* On va s'occuper de construire la date en effectuant plusieurs vérifications,
				* la date doit correspondre au format attendue pour la BDD (YYYY-MM-DD)
				*/
				$localdate=localtime();
				$selectedDay = $_POST['day']+$localdate[3]-$localdate[6]; // jour selectionné dans le mois (jour de 1-7 + jour dans le mois - jour dans la semaine)			

				if( $selectedDay > date("t")) //si on dépasse le dernier jour du mois on passe au mois suivant 
				{
					//on fabrique la date à laquel l'utilisateur veut réaliser sa recette à partir des variables post
					$date = '20'.($localdate[5]%100).'-'.($localdate[4]+2).'-'.$selectedDay%date("t");
				}
				else
				{
					//on fabrique la date à laquel l'utilisateur veut réaliser sa recette à partir des variables post
					$date = '20'.($localdate[5]%100).'-'.($localdate[4]+1).'-'.$selectedDay;	
				}

				
				//on mets en forme pour la suppresion/insertion
				$startHour = $_POST['hour'].":00:00";
				

				/*
				* Maintenant on va vérifier si on veut supprimer la recette ou l'ajouter
				*/
				if(isset($_POST['delete-submit']))
				{
					$values = unserialize(base64_decode($_POST['recetteDeleteValues']));
					//on récupère l'objet recette
					$rp = Planning::plannedRecipeObj($values[2],$values[3],get_connected_user()->login(),$values[0]);

					if($rp!=null)
					{
						$rp->delete();
					}
				}
				else if(isset($_POST['add-submit']))
				{
					//ensuite on calcule combien de temps va prendre la recette
					$endHour;
					$recipe = Recipe::get_by_id($_POST['idRecette']);
					$length = $recipe->duree();

					if($length<60)//recette de - de 60 min
					{
						$endHour = $_POST['hour']+1;
					}
					else if($length%60>0) 
					{
						$endHour = $_POST['hour']+floor($length/60)+1;
					}
					else
					{
						$endHour = $_POST['hour']+floor($length/60);
					}

					$endHour = $endHour.":00:00";

					$p = Planning::create(array(
							"dateRealisation"=>$date,
							"autoIdRecette"=>$_POST['idRecette'],
							"login"=>(get_connected_user()->login()),
							"startHour"=>$startHour,
							"endHour"=>$endHour));
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
			include 'views/planning/managePlanning.php';
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
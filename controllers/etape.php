<?php

require_once 'models/recipe.php';
require_once 'models/user.php';
require_once 'models/contient.php';

/**
* 
*/
class Controller_Etape
{
	
	function __construct()
	{}

	public function addStage()
	{

		switch ($_SERVER['REQUEST_METHOD']) 
		{
			case 'POST':
			if(user_connected())
			{
				if(check_post_values(array('idRecette','Ordre','temps','illustration','description_etape')) && empty_post_values(array('Ordre','temps','description_etape')))
				{
					$etape = Etape::get_etape($_POST['idRecette'], $_POST['Ordre']);
					if(is_null($etape))
					{
						$etape = Etape::create(array(
							'Ordre'=>$_POST['Ordre'],
							'temps'=>$_POST['temps'],
							'illustration'=>$_POST['illustration'],
							'description_etape'=>$_POST['description_etape'],
							'autoIdRecette'=>$_POST['idRecette']));
						$etape->updateRecette();
						message('success', 'Stage '.$etape->ordre().' successfully created for recipe'.recipe::get_by_id($etape->autoIdRecette())->nomRecette());
					}
					else
					{
						message('error','Stage '.$_POST['Ordre'].' already exist for recipe'.recipe::get_by_id($_POST['idRecette'])->nomRecette());
						header('Location: '.BASEURL.'/index.php/etape/addStage');
						exit;
					}
				}
				else
				{
					message('error','Please fill Order, time and description');
					header('Location: '.BASEURL.'/index.php/etape/addStage');
					exit;
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
					include 'views/etape/addStage.php';
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

?>
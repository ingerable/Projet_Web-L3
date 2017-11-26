<?php
	$user =  get_connected_user();
	$allIngredients = $user->getIngredients();


if($_SERVER['REQUEST_METHOD']=='GET')
	{?>

	<h1 class="text-center"> Search recipes with your ingredients</h1>
	<form action="<?=BASEURL?>/index.php/recipe/searchRecipeIngredients" method="POST">
		<div>
			<h3 class="formline"> Vos Ingredients </h3>
			 	<select name="selectedIngredients[]"  multiple="multiple" class="recipeIngredientSearch">
			 	<?php 
				foreach ($allIngredients as $key => $ing) 
			 	{ 	
			    	echo '<option value='.$ing['nomIngredient'].'>'.$ing['nomIngredient'].'</option>';
			    }
			 	?>
	  			</select> 
	  		<input type="submit" value="Search">
		</div> <?php
	}
	else if($_SERVER['REQUEST_METHOD']=='POST')
	{
		if(!empty($_POST['selectedIngredients']))
		{
			$selectedIngredients[] = $_POST['selectedIngredients'];
			$recipes = recipe::get_recipes_contains($selectedIngredients); // on récupère tout les recettes contenant les ingrédients selectionnés
			echo '<ul>';
			foreach($recipes as $r)
			{
				
				echo '<li><h2><a href="'.BASEURL.'/index.php/recipe/displayRecipe?idRecette='.$r->autoIdRecette().'">'.$r->nomRecette().'</h2></li>';
			}
			echo '</ul>';	
		}
		
	} ?>




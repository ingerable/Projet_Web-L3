<?php
	$user =  get_connected_user();
	$allIngredients = ingredient::get_all_names();


if($_SERVER['REQUEST_METHOD']=='GET')
	{?>

	<h1 class="text-center"> Search recipes by ingredients</h1>
	<form action="<?=BASEURL?>/index.php/recipe/searchRecipeIngredients" method="POST">
		<div>
			<h3 class="formline"> Ingredients </h3>
			 	<select name="selectedIngredients[]"  multiple="multiple" class="recipeIngredientSearch">
			 	<?php 
				foreach ($allIngredients as $key => $ing) 
			 	{ 	
			    	echo '<option value='.$ing['nomIngredient'].'>'.$ing['nomIngredient'].'</option>';
			    }
			 	?>
	  			</select> 
	  	<p>Sort by :</p>
	  	<select name="sort">
	  		<option value='nomRecette'>name</option>
	  		<option value='Duree'>preparing time</option>
	  		<option value='calories'>calories</option>
	  		<option value='difficulte'>difficulty</option>
	  	</select>
		<input type="submit" value="Search">
		</div> </form>
		<?php
	}
	else if($_SERVER['REQUEST_METHOD']=='POST')
	{
		if(!empty($_POST['selectedIngredients']))
		{
			$selectedIngredients[] = $_POST['selectedIngredients'];
			$recipes = recipe::get_recipes_contains($selectedIngredients, $_POST['sort']); // on récupère tout les recettes contenant les ingrédients selectionnés
			echo '<ul>';
			foreach($recipes as $r)
			{
				echo '<li><h2><a href="'.BASEURL.'/index.php/recipe/displayRecipe?idRecette='.$r->autoIdRecette().'">'.$r->nomRecette().' by '.user::get_by_login($r->login())->get_full_name().'</h2></li>';
			}
			echo '</ul>';	
		}
		
	} ?>




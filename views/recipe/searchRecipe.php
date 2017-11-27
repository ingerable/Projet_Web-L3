<h1 class="text-center"> Search a recipe </h1>

<form action="<?=BASEURL?>/index.php/recipe/searchRecipe" method="post">
	<div>
		<div class ="formline">
			<label for="recipe">Name of the recipe :</label>
			<input type="text" name="recipe" id="recipe">
		</div>
		<div class ="formline">
		<label for="sort">Sort by  :</label>
	  	<select name="sort">
	  		<option value='nomRecette'>name</option>
	  		<option value='Duree'>preparing time</option>
	  		<option value='calories'>calories</option>
	  		<option value='difficulte'>difficulty</option>
	  	</select>
	  	<div class="formline">
	  	<input type="submit" value="Search">
	  	</div>
		</div>
	</div>
</form>


<ul id="navScroll" class="dropdown">
<?php
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$allRecipes = recipe::get_Recipe_Like($_POST["recipe"], $_POST["sort"]);
		echo '<ul>';
		foreach($allRecipes as $r)
		{	
			echo '<li><h2><a href="'.BASEURL.'/index.php/recipe/displayRecipe?idRecette='.$r->autoIdRecette().'">'.$r->nomRecette().' by '.user::get_by_login($r->login())->get_full_name().'</h2></li>';
		}
		echo '</ul>';
	}
	else if($_SERVER['REQUEST_METHOD']=='GET')
	{
		$allRecipes = recipe::get_all(); // on récupère toutes les recettes
		echo '<ul>';
		foreach($allRecipes as $r)
		{	
			echo '<li><h2><a href="'.BASEURL.'/index.php/recipe/displayRecipe?idRecette='.$r->autoIdRecette().'">'.$r->nomRecette().' by '.user::get_by_login($r->login())->get_full_name().'</h2></li>';
		}
		echo '</ul>';
	}	
	
	
?>
</ul>

<h1 class="text-center"> Search a recipe </h1>

<form action="<?=BASEURL?>/index.php/recipe/searchRecipe" method="post">
	<div>
		<div class ="formline">
			<label for="recipe">Name of the recipe :</label>
			<input type="text" name="recipe" id="recipe">
		<div class="formline">
			<input type="submit" name="Search" value="Search">
		</div>
		</div>
	</div>
</form>


<ul id="navScroll" class="dropdown">
<?php	
	$allRecipes = recipe::get_all(); // on récupère toutes les recettes
	echo '<ul>';
	foreach($allRecipes as $key => $r)
	{
	
		echo '<li><h2><a href="'.BASEURL.'/index.php/recipe/displayRecipe?idRecette='.$r->autoIdRecette().'">'.$r->nomRecette().'</h2></li>';
	}
	echo '</ul>';
?>
</ul>

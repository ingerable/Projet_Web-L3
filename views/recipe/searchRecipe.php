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
<?php

	echo '<ul>';
	$allRecettes = recipe::getAll();
	foreach()
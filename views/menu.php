<nav>
	<ul>
		<li><a href="<?=BASEURL?>">Home</a></li>
		<?php if (root_connected()) { ?>
			<li><a href="<?=BASEURL?>/index.php/user/manageuser">Manage users</a></li>
			<li><a href="<?=BASEURL?>/index.php/recipe/createRecipe">Manage recipes</a></li>
			<li><a href="<?=BASEURL?>/index.php/recipe/createRecipe">Manage ingredients</a></li>
			<li><a href="<?=BASEURL?>/index.php/user/signout">Sign out</a></li>
		<?php }else if (user_connected()) { ?>
			<li><a href="<?=BASEURL?>/index.php/planning/add">Planning </a></li>
			<li><a href="<?=BASEURL?>/index.php/recipe/searchRecipe">Search a recipe</a></li>
			<li><a href="<?=BASEURL?>/index.php/recipe/createRecipe">Create a recipe</a></li>
			<li><a href="<?=BASEURL?>/index.php/contient/addIngredient">Add ingredient</a></li>
			<li><a href="<?=BASEURL?>/index.php/etape/addStage">Add stage</a></li>		
			<li><a href="<?=BASEURL?>/index.php/recipe/searchRecipeIngredients">Recipes with your ingredients</a></li>	
			<li><a href="<?=BASEURL?>/index.php/user/signout">Sign out</a></li>

		<?php } else { ?>
			<li><a href="<?=BASEURL?>/index.php/user/signin">Sign in</a></li>
			<li><a href="<?=BASEURL?>/index.php/recipe/searchRecipe">Search a recipe</a></li>
		<?php }	?>
	</ul>
</nav>

<nav>
	<ul>
		<li><a href="<?=BASEURL?>">Home</a></li>
		<?php if (user_connected()) { ?>
			<li><a href="<?=BASEURL?>/index.php/note/mine">My notes</a></li>
			<li><a href="<?=BASEURL?>/index.php/note/shared">Shared with me</a></li>
			<li><a href="<?=BASEURL?>/index.php/user/signout">Sign out</a></li>
		<?php } else { ?>
			<li><a href="<?=BASEURL?>/index.php/user/signin">Sign in</a></li>
			<li><a href="<?=BASEURL?>/index.php/recipe/searchRecipe">Search a recipe</a></li>
		<?php }	?>
	</ul>
</nav>

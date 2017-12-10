<h1 class="text-center"> Manage ingredients </h1>

<form action="<?=BASEURL?>/index.php/recipe/manageIngredient" method="post">
	<div>
		<div class ="formline">
			<label for="ingredient">Name of the ingredient :</label>
			<input type="text" name="ingredient" id="ingredient">
		</div>
		<div class ="formline">
		<label for="sort">Sort by  :</label>
	  	<select name="sort">
	  		<option value='nomIngredient'>name</option>
	  		<option value='calories'>calories</option>
			<option value='Popularite'>popularity</option>
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
		$allIngredient = ingredient::get_Ingredient_Like($_POST["ingredient"], $_POST["sort"]);
		echo '<ul>';
		foreach($allIngredient as $r)
		{	
			echo '<li><h2><a href="'.BASEURL.'/index.php/recipe/editIngredient?nomIngredient='.$r->nomIngredient().'">'.$r->nomIngredient().'</h2></li>';
		}
		echo '</ul>';
	}
	else if($_SERVER['REQUEST_METHOD']=='GET')
	{
		$allIngredient = ingredient::get_all();
		echo '<ul>';
		foreach($allIngredient as $r)
		{	
			echo '<li><h2><a href="'.BASEURL.'/index.php/recipe/editIngredient?nomIngredient='.$r->nomIngredient().'">'.$r->nomIngredient().'</h2></li>';
		}
		echo '</ul>';
	}	
	
	
?>
</ul>

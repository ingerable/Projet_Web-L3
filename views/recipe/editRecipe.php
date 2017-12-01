<?php
$recipe = recipe::get_by_id($_GET["idRecette"]);
$author = User::get_by_login($recipe->login());
$ingredients = array();
$etapes = array();

//all ingredients in the recipe
$ingContient = Contient::get_Ingredients_Recipe($recipe->autoIdRecette());

//all stages
$etapes = $recipe->allEtapes();  
?>

<h1 class="text-center">Edit recipe : <?=$recipe->nomRecette()?> </h1>

<form action="<?=BASEURL?>/index.php/recipe/editRecipe" method="post">
	<div class="formline">
		<label>Name : </label>
		<input type="text" name="nomRecette" value="<?=$recipe->nomRecette()?>">
	</div>

	<div class="formline">
		<label>Number of person :</label>
		<input type="number" name="nbrPersonnes" min="1" value="<?=$recipe->nbrPersonnes()?>">
	</div>

	<div class="formline">
		<label>Illustration link :</label>
		<input type="text" placeholder="link" name="illustration" value="<?=$recipe->illustration()?>">
	</div>

	<div class="formline">
	<label>Difficulty :</label>
		 <select name="difficulte">
    		<option value=1>1</option>
    		<option value=2>2</option>
    		<option value=3>3</option>
    		<option value=4>4</option>
    		<option value=5>5</option>
  		</select>
  <br><br>
	</div>
	
	<div class="formline">
		<label>Description : </label>
		 	<textarea name="descriptif" rows="10" cols="30"><?=$recipe->descriptif();?></textarea> 
	</div>
	
	<div class="formline">
		<label></label>
		<input type="submit" value="Submit">
		<input type="submit" value="Cancel">
		<input type="submit" value="Delete recipe">
	</div>
	
</form>

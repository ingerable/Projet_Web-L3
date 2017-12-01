<?php
$recipe = recipe::get_by_id($_GET["idRecette"]);
$author = User::get_by_login($recipe->login());
$ingredients = array();
$etapes = array();

//all ingredients in the recipe
$ingContient = Contient::get_Ingredients_Recipe($recipe->autoIdRecette());
 
?>

<h1 class="text-center">Edit recipe : <?=$recipe->nomRecette()?> </h1>

<form action="<?=BASEURL?>/index.php/recipe/editRecipe" method="post">
	<div class="formline">
		<label>Recipe # : </label>
		<input type="text" name="idRecette" readonly="true" value="<?=$recipe->autoIdRecette()?>">
	</div>

	<div class="formline">
		<label>Name : </label>
		<input type="text" name="nomRecette" value="<?=$recipe->nomRecette()?>">
	</div>

	<div class="formline">
		<label>Number of person :</label>
		<input type="number" name="nbrPersonnes" min="1" value="<?=$recipe->nbrPersonnes()?>">
	</div>

	<div class="formline">
		<label>Calories :</label>
		<input type="number" name="calories" min="0" value="<?=$recipe->calories()?>">
	</div>

	<div class="formline">
		<label>Protein :</label>
		<input type="number" name="proteines" min="0" value="<?=$recipe->proteines()?>">
	</div>
	
	<div class="formline">
		<label>Fat :</label>
		<input type="number" name="lipides" min="0" value="<?=$recipe->lipides()?>">
	</div>

	<div class="formline">
		<label>Carbs :</label>
		<input type="number" name="glucides" min="0" value="<?=$recipe->glucides()?>">
	</div>

	<div class="formline">
		<label>Illustration link :</label>
		<input type="text" placeholder="link" name="illustration" value="<?=$recipe->illustration()?>">
	</div>

	<div class="formline">
	<label>Difficulty :</label>
		<select name="difficulte">
    		<option value=1 <?php if($recipe->difficulte()==1){echo 'selected="selected"';}?>>1</option>
    		<option value=2 <?php if($recipe->difficulte()==2){echo 'selected="selected"';}?>>2</option>
    		<option value=3 <?php if($recipe->difficulte()==3){echo 'selected="selected"';}?>>3</option>
    		<option value=4 <?php if($recipe->difficulte()==4){echo 'selected="selected"';}?>>4</option>
    		<option value=5 <?php if($recipe->difficulte()==5){echo 'selected="selected"';}?>>5</option>
  		</select>
  <br><br>
	</div>
	
	<div class="formline">
		<label>Description : </label>
		 	<textarea name="descriptif" rows="10" cols="30"><?=$recipe->descriptif();?></textarea> 
	</div>
	
	<div class="formline">
		<label></label>
		<input type="submit" name="submit" value="Submit">
		<input type="submit" name="cancel" value="Cancel">
		<input type="submit" name="delete" value="Delete recipe">
	</div>
	
</form>

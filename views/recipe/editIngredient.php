<?php
$ingredient = Ingredient::get_by_nomIngredient($_GET["nomIngredient"]); 
?>

<h1 class="text-center">Edit ingredient : <?=$ingredient->nomIngredient()?> </h1>

<form action="<?=BASEURL?>/index.php/recipe/editIngredient" method="post">
	<div class="formline">
		<label>Name : </label>
		<input type="text" name="nomIngredient" readonly="true" value="<?=$ingredient->nomIngredient()?>">
	</div>

	<div class="formline">
		<label>Calories :</label>
		<input type="number" name="calories" min="0" value="<?=$ingredient->calories()?>">
	</div>

	<div class="formline">
		<label>Protein :</label>
		<input type="number" name="proteines" min="0" value="<?=$ingredient->Proteines()?>">
	</div>
	
	<div class="formline">
		<label>Fat :</label>
		<input type="number" name="lipides" min="0" value="<?=$ingredient->Lipides()?>">
	</div>

	<div class="formline">
		<label>Carbs :</label>
		<input type="number" name="glucides" min="0" value="<?=$ingredient->Glucides()?>">
	</div>

	<div class="formline">
		<label>Popularity :</label>
		<input type="number" name="popularite" min="0" value="<?=$ingredient->Popularite()?>">
	</div>

	<div class="formline">
		<input type="checkbox" name="isGrammes" value="isGrammes" <?php if($ingredient->isGrammes()==1){echo 'checked';}?>>Measure in grammes ? (if not ,will be exprimed in units)<br>
	</div>
	
	<div class="formline">
		<label></label>
		<input type="submit" name="submit" value="Submit">
		<input type="submit" name="cancel" value="Cancel">
		<input type="submit" name="delete" value="Delete ingredient">
	</div>
	
</form>

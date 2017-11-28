<?php
$user = get_connected_user();
$allYourRecipes = $user->getRecipes();
$allIngredient = ingredient::get_all_names();
?>

<h1 style="text-align: center"> Add an ingredient</h1>
<form action="<?=BASEURL?>/index.php/contient/addIngredient" method="POST">	
	<div class="formline">
		<label>Recette </label>			
		 <select name="idRecette">'
		 <?php
		 	foreach ($allYourRecipes as $key => $recipe) 
			{
    			echo '<option value='.$allYourRecipes[$key]['autoIdRecette'].'>'.$allYourRecipes[$key]['nomRecette'].'</option>';
    		}?>
  		  </select>
  	</div>

	<div class="formline">
		<label>Ingredient </label>			
		 <select name="nomIngredient">'
		 <?php
		 	foreach ($allIngredient as $key => $ingredient) 
			{
    			echo '<option value='.$allIngredient[$key]['nomIngredient'].'>'.$allIngredient[$key]['nomIngredient'].'</option>';
    		}?>
  		  </select>
  	</div>

	<div class="formline">
		<label>Units/grammes :</label>
			<input type="number" name="quantite">
	</div>
	
	<div class="formline">
		<label></label>
		<input type="submit" value="Add">	
	</div>
</form>
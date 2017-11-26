<?php
$user = get_connected_user();
$allYourRecipes = $user->getRecipes();
?>
	<h1 style="text-align: center"> Add a stage</h1>
	<div class="formline">
		<label>Recette </label>			
		 <select name="nomRecette">'
		 <?php
		 	foreach ($allYourRecipes as $key => $recipe) 
			{

    			echo '<option value='.$allYourRecipes[$key]['autoIdRecette'].'>'.$allYourRecipes[$key]['nomRecette'].'</option>';
    		}?>
  			</select>
	</div>
	<div class="formline">
		<label>Ordre</label>
			<input type="number" name="Ordre">
	</div>

	<div class="formline">
		<label>Time (minutes)</label>
			<input type="number" name="temps">
	</div>
	<div class="formline">
		<label>Link for an illustration</label>
			<input type="text" placeholder="link" name="illustration">
	</div>
	<div class="formline">
		<label>Description</label>
		 <textarea name="description_etape" rows="10" cols="30"></textarea> 
	</div>
	<div class="formline">
		<label></label>
		<input type="submit" value="Add">	
	</div>
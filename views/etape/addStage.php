<?php
$user = get_connected_user();
$allYourRecipes = $user->getRecipes();
?>
<h1 style="text-align: center"> Add a stage</h1>
<form action="<?=BASEURL?>/index.php/etape/addStage" method="POST">	
	<div class="formline">
		<label>Recette </label>			
		 <select name="idRecette">'
		 <?php
		 	foreach ($allYourRecipes as $key => $recipe) 
			{

    			echo '<option value='.$allYourRecipes[0]['autoIdRecette'].'>'.$allYourRecipes[0]['nomRecette'].'</option>';
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
</form>
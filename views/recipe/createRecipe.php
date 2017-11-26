<h1 class="text-center">Create your recipe</h1>

<form action="<?=BASEURL?>/index.php/recipe/createRecipe" method="post">
	<div class="formline">
		<label>Choose a name</label>
		<input type="text" name="nomRecette">
	</div>

	<div class="formline">
		<label>For how many persons ?</label>
		<input type="number" name="nbrPersonnes" min="1">
	</div>

	<div class="formline">
		<label>Number of stages</label>
		<input type="number" name="nbrStages" min="1">
	</div>

	<div class="formline">
		<label>Number of ingredients</label>
		<input type="number" name="nbrIngredients" min="1">
	</div>

	<div class="formline">
		<label>Link for an illustration</label>
		<input type="text" placeholder="link" name="illustration">
	</div>

	<div class="formline">
	<label>Difficulty </label>
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
		<label>Description</label>
		 	<textarea name="descriptif" rows="10" cols="30"></textarea> 
	</div>
	
	<div class="formline">
		<label></label>
		<input type="submit" value="Create">	
	</div>
	
</form>

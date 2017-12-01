<form method="post" action="<?=BASEURL?>/index.php/ingredient/createIngredient">
<p class="directive">Please consider the informations for 100 grammes or 1 unit !</p>
<div class="formline">
<label for="nomIngredient">Name of ingredient :</label>
<input type="text" name="nomIngredient">
</div class="formline">
<div class="formline">
<label for="calories">Calories :</label>
<input type="number" name="calories" step="0.1">
</div>
<div class="formline">
<label for="lipides">Lipides :</label>
<input type="number" name="lipides" step="0.1">
</div>
<div class="formline">
<label for="glucides">Glucides :</label>
<input type="number" name="glucides" step="0.1">
</div>
<div class ="formline">
<label for="proteines">Proteines :</label>
<input type="number" name="proteines" step="0.1">
</div>
<div class="formline">
<input type="checkbox" name="isGrammes" value="isGrammes">Measure in grammes ? (if not ,will be exprimed in units)<br>
</div>
<div class="formline">
<input type="submit" value="Create">	
</div>
</form>
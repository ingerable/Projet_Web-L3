<?php
$allIngredients = Ingredient::get_all_names();

for ($i=1; $i <= $_GET["nbrStages"]; $i++) 
{ 
	echo '<h3> Stage '.$i.'</h3>
		<div class="formline">
			<label>Time (minutes)</label>
			<input type="number" name="temps'.$i.'">
		</div>
		<div class="formline">
			<label>Link for an illustration</label>
			<input type="text" placeholder="link" name="illustration'.$i.'">
		</div>
		<div class="formline">
			<label>Description</label>
		 	<textarea name="description_etape'.$i.'" rows="10" cols="30">
		 	</textarea> 
		</div>';
}

for ($i=1; $i <= $_GET["nbrIngredients"] ; $i++) 
{ 
	echo '<h3> Ingrédient '.$i.'</h3>
	
		<div class="formline">
			<label>Quantity</label>
			<input type="number" name="nbrIngredients" min="1">
		</div>
		<div class="formline">
			<label>grammes</label>
			<input type="number" name="nbrIngredients" min="1">
		</div>';

	
		echo '
		<div class="formline">
			<label>ingredient </label>			
		 	<select name="Ingredient">';

		 	foreach ($allIngredients as $key => $ing) 
			{

    			echo '<option value='.$allIngredients[$key]['nomIngredient'].'>'.$allIngredients[$key]['nomIngredient'].'</option>';
    		}
  			echo '</select>
					</div>';
	}

<?php
	$recipe = recipe::get_by_id($_GET["idRecette"]);
	$ingredients = array();
	$etapes = array();
	//all ingredients
	$ingredients = $recipe->allIngredients();

	//all stages
	$etapes = $recipe->allEtapes(); 


	
echo '<article class="h-recipe">
  <h1 class="'.$recipe->nomRecette().'">'.$recipe->nomRecette().'</h1>
  <div class ="recipePicDiv">
  	<span class ="recipePicSpan"><img src="'.$recipe->illustration().'"illustration>
  	 Takes '.$recipe->hours().' hours and '.$recipe->minutes().' minutes 
     for '.$recipe->nbrPersonnes().' persons </span>
  </div>';


  echo '<h2> Ingredients </h2><ul>';

 foreach ($ingredients as $key => $ing) 
 {
 	echo '<li class="p-ingredient">'.$ing->nomIngredient().'</li>';
 }
 echo '</ul><div class="e-instructions">'; 
 
   foreach ($etapes as $key => $etape) 
 {
 	$minutes = ($etape->temps() % 60);
 	$hour = floor(($etape->temps() / 60));
 	echo '<h3>Stage '.$etape->ordre().' : '.$hour.' hours and '.$minutes.' minutes </h3>';
 	echo '<p class="stage">'.$etape->description_etape().'</p>';
 }
    
 echo '</div></article>';     
    

?>
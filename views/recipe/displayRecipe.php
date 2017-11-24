<?php
	$recipe = recipe::get_by_id($_GET["idRecette"]);
	$ingredients = array();
	$etapes = array();
	$ingredients = $recipe->allIngredients();
	$etapes = $recipe->allEtapes(); 


echo '<article class="h-recipe">
  <h1 class="'.$recipe->nomRecette().'">'.$recipe->nomRecette().'</h1>
  <div class ="recipePicDiv">
  	<span class ="recipePicSpan"><img src="'.$recipe->illustration().'"illustration>
  	 Takes <time class="rightToRecipeIllustration" datetime="'.$recipe->duree().'H">'.$recipe->duree().'</time>,
     serves <data class="rightToRecipeIllustration" value="'.$recipe->nbrPersonnes().'">'.$recipe->nbrPersonnes().'</data></span>
  </div>';


 


  echo '<h2> Ingredients </h2><ul>';

 foreach ($ingredients as $key => $ing) 
 {
 	echo '<li class="p-ingredient">'.$ing->nomIngredient().'</li>';
 }
 echo '</ul><div class="e-instructions">'; 
 
   foreach ($etapes as $key => $etape) 
 {
 	echo '<h3>Stage '.$etape->ordre().' : '.$etape->temps().' minutes </h3>';
 	echo '<p class="stage">'.$etape->description_etape().'</p>';
 }
    
 echo '</div></article>';     
    

?>
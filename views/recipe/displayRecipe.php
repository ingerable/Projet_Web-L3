<?php
	$recipe = recipe::get_by_id($_GET["idRecette"]);
	$author = User::get_by_login($recipe->login());
	$ingredients = array();
	$etapes = array();

	//all ingredients in the recipe
	$ingContient = Contient::get_Ingredients_Recipe($recipe->autoIdRecette());

	//all stages
	$etapes = $recipe->allEtapes(); 

	//recipe time
	$minutes = ($recipe->duree() % 60);
 	$hour = floor(($recipe->duree() / 60));
	
echo '<article class="h-recipe">
  <h1 class="'.$recipe->nomRecette().'">'.$recipe->nomRecette().' by '.$author->prenom().' '. $author->nom().'</h1>
  <div class ="recipePicDiv">
  	<span class ="recipePicSpan"><img src="'.$recipe->illustration().'"illustration>
  	 Takes '.$hour.' hours and '.$minutes.' minutes 
     for '.$recipe->nbrPersonnes().' persons </span>
  </div>


<p class = "difficulty"> Difficulty :'.$recipe->difficulte().'/5 </p>

<h2> Description </h2>
'.$recipe->descriptif().'
<h2> Caracteristics </h2>
	<ul>
		<li>Lipides :'.$recipe->lipides().' grammes</li>
		<li>Glucides :'.$recipe->glucides().' grammes</li>
		<li>Proteines :'.$recipe->proteines().' grammes</li>
		<li>Calories :'.$recipe->calories().' </li>
	</ul>';

 


  echo '<h2> Ingredients </h2><ul>';

 foreach ($ingContient as $key => $c) 
 {
 	// on récupère l'ingrédient
 	$ingredient = Ingredient::get_by_nomIngredient($c->nomIngredient());
 	
 	if($ingredient->isGrammes())
 	{
 		echo '<li class="p-ingredient">'.$c->nomIngredient().' : '.$c->grammes().' grammes</li>';
 	}
 	else
 	{
 		echo '<li class="p-ingredient">'.$c->nomIngredient().' : '.$c->quantite().' units</li>';
 	}
 	
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
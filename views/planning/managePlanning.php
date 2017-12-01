<?php
$user = get_connected_user();
$login = $user->login();
$allRecipes = Recipe::get_all();
$allPlannedRecipes = Planning::get_user_all_recipe($login);
$date = localtime();
?>



<form action="<?=BASEURL?>/index.php/planning/addOrDelete" method="post">
    <label for="idRecette">Recipe to add :</label>     
     <select name="idRecette">
     <?php
      foreach ($allRecipes as $key => $recipe) 
      {
          echo '<option value='.$recipe->autoIdRecette().'>'.$recipe->nomRecette().' by '.user::get_by_login($recipe->login())->get_full_name().'</option>';
        }?>
        </select>


    <label for="day">Day </label>     
     <select name="day">
        <option value="1">Monday</option>
        <option value="2">Tuesday</option>
        <option value="3">Wednsday</option>
        <option value="4">Thursday</option>
        <option value="5">Friday</option>
        <option value="6">Sunday</option>
        <option value="7">Saturday</option>
      </select>

    <label for="day">Hour </label>
     <select name="hour">
     <?php
      for ($i=8; $i < 24 ; $i++) 
      { 
        $time = $i.':00-'.($i+1).':00';
        echo' <option value="'.$i.'">'.$time.'</option>';
      }
       ?>

      </select> 
   
    <label for="recetteDeleteValues">Recipe to delete :</label>     
     <select name="recetteDeleteValues">
    <?php

    foreach ($allPlannedRecipes as $key => $recipeP) 
    {
      $r = recipe::get_by_id($recipeP->autoIdRecette());
      
      //valeurs qui permettront de supprimer la recette, on va sérialiser le tableau puis l'envoyer
      $values = array();
      $values[] = $r->autoIdRecette();
      $values[] = $r->nomRecette();
      $values[] = $recipeP->dateRealisation();
      $values[] = $recipeP->startHour();


      echo '<option value='.base64_encode(serialize($values)).'>'.$values[1].' by '.user::get_by_login($recipe->login())->get_full_name().' on '.$values[2].' at '.$values[3].'</option>';
    }?>
   </select>
    <input name="add-submit" type="submit" value="Add">
  <input name="delete-submit" type="submit" value="delete"> 
</form>



<?php echo'<p> Week of the '.($date[3]-$date[6]+1).'/'.($date[4]+1).'/'.($date[5]%100).'  </p>'; ?> 

<table id="planning">
  <tr>
    <th>hours</th>
    <th>Monday</th>
    <th>Tuesday</th>
    <th>Wednsday</th>
    <th>Thursday</th>
    <th>Friday</th>
    <th>Sunday</th>
    <th>Saturday</th>
  </tr>
 <tr>

 <?php

 for ($h=8; $h<24 ; $h++) 
{ 
    echo '<tr>';
      echo ' <th>'.$h.':00-'.($h+1).':00</th>';
      for ($d=1; $d < 8 ; $d++) 
      { 
        $day = $date[3]-$date[6]+$d; // date du jour de la cellule actuelle du tableau
        if( $day > date("t")) // si on dépasse le nombre de jours du mois
        {
          $date_p = '20'.($date[5]%100).'-'.($date[4]+2).'-'.$day%date("t");

          echo  '<th>'.Planning::plannedRecipe($date_p,$h+1,$login).'</th>';
        }
        else
        {
          $date_p = '20'.($date[5]%100).'-'.($date[4]+1).'-'.$day;
          echo  '<th>'.Planning::plannedRecipe($date_p,$h+1,$login).'</th>';
        }  
      }
    echo '</tr>';
 }
?>
</table>




<?php
$allRecipes = Recipe::get_all();
$date = localtime();
?>



<form action="<?=BASEURL?>/index.php/planning/addOrDelete" method="post">
    <label for="idRecette">Recipe </label>     
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
    <input name="add-submit" type="submit" value="Add">
  <input name="delete-submit" type="submit" value="delete"> 
</form>



<?php echo'<p> Week of the '.($date[3]-$date[6]).'/'.($date[4]+1).'/'.($date[5]%100).'  </p>'; ?> 

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
          echo  '<th>'.Planning::plannedRecipe($day%date("t")+1,($date[4]+2),('20'.($date[5]%100)),$h+1).'</th>';
        }
        else
        {
          echo  '<th>'.Planning::plannedRecipe($day,($date[4]+1),('20'.($date[5]%100)),$h+1).'</th>';
        }  
      }
    echo '</tr>';
 }
?>
</table>




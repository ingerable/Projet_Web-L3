<?php
$allRecipes = Recipe::get_all();
?>


<form action="<?=BASEURL?>/index.php/recipe/createRecipe" method="post">
 <div class="formline">
    <label for="idRecette">Recipe </label>     
     <select name="idRecette">
     <?php
      foreach ($allRecipes as $key => $recipe) 
      {
          echo '<option value='.$recipe->autoIdRecette().'>'.$recipe->nomRecette().' by '.user::get_by_login($recipe->login())->get_full_name().'</option>';
        }?>
        </select>
  </div>

 <div class="formline">
    <label for="day">Day </label>     
     <select name="day">
        <option value="Monday">Monday</option>
        <option value="Tuesday">Tuesday</option>
        <option value="Wednsday">Wednsday</option>
        <option value="Thursday">Thursday</option>
        <option value="Friday">Friday</option>
        <option value="Sunday">Sunday</option>
        <option value="Saturday">Saturday</option>
      </select>
  </div>  

  <div class="formline">
    <label for="day">Day </label>     
     <select name="hour">
     <?php
      for ($i=8; $i < 20 ; $i++) 
      { 
        $time = $i.':00-'.($i+1).':00';
        echo' <option value="'.$time.'">'.$time.'</option>';
      }
       ?>

      </select>
  </div>  

  <div class="formline">
    <label></label>
    <input type="submit" value="Add"> 
  </div>
</form>
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
  <th>8:00-9:00</th>
 </tr>
 <tr>
  <th>9:00-10:00</th>
 </tr>
 <tr>
  <th>10:00-11:00</th>
 </tr>
 <tr>
  <th>11:00-12:00</th>
 </tr>
 <tr>
  <th>12:00-13:00</th>
 </tr>
 <tr>
  <th>13:00-14:00</th>
 </tr>
 <tr>
  <th>14:00-15:00</th>
 </tr>
 <tr>
  <th>15:00-16:00</th>
 </tr>
 <tr>
  <th>16:00-17:00</th>
 </tr>
 <tr>
  <th>17:00-18:00</th>
 </tr>
 <tr>
  <th>18:00-19:00</th>
 </tr>
  <tr>
  <th>19:00-20:00</th>
 </tr>

</table>




<?php
require_once 'models/List_.php';
if(isset($id)) {$l=List_::getById($id);}
if(!is_null($l)) {$name=$l->getName();}

?>
<h1>List : <?php if(isset($name)) {echo $name;}?></h1>
<h2>Add new article</h2>
<form method="post" action="<?=BASEURL?>/index.php/list/viewlist/<?=$id?>">
  <label>Article name :</label> <input type="text" name="name">
  <label>State :</label> <select name="state">
  <option value="To buy">To buy</option>
  <option value="Bought">Bought</option>
</select>
<button type="submit">Add</button>
</form>
<?php
$articlelist=$l->getArticlesFromList();
if(!is_null($articlelist))
{
    foreach ($articlelist as $key => $value) {
      ?>
      <ul>
    		<li><?=$articlelist[$key]['name']?> | <?=$articlelist[$key]['state']?> <a href="<?=BASEURL?>/index.php/article/articledeleter/<?=$articlelist[$key]['id']?>">Delete</a> <a href="<?=BASEURL?>/index.php/article/changestate/<?=$articlelist[$key]['id']?>">Change state</a></li>
    	</ul>
      <?php
    }
}
else {
  ?>
  <p>No articles yet...</p>
  <?php
}
?>

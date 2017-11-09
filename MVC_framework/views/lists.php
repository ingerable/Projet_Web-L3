<h1 class="text-center">
    Welcome <?php if(isset($user)) {echo $user;}?> !
</h1>
<h2>
  My lists
</h2>
<?php
require_once 'models/List_.php';
require_once 'models/User.php';
$u=User::getByLogin($_SESSION['user']);
$res=List_::getAllListByOwner($u->getId());
if(is_null($res))
{
  echo"<p>No list yet, please create one...</p>";
}
else {
  foreach ($res as $key => $value) {
    ?>
    <form>
    <label>List : <?=$res[$key]['name']?></label>
    <a href="<?=BASEURL?>/index.php/list/viewlist/<?=$res[$key]['id']?>">Views list</a>
    <a href="<?=BASEURL?>/index.php/list/listdeleter/<?=$res[$key]['id']?>">Delete list</a>
  </form>
    <?php
  }
}
?>

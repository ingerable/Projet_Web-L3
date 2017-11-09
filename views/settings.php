<h1> Settings </h1>
<form action="<?=BASEURL?>/index.php/user/delete">
<button type="submit">Delete account</button>
</form>
<form method="post" action="<?=BASEURL?>/index.php/user/changepassword">
  New password : <input type="password" name="pwd">
  Repeat new password : <input type="password" name="rpwd">
<button type="submit">Change password</button>
</form>

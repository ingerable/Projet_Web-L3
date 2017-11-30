<?php $user=User::get_by_login($_GET['login']);

echo '<h1 class="text-center">Editing user : '.$user->login().'</h1>';

echo '<form action="'.BASEURL.'/index.php/user/editUser" method="post">
	<div>
		<div class ="formline">
			<label for="login">Login :</label>
			<input type="text" name="login" id="login" value="'.$user->login().'">
		</div>
		<div class ="formline">
			<label for="adresse">Mail :</label>
			<input type="text" name="adresse" id="adresse" value="'.$user->adresse().'">
		</div>
		<div class ="formline">
			<label for="nom">Lastname :</label>
			<input type="text" name="nom" id="nom" value="'.$user->nom().'">
		</div>
		<div class ="formline">
			<label for="prenom">Firstname :</label>
			<input type="text" name="prenom" id="prenom" value="'.$user->prenom().'">
		</div>
	</div>
	<input type="submit" value="Submit">
	<form action="'.BASEURL.'/index.php/user/manageUser"> 
		<input type="submit" value="Cancel"> 
	</form>
	<button href="'.BASEURL.'/index.php/user/deleteUser?login='.$user->login().'"> Delete user </button>
</form>'




?>




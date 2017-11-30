<?php $user=User::get_by_login($_GET['login']);

echo '<h1 class="text-center">Editing user : '.$user->login().'</h1>';

echo '<form action="'.BASEURL.'/index.php/user/editUser" method="post">
	<div>
		<div class ="formline">
			<label for="login">Login :</label>
			<input type="text" name="login" readonly="true" id="login" value="'.$user->login().'">
		</div>
		<div class ="formline">
			<label for="mdp">Password :</label>
			<input type="password" name="mdp" id="mdp">
		</div>
		<div class ="formline">
			<label for="mdpc">Confirme password :</label>
			<input type="password" name="mdpc" id="mdpc">
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
	<input type="submit" name="submit" value="Submit">
	<input type="submit" name="cancel" value="Cancel"> 
	<input type="submit" name="delete" value="Delete user">
</form>
'




?>




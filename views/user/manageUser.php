<h1 class="text-center"> Manage users </h1>

<ul id="navScroll" class="dropdown">
<?php
	if($_SESSION['user_login']=='root')
	{
		$allUser = user::get_all(); // on récupère tout les utilisateurs
		echo '<ul>';
		foreach($allUser as $u)
		{	
			echo '<li><h2><a href="'.BASEURL.'/index.php/user/editUser?login='.$u->login().'">'.$u->login().'</h2></li>';
		}
		echo '</ul>';
	}		
?>
</ul>

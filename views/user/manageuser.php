<h1 class="text-center"> Manage recipes </h1>

<ul id="navScroll" class="dropdown">
<?php
	if($_SESSION['user_login']=='root')
	{
		$allUser = user::get_all(); // on récupère toutes les recettes
		echo '<ul>';
		foreach($allUser as $u)
		{	
			echo '<li>'.$u->login().'</li>';
		}
		echo '</ul>';
	}		
?>
</ul>

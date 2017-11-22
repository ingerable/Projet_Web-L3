<h1 class="text-center">Sign up</h1>

<form action="<?=BASEURL?>/index.php/user/signup" method="post">
	<div class="formline">
		<label>Choose a login</label>
		<input type="text" placeholder="login" name="login">
	</div>
	
	<div class="formline">
		<label>Choose a password</label>
		<input type="password" placeholder="*****" name="password">
	</div>
	
	<div class="formline">
		<label>Confirm password</label>
		<input type="password" placeholder="*****" name="password_check">
	</div>
	
	<div class="formline">
		<label></label>
		<input type="submit" value="Sign up">	
	</div>
	
</form>

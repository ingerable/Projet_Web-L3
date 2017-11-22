<h1 class="text-center">
	Create note
</h1>

<form action="<?=BASEURL?>/index.php/note/create" method="post">
	<div class="formline">
		<label for="title">Note title</label>
		<input type="text" id="title" placeholder="title" name="title">
	</div>
	
	<div class="formline">
		<label for="text">Note text</label>
		<textarea id="text" name="text" rows="10"></textarea>
	</div>
	
	<div class="formline">
		<label></label>
		<input type="submit" value="Create">
	</div>
</form>

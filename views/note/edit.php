<h1 class="text-center">
	Edit note
</h1>

<form action="<?=BASEURL?>/index.php/note/edit/<?=$note->id()?>" method="post">
	<div class="formline">
		<label for="title">Note title</label>
		<input type="text" id="title" placeholder="title" name="title" value="<?=$note->title()?>">
	</div>
	
	<div class="formline">
		<label for="text">Note text</label>
		<textarea id="text" name="text" rows="10"><?=$note->text()?></textarea>
	</div>
	
	<div class="formline">
		<label></label>
		<input type="submit" value="Edit">
	</div>
</form>

<?php if ($note->is_created_by($u)) { ?>
	<form action="<?=BASEURL?>/index.php/note/share/<?=$note->id()?>" method="post">
		<div class="formline">
			<label for="shared_with">Shared with</label>
			<?php
				$shared_with_names = array();
				foreach ($shared_with as $u) {
					$shared_with_names[] = $u->login();
				}
			?>
			<input type="text" id="shared_with" name="shared_with" value="<?= implode(',', $shared_with_names) ?>">
		</div>
		
		<div class="formline">
			<label></label>
			<input type="submit" value="Update">
		</div>
	</form>

	<form class="noborder" action="<?=BASEURL?>/index.php/note/delete/<?=$note->id()?>" method="post">
		<div class="formline">
			<input type="submit" value="Delete">
		</div>
	</form>
<?php } ?>

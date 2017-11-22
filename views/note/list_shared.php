<h1 class="text-center">
	Shared with me
</h1>

<?php if (empty($notes)) { ?>

<p class="text-center">No note here for now..</p>

<?php } else { ?>

<ul class="squarelist">
	<?php foreach ($notes as $n) { ?>
		<li>
			<h2><?= $n->title() ?></h2>
			<?php
				$creator = User::get_by_id($n->creator());
			?>
			<p class="text-right text-small">creator: <?= $creator->login() ?></p>
			<p><?= $n->text_start() ?></p>
			<p class="text-right">
				<a href="<?=BASEURL?>/index.php/note/edit/<?=$n->id()?>"> Edit </a>
			</p>
			<?php
				$leu = User::get_by_id($n->last_edit_user());
				if (!is_null($leu)) {
					$leu_login = $leu->login();
				} else {
					$leu_login = 'unknown';
				}
			?>
			<p class="text-right text-small">last edit by <?=$leu_login?> <br> <?=$n->last_edit_time()->format('Y-m-d H:i:s')?></p>
		</li>
	<?php } ?>
</ul>

<?php } ?>

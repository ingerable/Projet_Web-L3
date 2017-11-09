<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="<?=BASEURL?>/css/normalize.css" type="text/css">
	<link rel="stylesheet" href="<?=BASEURL?>/css/style.css" type="text/css">
	<title> W31 </title>
	<script> var baseurl = '<?=BASEURL?>'; </script>
</head>

<body>

<?php
include 'header.php';
if(isset($_SESSION['user']))
{
	include 'menuCo.php';
}
else {
	include 'menu.php';
}


if (isset($_SESSION['message'])) {
	$m = $_SESSION['message'];
	echo('<div class="message '.$m['type'].'">'.$m['text'].'</div>');
	unset($_SESSION['message']);
}
?>

<main>
<?php echo $content; ?>
</main>

<?php
include 'footer.php';
?>

</body>

</html>

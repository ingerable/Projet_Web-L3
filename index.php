<?php


require_once 'global/config.php';
require_once 'global/utils.php';
require_once 'models/model_base.php';

$db = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
Model_Base::set_db($db);

session_set_cookie_params(6000, '/', '', false, true);
session_start();

// date_default_timezone_set('Europe/Paris');

define('BASEURL', dirname($_SERVER['SCRIPT_NAME']));

ob_start();

if(isset($_SERVER['PATH_INFO'])) {
	$args = explode('/', $_SERVER['PATH_INFO']);
	$found = false;

	if(count($args) >= 3) {
		$controller = $args[1];
		$method = $args[2];
		$params = array();
		for ($i=3; $i < count($args); $i++) { 
			$params[] = $args[$i];
		}

		$controller_file = dirname(__FILE__).'/controllers/'.$controller.'.php';
		if (is_file($controller_file)) {
			require_once $controller_file;
			$controller_name = 'Controller_'.ucfirst($controller);
			if (class_exists($controller_name)) {
				$c = new $controller_name;
				if (method_exists($c, $method)) {
					$found = true;
					call_user_func_array(array($c, $method), $params);
				}
			}
		}
	}

	if (!$found) {
		http_response_code(404);
		include('views/errors/404.php');
	}
} else {
	include 'views/home.php';
}

$content = ob_get_clean();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="<?=BASEURL?>/css/normalize.css" type="text/css">
	<link rel="stylesheet" href="<?=BASEURL?>/css/style.css" type="text/css">
	<title> Notes </title>
	<script> var baseurl = '<?=BASEURL?>'; </script>
</head>
<body>

<?php
include 'views/header.php';
include 'views/menu.php';

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
include 'views/footer.php';
?>

</body>
</html>

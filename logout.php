<?php
	session_start();
?>

<!DOCTYPE html>
<html lang = "en">
	<head>
		<title>Logging You Out</title>
	</head>
	<body>
		Thank you for using our service. You will be soon redirected to the last page you were in. If not then <a href="<?php header('Location: index.php'); echo 'index.php';?>>Click Here</a>
		<?php
			session_destroy();
		?>
	</body>
</html>
<?php
	require "config.php";

	if(!isset($_SESSION[user_type]) || $_SESSION[user_type]!='admin') {
		header("Location: index.php");
	}
?>

<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "UTF-8">
		<title></title>
	</head>
	<body>
		
	</body>
</html>
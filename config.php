<?php
	session_start();

	$_SESSION['lastpage'] = $_SERVER['PHP_SELF'];

	$login_status = false;
	$connection_status = false;
	$curr_user_type = "";
	$curr_user_id = "";
	$curr_username = "";
	$curr_user_email = "";
	$curr_user_type_id = "";

	$conn= mysqli_connect("localhost", "root", "", "eshop");

	if(!$conn) {
		die("Connection failed");
	}
	else {
		$connection_status = true;
	}

	if( isset($_SESSION['email']) && isset($_SESSION['name']) && isset($_SESSION['user_id'])) {
		$curr_user_id = $_SESSION['user_id'];
		$curr_email = $_SESSION['email'];
		$curr_username = $_SESSION['name'];
		$curr_user_type = $_SESSION['role'];
		$curr_user_type_id = $_SESSION['user_type_id'];
		$login_status = true;

		if(isset($_COOKIE['guest'])) {
			$guest_id = $_COOKIE['guest'];

			$sql = "SELECT * FROM temp_cart WHERE user_id='$guest_id'";
			$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			if(mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_array($result)) {
					$product_id = $row['product_id'];
					$sql = "INSERT INTO cart(product_id, user_id) VALUES ('$product_id', '$curr_user_id')";
					$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
					$sql = "DELETE FROM temp_cart WHERE user_id = '$guest_id' AND product_id = '$product_id'";
					$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
				}
			}

			$sql = "SELECT * FROM temp_wishlist WHERE user_id = '$guest_id'";
			$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			if(mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_array($result)) {
					$product_id = $row['product_id'];
					$sql = "INSERT INTO wishlist(product_id, user_id) VALUES ('$product_id', '$curr_user_id')";
					$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
					$sql = "DELETE FROM temp_wishlist WHERE user_id = '$guest_id' AND product_id = '$product_id'";
					$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
				}
			}

			setcookie('guest', 0, 1, "/");
		}
	}
	else if(!isset($_SESSION['user_id'])) {
		$sql = "SELECT MAX(guest_id) AS guest_id FROM guests";
		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		$row = mysqli_fetch_array($result);

		$curr_user_id = $row['guest_id'];
		$curr_user_id += 1;
		$sql = "INSERT INTO guests(guest_id) VALUES ('$curr_user_id')";
		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

		$curr_user_type = "guest";
		$curr_username = "Guest";
		$_SESSION['role'] = "guest";
		$_SESSION['user_id'] = $curr_user_id;
		$_SESSION['name'] = "Guest";
		setcookie('guest', $curr_user_id, time() + 86400*7, "/");
		$login_status = false;
	}
?>
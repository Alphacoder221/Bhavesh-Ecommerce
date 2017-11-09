<?php
	require "config.php";

	function addToCart($table_name, $product_id, $curr_user_id, $conn) {
		$sql = "INSERT INTO ".$table_name."(product_id, user_id) VALUES('$product_id', '$curr_user_id')";
		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	}

	function removeFromCart($table_name, $product_id, $curr_user_id, $conn) {
		$sql = "DELETE FROM ".$table_name. " WHERE product_id = $product_id AND user_id = $curr_user_id";
		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	}

	function moveToWishlist($table_name, $product_id, $curr_user_id, $conn) {
		$insert_into = "wishlist";
		if($table_name == "temp_cart") {
			$insert_into = "temp_wishlist";
		}
		$sql = "INSERT INTO ".$insert_into. "(product_id, user_id) VALUES ('$product_id', '$curr_user_id')";
		$result = mysqli_error($conn, $sql) or die(mysqli_error($conn));

		removeFromCart($table_name, $product_id, $curr_user_id, $conn);
	}

	if($_SERVER['REQUEST_METHOD'] == "POST") {
		$product_id = $_POST['product_id'];
		$request_type = $_POST['add_remove'];
		$curr_user_id = $_SESSION['user_id'];
		$table_name = "cart";
		if($_SESSION['role'] == "guest") {
			$table_name = "temp_cart";
		}
		if($request_type == "add") {
			addToCart($table_name, $product_id, $curr_user_id, $conn);
		}
		else if($request_type == $_POST['remove']) {
			removeFromCart($table_name, $product_id, $curr_user_id, $conn);
		}
		else {
			moveToWishlist($table_name, $product_id, $curr_user_id, $conn);
		}
	}
?>
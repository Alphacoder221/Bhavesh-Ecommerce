<?php
	require "config.php";

	function addToWishlist($table_name, $product_id, $user_id, $conn) {
		$sql = "INSERT INTO ".$table_name."(product_id, user_id) VALUES('$product_id', '$user_id')";
		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	}

	function removeFromWishlist($table_name, $product_id, $user_id, $conn) {
		$sql = "DELETE FORM ".$table_name. " WHERE product_id='$product_id' AND user_id ='$user_id'";
	}

	function moveToCart($table_name, $product_id, $curr_user_id, $conn) {
		$insert_into = "cart";
		if($table_name == "temp_wishlist") {
			$insert_into = "temp_cart";
		}
		$sql = "INSERT INTO ".$insert_into. "(product_id, user_id) VALUES ('$product_id', '$curr_user_id')";
		$result = mysqli_error($conn, $sql) or die(mysqli_error($conn));

		removeFromWishlist($table_name, $product_id, $curr_user_id, $conn);
	}

	if($_SERVER['REQUEST_METHOD'] == "POST") {
		$product_id = $_POST['product_id'];
		$request_type = $_POST['add_remove'];
		$curr_user_id = $_SESSION['user_id'];
		$table_name = "wishlist";
		if($_SESSION['role'] == "guest") {
			$table_name = "temp_wishlist";
		}
		if($request_type == "add") {
			addToWishlist($table_name, $product_id, $curr_user_id, $conn);
		}
		else if($request_type == "remove"){
			removeFromWishlist($table_name, $product_id, $curr_user_id, $conn);
		}
		else {
			moveToCart($table_name, $product_id, $curr_user_id, $conn);
		}
	}
?>
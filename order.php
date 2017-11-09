<?php
	require "config.php";

	$user_id = $curr_user_id;

	if($login_status == false) {
		$_SESSION['products'] = $_POST;
		echo "Please Login To Place An Order";
		header('Location: members.php');
	}
	else if((isset($_SESSION['products'])) || isset($_POST)) {

		$sql_user = "SELECT user_address, city, pincode, state, country, user_phone_no FROM users WHERE user_id ='$curr_user_id';";
		$result_user = mysqli_query($conn, $sql_user) or die(mysqli_error($conn));
		$row_user = mysqli_fetch_array($result_user);
		$user_address = $row_user['user_address']. ", ". $row_user['city']. ", ". $row_user['state']. ", ". $row_user['country'];
		$user_pincode = $row_user['pincode'];
		$user_phone_no = $row_user['user_phone_no'];

		$total_amt = 0;

		$sql_order = "SELECT MAX(order_id) AS order_id from orders";
		$result_order = mysqli_query($conn, $sql_order) or die(mysqli_error($conn));
		$row_order = mysqli_fetch_assoc($result_order);

		$order_id = $row_order['order_id'];
		$order_id += 1;

		if(isset($_POST)) {
			$products = $_POST;
		}
		else {
			$products = $_SESSION['products'];
		}

		foreach($products as $product_id => $product_quantity) {

			$sql_product = "SELECT product_price, product_discount_percent FROM products WHERE product_id='$product_id';";
			$result_product = mysqli_query($conn, $sql_product) or die(mysqli_error($conn));
			$row_product = mysqli_fetch_array($result_product);

			$product_price = $row_product['product_price'];
			$product_discount_percent = $row_product['product_discount_percent'];
			$product_final_price = $product_price - $product_price*$product_discount_percent/100;

			$amt = $product_final_price * $product_quantity;
			$sql_order_content = "INSERT INTO order_content (order_id, product_id, quantity, amount) VALUES ('$order_id', '$product_id', '$product_quantity', '$amt')";
			$result = mysqli_query($conn, $sql_order_content) or die(mysqli_error($conn));
			$total_amt += $amt;

			$sql_remove_cart = "DELETE FROM cart WHERE product_id='$product_id' AND user_id='$curr_user_id';";
			$result_remove_cart = mysqli_query($conn, $sql_remove_cart) or die(mysqli_error($conn));
		}
		$sql = "INSERT INTO orders (user_id, total_amt, order_timestamp) VALUES ('$user_id', '$total_amt', NOW());";
		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		$_SESSION['order_id'] = $order_id;
		header('Location: viewmystuffs.php#orders');
	}
	else {
		header('Location: viewmystuffs.php');
	}
?>
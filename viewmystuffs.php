<?php
	require "config.php";
	$cart_grand_total = 0;
?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>MyStuffs @ FeedAByte: See what's there in your cart, wishlist and your previous orders</title>
		<meta name="keyword" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" />
		<link rel="stylesheet" href="FontAwesome/css/font-awesome.min.css" />
		<link rel="stylesheet" href="css/custom/mystuffs.css" />
		<link rel="stylesheet" href="css/custom/header.css" />
		<link rel="stylesheet" href="css/custom/footer.css" />
		<link href='https://fonts.googleapis.com/css?family=Biryani|Secular+One' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="js/frameworks/jquery.min.js"></script>
	</head>
	<body>
		<?php
			require "header.php";
			$curr_user_id = $_SESSION['user_id'];
			$curr_user_type = $_SESSION['role'];
		?>

		<div class="main-content">
			<div class="container">

				<div class="card" id="cart">
					<div class="card-title">
						My Cart
					</div>
					<div class="card-content">
						<?php
							$table_name = 'cart';
							if($curr_user_type == 'guest') {
								$table_name = 'temp_cart';
							}
							$sql = "SELECT product_id FROM $table_name WHERE user_id ='$curr_user_id';";
							$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
							$product_count = 0;

							if(mysqli_num_rows($result) > 0) {
								echo "<table class='table-stripped cart-table'>";
								echo "<tr><td>Sr.No.</td><td>Product Name</td><td>Description</td><td>Quantity</td><td>Subtotal</td><td>Remove</td></tr>";

								while($row = mysqli_fetch_array($result)) {
									$product_count+=1;
									$product_id = $row['product_id'];
									$sql_product = "SELECT * from products WHERE product_id ='$product_id'";
									$result_product = mysqli_query($conn, $sql_product) or die(mysqli_error($conn));

									if(mysqli_num_rows($result_product) > 0) {
										while($row_product = mysqli_fetch_array($result_product)) {
											$product_name = $row_product['product_name'];
											$product_description = $row_product['product_description'];
											$product_price = $row_product['product_price'];
											$product_discount_percent = $row_product['product_discount_percent'];
											$product_final_price = $product_price - $product_price*$product_discount_percent/100;
											$cart_grand_total += $product_final_price;
											echo "<tr>
													<td>#$product_count <input type='hidden' name='product_id' value='$product_id' /></td>
													<td><a href='product.php?id=$product_id'>$product_name</a></td>
													<td>$product_description</td>
													<td><input type='number' name='product_quantity' class='form-control quantity_input' min='1' max='10' value='1'/></td>
													<td>$product_final_price Rs</td>
													<td><a href=''><i class='fa fa-lg fa-recycle'></i></a></td>
												</tr>";
										}
									}
								}
								echo "</table>";
								echo "<div class='payable-amount'>";
									echo "Your Cart Finally Contains ". $product_count. " Items ( ".$cart_grand_total. " Rs)";
									echo "<form name='main-form' method='POST' action='order.php'>";
									echo "<div id='formElements'></div>";
									echo "<button type='submit' class='btn btn-danger'>Proceed</button>";
									echo "</form>";
								echo "</div>";
							}
							else {
								echo "<div class='no-result'>Got nothing in your cart</div>";
							}
						?>
					</div>
				</div>

				<div class="card">
					<div class="card-title">
						My Wishlist
					</div>
					<div class="card-content">
						<?php
							$table_name = 'wishlist';
							if($curr_user_type == 'guest') {
								$table_name = 'temp_wishlist';
							}
							$sql = "SELECT product_id FROM $table_name WHERE user_id ='$curr_user_id';";
							$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
							$product_count = 0;

							if(mysqli_num_rows($result) > 0) {
								echo "<table class='table-stripped wishlist-table'>";
								echo "<tr><td>Sr.No.</td><td>Product Name</td><td>Description</td><td>Subtotal</td><td>Move / Remove</td></tr>";

								while($row = mysqli_fetch_array($result)) {
									$product_count+=1;
									$product_id = $row['product_id'];
									$sql_product = "SELECT * from products WHERE product_id ='$product_id'";
									$result_product = mysqli_query($conn, $sql_product) or die(mysqli_error($conn));

									if(mysqli_num_rows($result_product) > 0) {
										while($row_product = mysqli_fetch_array($result_product)) {
											$product_name = $row_product['product_name'];
											$product_description = $row_product['product_description'];
											$product_price = $row_product['product_price'];
											$product_discount_percent = $row_product['product_discount_percent'];
											$product_final_price = $product_price - $product_price*$product_discount_percent/100;
											echo "<tr><td>#$product_count</td><td><a href='product.php?id=$product_id'>$product_name</a></td><td>$product_description</td>
												<td>$product_final_price Rs</td><td><a href=''><i class='fa fa-cart-arrow-down fa-lg'></i></a><a href=''><i class='fa fa-lg fa-delicious'></i></a></td></tr>";
										}
									}
								}
								echo "</table>";
							}
							else {
								echo "<div class='no-result'>Your wishlist is empty..</div>";
							}
						?>
					</div>
				</div>

				<div class="card" id="orders">
					<div class="card-title">
						My Orders
					</div>
					<div class="card-content">
						<?php
							$sql_orders = "SELECT * FROM orders WHERE user_id='$curr_user_id' ORDER BY order_timestamp DESC;";
							$result_orders = mysqli_query($conn, $sql_orders) or die(mysqli_error($conn));

							if(mysqli_num_rows($result_orders) > 0) {
								while($row_orders = mysqli_fetch_array($result_orders)) {
									$order_id = $row_orders['order_id'];
									$order_timestamp = $row_orders['order_timestamp'];
									$order_status = $row_orders['order_status'];
									$order_amt = $row_orders['total_amt'];

									$sql_order_content = "SELECT * from order_content WHERE order_id='$order_id';";
									$result_order_content = mysqli_query($conn, $sql_order_content) or die(mysqli_error($conn));
									$product_count = 0;
                                    $orderId = "order_id_".$order_id;
                                    
									if(mysqli_num_rows($result_order_content) > 0) {
										echo "<div class='row orders' id='$orderId'>";

										echo "<div class='col-lg-3 col-d-3 col-sm-3 col-xs-12 order-details'>";
											echo "<div class='order-id'>Order Id: $order_id</div>";
											echo "<div class='order-timestamp'>Order Time: $order_timestamp</div>";
											echo "<div class='order-status'>Order Status: $order_status</div>";
											echo "<div class='order-amt'>Total Cost: $order_amt Rs</div>";
											echo "<div class='cancel-order'><a hrefId='$order_id'><i class='fa fa-desktop'></i> Cancel Order</a></div>";
										echo "</div>";

										echo "<div class='col-lg-9 col-md-9 col-sm-9 col-xs-12'>";

										echo "<table class='table-stripped order-table'>";
										echo "<tr><td>Sr.No.</td><td>Product Name</td><td>Description</td><td>Quantity</td><td>Subtotal</td></tr>";

										while($row_order_content = mysqli_fetch_array($result_order_content)) {
											$product_count += 1;
											$product_id = $row_order_content['product_id'];
											$quantity = $row_order_content['quantity'];
											$amount = $row_order_content['amount'];

											$sql_product = "SELECT product_name, product_description FROM products WHERE product_id='$product_id';";
											$result_product = mysqli_query($conn, $sql_product) or die(mysqli_error($conn));
											$row_product_details = mysqli_fetch_array($result_product);
											$product_name = $row_product_details['product_name'];
											$product_description = $row_product_details['product_description'];

											echo "<tr><td>$product_count</td><td><a href='product.php?id=$product_id'>$product_name</a></td><td>$product_description</td><td>$quantity</td><td>$amount Rs</td></tr>";
										}
										echo "</table>";
										echo "</div></div>";
									}
								}
							}
							else {
								echo "<div class='no-result'>You have made no orders yet..</div>";
							}
						?>
					</div>
				</div>
			</div>
		</div>

		<?php require "footer.php" ?>

		<script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>
		<script type="text/javascript">
			function refreshData() {
				document.getElementById('formElements').innerHTML = "";
				var ids = document.getElementsByName('product_id');
				var quantity = document.getElementsByName('product_quantity');
				for(i=0; i<ids.length; i++) {
					var key = ids[i].value;
					var value = quantity[i].value;
					document.getElementById('formElements').innerHTML += "<input type='hidden' name=" + key + " value=" + value + "/>";
				}
			}
		</script>

		<script type="text/javascript">
			refreshData();
			$(document).ready(function(){
				$('.quantity_input').change(function(){
					document.getElementById('formElements').innerHTML = "";
					var ids = document.getElementsByName('product_id');
					var quantity = document.getElementsByName('product_quantity');
					for(i=0; i<ids.length; i++) {
						var key = ids[i].value;
						var value = quantity[i].value;
						document.getElementById('formElements').innerHTML += "<input type='hidden' name=" + key + " value=" + value + "/>";
					}
				});
			});
		</script>
        <script type="text/javascript">
            $('.cancel-order').click(function(){
                var val = $(this).find('a').attr('hrefId');
                $.post("order.php",{'order_id':val}, function() {
                    var orderId = "#order_id_" + val;
                    $(orderId).remove();
                    window.location.reload();
                });
            });
        </script>
	</body>
</html>
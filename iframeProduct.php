<?php
	require "config.php";

	if(!isset($_GET['id'])) {
		header('Location: home.php');
	}
	else {
		$product_id = $_GET['id'];
	}

	$sql = "SELECT * FROM `products` WHERE product_id = $product_id;";
	$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	if($result) {
		$row = mysqli_fetch_assoc($result);
		$product_name = $row['product_name'];
		$product_category_id = $row['product_category_id'];
		$product_brand = $row['product_brand'];
		$retailer_id = $row['retailer_id'];
		$product_rating = $row['product_rating'];
		$product_price = $row['product_price'];
		$product_discount_percent = $row['product_discount_percent'];
		$product_description = $row['product_description'];
		$product_pic_1_url = $row['product_pic_1_url'];
		$product_pic_2_url = $row['product_pic_2_url'];
		$product_pic_3_url = $row['product_pic_3_url'];
		$product_warranty_info = $row['warranty_info'];
		$deal_type_id = $row['deal_type_id'];
		$product_new_price = $product_price - $product_price*$product_discount_percent/100;
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$comment_data = $_POST['comment_data'];
		$rating_data = $_POST['rating_data'];
		$comment_title = $_POST['comment_title'];

		$sql = "INSERT INTO `comment`(product_id, user_id, user_name, comment_title, comment_data, rating, comment_date) VALUES ('$product_id', '$curr_user_id', '$curr_username', '$comment_title', '$comment_data', '$rating_data', NOW())";
		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	}
?>

<!doctype html>
<html
	lang = "en"
	xmlns = "http://www.w3.org/1999/html">
	<head>
		<meta charset="utf-8" />
		<title></title>
		<meta name="keyword" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" />
		<link rel="stylesheet" href="FontAwesome/css/font-awesome.min.css" />
		<link rel="stylesheet" href="css/custom/product.css" />
		<link rel="stylesheet" href="css/custom/header.css" />
		<link rel="stylesheet" href="css/custom/footer.css" />
		<link href='https://fonts.googleapis.com/css?family=Signika' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="js/frameworks/jquery.min.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="main-content" style="margin-top: 5px;">
				<div class="card">
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div id="carousel-main" class="carousel slide" data-ride="carousel">
								<ul class="carousel-indicators">
									<li data-target="#carousel-main" data-slide-to="0" class="active"></li>
									<?php
										if($product_pic_2_url != "") {
											echo "<li data-target=\"#carousel-main\" data-slide-to=\"1\"></li>";
										}
										if($product_pic_3_url != "") {
											echo "<li data-target=\"#carousel-main\" data-slide-to=\"2\"></li>";
										}
									?>
								</ul>

								<div class="carousel-inner" role="listbox">
									<div class="item active">
										<img src=<?php echo $product_pic_1_url ?> alt='...'>
									</div>
									<?php
										if($product_pic_2_url != "") {
											echo "<div class='item'>
													<img src='$product_pic_2_url' alt='...'>
												</div>";
										}
										if($product_pic_3_url != "") {
											echo "<div class='item'>
													<img src='$product_pic_3_url' alt='...'>
												</div>";
										}
									?>
								</div>
							</div>
						</div>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<div class="product">
								<div class="product-title">
									<?php echo $product_name; ?>
								</div>
								<div class="product-info">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<div class="specs-title">Product Description</div>
											<?php echo $product_description; ?>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<div class="specs-title">Warranty Information</div>
											<div class="text-content">
												<?php
													if($product_warranty_info == '') {
														echo "No Warranty information available";
													}
													else {
														echo $product_warranty_info;
													}
												?>
											</div>
										</div>
									</div>
									<div class="prices">
										<div class="price-info">
											MRP:
											<span class="old-price">
												<?php echo $product_price; ?>
											</span> Rs
										</div>
										<div class="price-info">
											Our Price:
											<span class="new-price">
												<?php echo $product_new_price; ?> Rs</span>
											<span class="discount-percentage">
												<?php echo $product_discount_percent; ?> %
											</span>
										</div>
									</div>
									<div class="add-btn">
										<div class="btn btn-danger add-to-wishlist">
											<input type='hidden' name='product-id' value=<?php echo $product_id; ?> />
											<i class="fa fa-heart-o"></i> &nbsp; Add to Wishlist
										</div>
										<div class="btn btn-primary add-to-wishlist">
											<input type='hidden' name='product-id' value=<?php echo $product_id; ?> />
											<i class="fa fa-cart-plus"></i> &nbsp; Add to Cart
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<h3>Product Summary</h3><hr />
					<div class="product-summary">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="table-title">General Details</div>
        						<table class="table-responsive">
        							<tr>
        								<td>Pattern</td>
        								<td>Priinted</td>
        							</tr>
        							<tr>
        								<td>Occassion</td>
        								<td>Casual</td>
        							</tr>
        							<tr>
        								<td>Made for</td>
        								<td>Mens</td>
        							</tr>
        						</table>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        						<div class="table-title">
        							Shirt Detials
        						</div>
        						<table class="table-responsive">
        							<tr>
        								<td>Pattern</td>
        								<td>Priinted</td>
        							</tr>
        							<tr>
        								<td>Occassion</td>
        								<td>Casual</td>
        							</tr>
        							<tr>
        								<td>Made for</td>
        								<td>Mens</td>
        							</tr>
        						</table>
                            </div>
                        </div>
					</div>
				</div>
				<div class="card">
					<?php
					if($curr_user_type == 'customer') {
						echo "<h3>Post your own comment</h3><hr />
						<form class='form' name='comment_form' method='POST' action=\"product.php?id=$product_id\">
							<input type='text' class='form-control' name='comment_title' placeholder='Comment Title' style='max-width: 500px;' /><br />
							<textarea name='comment_data' placeholder='Place your comments here' class='form-control' style='height: 75px;'></textarea>
							<div style='text-align: right; margin: 10px 20px; margin-right: 0;'>
								<input type='number' class='form-control' name='rating_data' style='width: 150px; display: inline-block;' placeholder='Your rating' max='5' min='0'/>
								<button type='submit' name='submit' class='btn btn-info'>Submit</button>
							</div>
						</form>";
					}
					?>
					<h3>User Reviews</h3><hr />
					<?php
						$sql = "SELECT * FROM comment WHERE product_id = '$product_id';";
						$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
						if(mysqli_num_rows($result) > 0) {
							while ($row = mysqli_fetch_array($result)) {
								$user_name = $row['user_name'];
								$comment_title = $row['comment_title'];
								$comment_date = $row['comment_date'];
								$comment_data = $row['comment_data'];
								$rating_data = $row['rating'];
								echo "
									<div class=\"post\">
										<div class=\"row\">
											<div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-12\">
												<div class=\"user-post\">
													<div class=\"user-name\">$user_name</div>
													<div class=\"rating rating-value-$rating_data\">
														<span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
													</div>
													<div class=\"post-date\">$comment_date</div>
												</div>
											</div>
											<div class=\"col-lg-10 col-md-12 col-sm-10 col-xs-12\">
												<div class=\"post-info\">
													<div class=\"post-title\">$comment_title</div>
													<div class=\"post-data\">$comment_data</div>
												</div>
											</div>
										</div>
									</div>
								";
							}
						}
						else {
							echo "<div class='no-comments'>Be the first person to post a comment on this product</div>";
						}
					?>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".add-to-cart:not(.dont-click").click(function(){
					var val = $(this).find('input[type="hidden"]').val();
					$.post("cartEdit.php", {'product_id':val, 'add_remove':"add"}, function (data) {
					    var cart_product_count = parseInt(document.getElementById('cart_item_count').innerText);			   
        				document.getElementById('cart_item_count').innerText = cart_product_count + 1;
					});
                    $(this).css('cursor','not-allowed');
                    $(this).css('opacity','0.8');
                    $(this).addClass('dont-click');
				});
				$('.add-to-wishlist').click(function(){
					var val = $(this).find('input[type="hidden"]').val();
					$.post("wishlistEdit.php", {'product_id':val, 'add_remove':"add"}, function (data) {});
					$(this).css('cursor','not-allowed').css('opacity','0.8');
				});
			});
		</script>
	</body>
</html>
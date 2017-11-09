<?php
	$conn=mysqli_connect("mysql.hostinger.in","u592864386_yjymu","Test@123","u592864386_usuna", 3306);

	if(!$conn) {
		die("Connection failed");
	}

	$output = '';
	$searchText = $_POST['searchText'];
	$sortBy = $_POST['sortBy'];
	$choices = $_POST['choiceTicks'];

	$sql = "SELECT * FROM products WHERE ((product_name LIKE '%$searchText%') OR (product_search_keywords LIKE '%$searchText%') OR (product_brand LIKE '%$searchText%')) ". $choices. $sortBy. ";";
	$result = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result)) {
			$productId = $row['product_id'];
			$productName = $row['product_name'];
			$productCategory = $row['product_category_id'];
			$productDiscount = $row['product_discount_percent'];
			$productImage = $row['product_pic_1_url'];

			$sql = "SELECT product_category_name FROM product_category WHERE product_category_id = '$productCategory';";
			$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			if(mysqli_num_rows($res) > 0) {

				$row_name = mysqli_fetch_assoc($res);
				$productCategoryName = $row_name['product_category_name'];
				$output .= "
				<div class='col-lg-3 col-md-3 col-sm-4 col-xs-4'>
					<div class='result'>
						<div class='quicklook'>
							<a href='product.php?id=$productId' target='_blank' type='button' class='btn'>Quick Look</a></div>
						<div class='item'>
							<div class='item-pic'>
								<img src=$productImage class='img-responsive' />
							</div>
							<div class='item-info'>
								<div class='add-btn'>
									<div class='btn add-to-wishlist'>
										<input type='hidden' name='product-id' value=$productId />
										<i class='fa fa-heart-o fa-lg'></i></div>
									<div class='btn add-to-cart'>
										<input type='hidden' name='product-id' value=$productId />
										<i class='fa fa-cart-plus fa-lg'></i></div>
								</div>
								<div class='item-name'>$productName</div>
								<div class='item-offer'>FLAT $productDiscount % OFF</div>
								<div class='item-spec'>$productCategoryName</div>
							</div>
						</div>
					</div>
				</div>";
			}
		}
		echo $output;
	}
	else {
		echo "<h3 style='padding: 15px 15px 15px 125px;background-color: #f4f4f4'>Sorry No Such Product Found</h3>";
	}
?>
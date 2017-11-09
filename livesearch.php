<?php
	$conn= mysqli_connect("localhost","root","","eshop", 3306);

	if(!$conn) {
		die("Connection failed");
	}
	$output = '';
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		if(isset($_POST['searchText'])) {
			$searchText = $_POST['searchText'];
			if($searchText!= "") {
				$output .= "<ul class=\"search-result-list\">";
				$output .= "<li><h4>Product Categories</h4></li>";

				$sql_category = "SELECT * FROM product_category WHERE product_category_keywords LIKE '%$searchText%';";
				$result = mysqli_query($conn, $sql_category) or die(mysqli_error($conn));

				if(mysqli_num_rows($result) > 0) {
					while($row = mysqli_fetch_array($result)) {
						$output .= "<li class='product-item'>
						<a href='". $row['product_category_id']. "'>". $row['product_category_name']. "</a></li>";
					}
				}
				else {
					echo "<div class='error-not-found'>
					<h4>Product Categories</h4>
					No such item in product category</div>";
				}

				$output .= "<li><h4>Products</h4></li>";

				$sql_products = "SELECT product_id, product_name, product_category_id, product_search_keywords FROM products WHERE product_search_keywords LIKE '%$searchText%';";

				$result = mysqli_query($conn, $sql_products) or die(mysqli_error($conn));

				if(mysqli_num_rows($result) > 0) {
					while($row = mysqli_fetch_array($result)) {
						$output .= "<li class='product-item'>
						<a href='product.php?id=". $row['product_id']. "'>". $row['product_name']. "</a></li>";
					}
				}
				else {
					$output = "<div class='error-not-found'>
					<h4>Products</h4>
					No such product found</div>";
				}
				$output .= '</ul>';
			}
			else {
				$output = "";
			}
			echo $output;
		}
	}
?>
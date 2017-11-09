<?php
	require "livesearch.php";
?>

<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container top-content">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.php">
				<div class="brand-name"> EShop</div>
				<div class="brand-title">Shop anywhere</div>
			</a>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<form class="navbar-form" method="GET" action="search-results.php" autocomplete="off">
						<input type="hidden" name="search_form">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search for products, brands etc." id="search-box" name="searchText" onkeyup="getStates(this.value)" />
							<span class="input-group-btn">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-search"></i> &nbsp;Search
								</button>
							</span>
						</div>
					</form>
				</li>
				<li>
					<div class="cart-container">
						<i class="fa fa-shopping-cart fa-lg"></i>
						<span id="cart_item_count">
							<?php
								$table_name = 'cart';
                                if($_SESSION['role'] == 'guest') {
									$table_name = 'temp_cart';
								}
                                $curr_user_id = $_SESSION['user_id'];
                                $sql = "SELECT COUNT(*) AS count_ids FROM $table_name WHERE user_id='$curr_user_id';";
								$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
								$row = mysqli_fetch_array($result);
								echo $row['count_ids'];
							?>
						</span> Items
					</div>
				</li>
			</ul>
		</div>
	</div>
	<div class="bottom-content">
		<div class="container">
			<ul class="nav navbar-nav">
				<li class="dropdown"><a href="">Mens &nbsp;<i class="fa fa-chevron-circle-down"></i></a></li>
				<li class="dropdown"><a href="">Women &nbsp;<i class="fa fa-chevron-circle-down"></i></a></li>
				<li class="dropdown"><a href="">Kids &nbsp;<i class="fa fa-chevron-circle-down"></i></a></li>
				<li class="dropdown"><a href="">Home Decor &nbsp;<i class="fa fa-chevron-circle-down"></i></a></li>
				<li class="dropdown"><a href="">Trending &nbsp;<i class="fa fa-chevron-circle-down"></i></a></li><li class="dropdown"><a href="">Updates &nbsp;<i class="fa fa-chevron-circle-down"></i></a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-secret fa-lg"></i> &nbsp;
						<?php
							if($login_status == false) {
								echo "My Account";
							}
							else {
								echo $curr_username;
							}
						?>
						<span class="caret"></span> </a>
					<ul class="dropdown-menu">
						<li>
							<div class="login-signup">
								<?php
									if($login_status == false) {
										echo "<h4>Get Started</h4>
											<a href='members.php#tologin' class='btn btn-custom'>Log In</a>
											<a href='members.php#toregister' class='btn btn-custom'>Sign Up</a>";
									}
									else {
										if($curr_user_type == 'customer') {
											echo "<a href='viewmystuffs.php' class='btn btn-custom'>My Account</a>";
										}
										else if($curr_user_type = 'retailer') {
											echo "<a href='retailerpage.php' class='btn btn-custom'>My Account</a>";
										}
										else if($curr_user_type = 'admin'){
											echo "<a href='admin.php' class='btn btn-custom'>My Account</a>";
										}
										else {
											echo "<a href='members.php' class='btn btn-custom'>My Account</a>";
										}
									}
								?>
							</div><hr />
						</li>
						<li><a href="#"><i class="fa fa-paint-brush"></i> &nbsp; Recommended for you.</a></li>
						<li><a href="#"><i class="fa fa-question-circle"></i> &nbsp; Make a request</a></li>
						<?php
							if($login_status == true) {
								echo "<li><a href='logout.php'>
										<i class='fa fa-sign-out'></i> &nbsp; Log out</a></li>";
							}
						?>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>

<div class="search-results" id="search-result"></div>

<script type="text/javascript">
	$(document).ready(function() {
		$(window).scroll(function(){
			var scroll_pos = $(window).scrollTop();
			if(scroll_pos < 150) {
				$('.navbar-default .bottom-content').css('display','block');
			}
			else if(scroll_pos >= 150) {
				$('.navbar-default .bottom-content').css('display','none');
			}
		});
	});
</script>

<script type="text/javascript">
	function getStates(value) {
		$.post("livesearch.php", {searchText:value}, function(data){
			$('#search-result').html(data);
		});
	}
</script>
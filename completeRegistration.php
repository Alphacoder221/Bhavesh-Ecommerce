<?php
	require "config.php";
	$curr_user_id = $_SESSION['user_id'];
	$curr_user_type = $_SESSION['role'];
	$curr_user_name = $_SESSION['name'];

	if($curr_user_type == "guest") {
		header("Location: members.php");
	}
	else {
		$curr_user_email = $_SESSION['email'];
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			if(isset($_POST['contact']) && isset($_POST['city']) && isset($_POST['address']) && isset($_POST['state']) && isset($_POST['pincode'])) {
				$contact = $_POST['contact'];
				$address = $_POST['address'];
				$city = $_POST['city'];
				$state = $_POST['state'];
				$pincode = $_POST['pincode'];

				$sql_update = "UPDATE users SET user_address='$address', state='$state', city='$city', pincode='$pincode', user_phone_no='$contact' WHERE user_id='$curr_user_id';";
				$result_update = mysqli_query($conn, $sql_update) or die(mysqli_error($conn));

				if(isset($_SESSION['returnTo'])) {
					header('Location: '.$returnTo);
				}
			}
		}
	}

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
		<link rel="stylesheet" href="css/custom/completeRegistration.css" />
		<link rel="stylesheet" href="css/custom/header.css" />
		<link rel="stylesheet" href="css/custom/footer.css" />
		<link href='https://fonts.googleapis.com/css?family=Biryani|Secular+One' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="js/frameworks/jquery.min.js"></script>
	</head>
	<body>
		<?php
			require "header.php";
		?>
		<div class="main-content">
			<div class="container">
				<div class="main-title">Complete Your Registration</div>
				<div class="card">
					<div class="card-title">
						Please complete your registration process by filling out our details regargding your home address, your contact no etc.
					</div>
					<div class="card-content">
						<form class="form" method="POST" action="completeRegistration.php">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa-lg"></i></span>
								<input type="text" class="form-control" value="<?php echo $curr_user_name; ?>" disabled required />
							</div>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope-o fa-lg"></i></span>
								<input type="email" class="form-control" value="<?php echo $curr_user_email; ?>" disabled required />
							</div>
							<div class="input-group">
								<span class="input-group-addon">+91</span>
								<input type="number" class="form-control" name="contact" placeholder="Contact Number" required />
							</div>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-home fa-lg"></i></span>
								<input type="text" class="form-control" name='address' placeholder="Your Address" required />
							</div>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-lg fa-building-o"></i></span>
								<input type="text" class="form-control" name="city" placeholder="City" required />
							</div>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-lg fa-flag"></i></span>
								<input type="number" class="form-control" name="pincode"  placeholder="Pincode" required />
							</div>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-lg fa-industry"></i></span>
								<input type="text" class="form-control" name="state" placeholder="State" required />
							</div>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-lg fa-flag"></i></span>
								<input type="text" class="form-control disabled" name="country" value="India" placeholder="Country" disabled required />
							</div>
							<div class="submit-btn">
								<button type="submit" class="btn btn-info" name="submit">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

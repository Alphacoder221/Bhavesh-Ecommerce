<?php
	session_start();
	$connection_status = false;
	$last_page = "";
	$login_status = false;
	$loginErr = $signupErr = NULL;
	$count = 0;
	$signupSuccess = "";

	if(isset($_SESSION['lastpage'])) {
		$last_page = $_SESSION['lastpage'];
	}
	else {
		$last_page = "index.php";
	}

	if( isset($_SESSION['email']) && isset($_SESSION['name']) && isset($_SESSION['user_id'])) {
		header("Location: ".$last_page);
	}
	else {
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			$emailErr = $passErr = $confPassErr = $nameErr = "";

			$emailData = htmlspecialchars($_POST['email']);
			$passwordData = htmlspecialchars($_POST['password']);

			if (empty($emailData) || !filter_var($emailData, FILTER_VALIDATE_EMAIL)) {
				$emailErr = "Invalid email format";
			}
			else if (!preg_match('/^((?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,})$/', $passwordData)) {
				$passErr = "Invalid Password";
			}
			else {
				$hashFormat = "$2y$10$";
				$salt = "bhtyuidfgthuoisdfwer22";
				$hashF_and_salt = $hashFormat . $salt;
				$hashed_password = crypt($passwordData, $hashF_and_salt);

				$formType = $_POST['formname'];

				$conn= mysqli_connect("localhost","root","","eshop", 3306);
				if(!$conn) {
					die("Connection failed");
				}
				else {
					$connection_status = true;
				}

				if($formType == 'login') {
					$sql = "SELECT * FROM `users` WHERE user_email_id='$emailData' AND user_password='$hashed_password';";
					$result = mysqli_query($conn, $sql) or die (mysqli_error($conn));

					if($result) {
						$row = mysqli_fetch_assoc($result);
						$_SESSION['user_id'] = $row['user_id'];
						$_SESSION['name'] = $row['user_name'];
						$_SESSION['email'] = $row['user_email_id'];
						$_SESSION['role'] = $row['user_type'];
						$_SESSION['user_type_id'] = $row['user_type_id'];
						header('Location: '.$last_page);
					}
					else {
						$loginErr = "No such Account";
					}
				}
				else {
					$nameData = htmlspecialchars($_POST['name']);
					$confPassData = htmlspecialchars($_POST['confirm-password']);
					$roleData = $_POST['user-role'];

					if(!preg_match("/([a-zA-Z]{4,})/", $nameData)){
						$nameErr = "Error in name feild";
					}
					else if($passwordData != $confPassData) {
						$confPassErr = "Passwords do not match";
					}
					else {
						$sql = "INSERT INTO `users` (user_name, user_email_id, user_password, user_type) VALUES ('$nameData', '$emailData', '$hashed_password', '$roleData');";
						$result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
						if(!$result) {
							$signupErr = "Error in creating account";
						}
						else {
							$_SESSION['name'] = $nameData;

							$sql = $sql = "SELECT MAX(user_id) AS user_id FROM users";
							$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

							if(!$result) {
								$signupErr = "Error in creating account";
							}
							else {
								$row = mysqli_fetch_assoc($result);
								$user_id = $row['user_id'];
								$sql = "INSERT INTO $roleData(user_id) VALUES($user_id)";
								$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

								if(!$result) {
									$signupErr = "Error in creating account";
								}
								else {
									$new_column = $roleData."_id";
									$sql = "SELECT MAX($new_column) AS new_column from $roleData";
									$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

									if(!$result) {
										$signupErr = "Error in creating account";
									}
									else {
										$row = mysqli_fetch_assoc($result);
										$user_type_id = $row["new_column"];
										$sql = "UPDATE users SET user_type_id = $user_type_id where user_id = $user_id";
										$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
										if(!$result) {
											$signupErr = "Error in creating account";
										}
										else {
											$signupSuccess = "Account Created Successfully. Please LogIn To Continue.";
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<title>Clothezz: Login Or SignUp Here</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
		<meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
		<meta name="author" content="Codrops" />
		<link rel="stylesheet" type="text/css" href="css/custom/loginsignup/demo.css"/>
		<link rel="stylesheet" type="text/css" href="css/custom/loginsignup/style.css" />
		<link rel="stylesheet" type="text/css" href="css/custom/loginsignup/animate-custom.css" />
		<style type="text/css">
			select {
				padding: 5px 20px 5px 5px;
				border-radius: 5px;
				text-align: left;
				margin-left: 10px;
				background-color: #fcfcfc;
				width: 150px;
			}
		</style>
	</head>
	<body>
		<div class="container" style="padding-top: 30px;">
			<section>
				<div id="container_demo" >
					<a class="hiddenanchor" id="toregister"></a>
					<a class="hiddenanchor" id="tologin"></a>
					<div id="wrapper">

						<div id="login" class="animate form">
							<form name="loginform" action="members.php#tologin" method="POST" autocomplete="on" spellcheck="false">
								<h1>Log in</h1>
								<?php
									if(($_SERVER['REQUEST_METHOD'] == "POST")) {
										if((($emailErr != "") || ($passErr != "")) && ($_POST['formname'] == "login")) {
											echo "<div class='panel panel-danger' style='text-align: center'><div class='panel-body'><h4>No such account</h4><p>Please enter the details again</p></div></div>";
										$count = 1;
										}
									}
								?>
								<input type="hidden" name="formname" value="login" />
								<p>
									<label for="emailsignup" class="youmail" data-icon="e" > Your email</label>
									<input id="emailsignup" name="email" required="required" type="email" placeholder="mysupermail@mail.com"/>
								</p>
								<p>
									<label for="password" class="youpasswd" data-icon="p"> Your password </label>
									<input id="password" name="password" required="required" type="password" placeholder="eg. X8dfA90EO" />
								</p>

								<p class="keeplogin">
									<input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" />
									<label for="loginkeeping">Keep me logged in</label>
								</p>

								<p class="login button">
									<input type="submit" name="submit" value="Login" />
								</p>
								<p class="change_link">
									Not a member yet ?
									<a href="#toregister" class="to_register">Join us</a>
								</p>
							</form>
						</div>

						<div id="register" class="animate form">
							<form  name="signupform" action="members.php#toregister" method="POST" autocomplete="on" spellcheck="false">
								<h1> Sign up </h1>
								<?php
									if($_SERVER['REQUEST_METHOD'] == "POST") {
										if((($emailErr != "") || ($passErr != "") || ($confPassErr != "") || ($nameErr != "")) && ($_POST['formname'] == "signup")) {
											echo "<div class='panel panel-danger' style='text-align: center'><div class='panel-body'><h4>Account could not be created!</h4> <p>Details are not entered as per the required format</p></div></div>";
											$count = 1;
										}
										if($signupSuccess != "") {
											echo "<div class='panel panel-success' style='text-align: center; margin: 10px 0;'>$signupSuccess</div>";
										}
									}
								?>
								<input type="hidden" name="formname" value="signup" />
								<p>
									<label for="usernamesignup" class="uname" data-icon="u">Your username</label>
									<input id="usernamesignup" name="name" required="required" type="text" placeholder="mysuperUsername" />
								</p>
								<p>
									<label for="emailsignup" class="youmail" data-icon="e" > Your email</label>
									<input id="emailsignup" name="email" required="required" type="email" placeholder="mysupermail@mail.com"/>
								</p>
								<p>
									<label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>
									<input id="passwordsignup" name="password" required="required" type="password" placeholder="eg. X8df!90EO"/>
								</p>
								<p>
									<label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>
									<input id="passwordsignup_confirm" name="confirm-password" required="required" type="password" placeholder="eg. X8df!90EO"/>
								</p>
								<p>
									<label for="user-role">Select A Role: </label>
									<select name="user-role">
										<option value="customer" selected> Customer</option>
										<option value="retailer"> Retailer</option>
										<option value="admin"> Admin</option>
									</select>
								</p>

								<p class="signin button">
									<input type="submit" name="submit" value="Sign up"/>
								</p>
								<p class="change_link">
									Already a member ?
									<a href="#tologin" class="to_register"> Go and log in </a>
								</p>
							</form>
						</div>

					</div>
				</div>
			</section>
		</div>
	</body>
</html>

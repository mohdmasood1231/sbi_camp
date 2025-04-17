<?php

include 'include/header.php' ?>



<?php
$_SESSION['UserId'] = null;
$_SESSION['UserName'] = null;
$_SESSION['UserType'] = null;
if (isset($_POST['submit'])) {
	$password_hash = $_POST['Password'];
	$Query = "SELECT * FROM users where emp_id='" . $_POST['User_id'] . "' and password='" . $password_hash . "' ";
	$myDB = new MysqliDb();
	$result = $myDB->query($Query);
	// print_r($result);
	// die;
	if ($result) {
		$currentDate = date('Y-m-d');
		$loginDate = date('Y-m-d', strtotime($result[0]['login_time']));
		if ($currentDate != $loginDate) {
			$loginupdate = "UPDATE users SET login_time='" . date("Y-m-d H:i:s") . "' where id='" . $result[0]['id'] . "'";
			$login = $myDB->query($loginupdate);
		}


		// $loginutrack = "INSERT INTO user_tracking(userid, login_time) VALUES ('" . $result[0]['emp_id'] . "', '" . date('Y-m-d H:i:s') . "')";
		// $loginTrackInsert = $myDB->query($loginutrack);

		$_SESSION['UserName'] = $result[0]['user_name'];
		$_SESSION['UserId'] = $result[0]['emp_id'];
		$_SESSION['UserType'] = $result[0]['user_type'];

		if ($_SESSION['UserType'] == 'Admin') {


			$location = 'index.php';
			echo "<script>location.href='" . $location . "'</script>";
		} else {


			header("location: login.php");
			//header("location: agent.php");
			exit();
		}
	} else {
		$msg = '<div class="alert alert-error">
			              <button class="close" data-dismiss="alert">x</button>
			              <strong>Error!</strong> Login Id/Password not correct</div>';
	}
}
if (isset($_REQUEST['SessionExpire']) &&  $_REQUEST['SessionExpire'] = 'true') {
	$msg = '<div class="alert alert-error">
			              <button class="close" data-dismiss="alert">x</button>
			              <strong>The current session has expired. Please login again!</strong></div>';
}
?>

<body class="login">
	<div>

		<div class="login_wrapper">
			<div class="animate form login_form">
				<div class="animate form login_form" style="border: 1px solid #0057a9;padding: 21px;">
					<section class="login_content">
						<?php if (isset($msg)) { ?>
							<div class="alert"> <?php echo $msg; ?> </div><?php } ?>
						<h2>
							<!-- <div class="login-logo"> <img src="images/logo1.png" alt="Logo" /></div> -->
						</h2>
						<br>


						<form method="POST" action="login.php">

							<div>
								<input type="text" class="form-control" placeholder="User Id" name="User_id" id="User_id" required="" />
							</div>
							<div>
								<input type="password" class="form-control" placeholder="Password" name="Password" id="Password" required="" />
							</div>
							<div>
								<button class="btn btn-success btn-lg submit" name="submit" id="submit" type="submit">Login</button>
							</div>
						</form>
						<div class="clearfix"></div>

					</section>
				</div>
			</div>
		</div>
	</div>
</body>
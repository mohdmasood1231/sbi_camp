<?php
include 'include/header.php' ?>

<?php

// echo "<pre>";
// print_r($_SESSION);
// die;
// echo $_SESSION['UserName'] . '---';
// die;
if (!isset($_SESSION['UserName'])) {
	// echo 'ddff';
	// die;
	$location = 'login.php';
	echo "<script>location.href='" . $location . "'</script>";
}
#echo date('Y-m-01');
#echo date('Y-m-01');
#echo date("Y-m-d");
$myDB = new MysqliDb();

$sql = "select count(id) as count from subscriber l inner join (select mobile, max(id) as latest from subscriber group by mobile) r on l.id = r.latest and l.mobile = r.mobile; ";

$result1 = $myDB->query($sql);
//echo $result[0]['count'];

$sql = "select count(id) as count from subscriber l inner join (select mobile, max(id) as latest from subscriber group by mobile) r on l.id = r.latest and l.mobile = r.mobile where (cast(l.optin_time as date) between cast('" . date('Y-m-01') . "' as date) and cast('" . date("Y-m-d") . "' as date)); ";

$result2 = $myDB->query($sql);
#echo $result2[0]['count'];

$sql = "select count(id) as count from subscriber l inner join (select mobile, max(id) as latest from subscriber group by mobile) r on l.id = r.latest and l.mobile = r.mobile where l.optin_flag=1; ";

$result3 = $myDB->query($sql);

$sql = "select count(id) as count from subscriber l inner join (select mobile, max(id) as latest from subscriber group by mobile) r on l.id = r.latest and l.mobile = r.mobile where l.optin_flag=1 and (cast(l.optin_time as date) between cast('" . date('Y-m-01') . "' as date) and cast('" . date("Y-m-d") . "' as date));";

$result4 = $myDB->query($sql);

$sql = "select count(id) as count from subscriber l inner join (select mobile, max(id) as latest from subscriber group by mobile) r on l.id = r.latest and l.mobile = r.mobile where l.optin_flag=0; ";

$result5 = $myDB->query($sql);

$sql = "select count(id) as count from subscriber l inner join (select mobile, max(id) as latest from subscriber group by mobile) r on l.id = r.latest and l.mobile = r.mobile where l.optin_flag=0 and (cast(l.optin_time as date) between cast('" . date('Y-m-01') . "' as date) and cast('" . date("Y-m-d") . "' as date));";

$result6 = $myDB->query($sql);

?>



<body class="nav-md">
	<div class="container body">
		<div class="main_container">

			<?php include 'include/leftmenu.php' ?>

			<!-- page content -->
			<div class="right_col" role="main" style="background-color: #45dfed;">
				<div class="">

					<div class="clearfix"></div>

					<div class="row" style="background-color: #45dfed;">
						<div class="col-md-12 col-sm-12 col-xs-12" style="background-color: #45dfed;">
							<div class="x_panel">
								<div>
									<h2><b>Thanks A Dot</b></h2>
									<div class="clearfix"></div>
								</div>




							</div>
						</div>


					</div>

					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-6">


							<div class="col s6 m6" style="width: 220px;height: 80px;padding: 18px; border: 5px solid gray;	margin: 0;
									background-color: bisque; font-size: 14px;text-align: left;border-bottom: 1px solid #1790a5;
box-shadow: 0px 4px 4px -3px #9E9E9E;border-left: 4px solid #1790a5;border-right: 4px solid #1790a5;border-top: 1px solid #1790a5;
background: linear-gradient(#ffd88dd6,#23dfff);margin-left:75px;font-family: verdana;font-weight:bold;padding-top:25px;margin-left: 200px;">
								Total Subscribers - <?php echo $result1[0]['count']; ?>

							</div>

						</div>

						<div class="col-md-6 col-sm-6 col-xs-6">


							<div class="col s6 m6" style="width: 220px;height: 80px;padding: 35px; border: 5px solid gray;	margin: 0;
									background-color: bisque; font-size: 14px;text-align: left;border-bottom: 1px solid #1790a5;
box-shadow: 0px 4px 4px -3px #9E9E9E;border-left: 4px solid #1790a5;border-right: 4px solid #1790a5;border-top: 1px solid #1790a5;
background: linear-gradient(#ffd88dd6,#23dfff);margin-left:75px;font-family: verdana;font-weight:bold;padding-top:14px;">
								Total Subscribers This Month - <?php echo $result2[0]['count']; ?>

							</div>

						</div>



					</div>

					<div class="row">

						<div class="col-md-6 col-sm-6 col-xs-6">


							<div class="col s6 m6" style="width: 220px;height: 80px;padding: 35px; border: 5px solid gray;	margin: 45px;
									background-color: bisque; font-size: 14px;text-align: left;border-bottom: 1px solid #1790a5;
box-shadow: 0px 4px 4px -3px #9E9E9E;border-left: 4px solid #1790a5;border-right: 4px solid #1790a5;border-top: 1px solid #1790a5;
background: linear-gradient(#ffd88dd6,#23dfff);margin-left:200px;font-family: verdana;font-weight:bold;padding-top:14px;">
								Total Active Subscribers - <?php echo $result3[0]['count']; ?>

							</div>

						</div>
						<div class="col-md-6 col-sm-6 col-xs-6">


							<div class="col s6 m6" style="width: 220px;height: 80px;padding: 30px; border: 5px solid gray;	margin: 45px;
									background-color: bisque; font-size: 14px;text-align: left;border-bottom: 1px solid #1790a5;
box-shadow: 0px 4px 4px -3px #9E9E9E;border-left: 4px solid #1790a5;border-right: 4px solid #1790a5;border-top: 1px solid #1790a5;
background: linear-gradient(#ffd88dd6,#23dfff);margin-left:75px;font-family: verdana;font-weight:bold;padding-top:14px;">
								Active Subscribers This Month - <?php echo $result4[0]['count']; ?>

							</div>

						</div>
					</div>

					<div class="row">

						<div class="col-md-6 col-sm-6 col-xs-6">


							<div class="col s6 m6" style="width: 220px;height: 80px;padding: 30px; border: 5px solid gray;	margin: 3px;
									background-color: bisque; font-size: 14px;text-align: left;border-bottom: 1px solid #1790a5;
box-shadow: 0px 4px 4px -3px #9E9E9E;border-left: 4px solid #1790a5;border-right: 4px solid #1790a5;border-top: 1px solid #1790a5;
background: linear-gradient(#ffd88dd6,#23dfff);margin-left:200px;font-family: verdana;font-weight:bold;padding-top:25px;">
								Total Opted Out - <?php echo $result5[0]['count']; ?>

							</div>

						</div>
						<div class="col-md-6 col-sm-6 col-xs-6">


							<div class="col s6 m6" style="width: 220px;height: 80px;padding: 48px; border: 5px solid gray;	margin: 3px;
									background-color: bisque; font-size: 14px;text-align: left;border-bottom: 1px solid #1790a5;
box-shadow: 0px 4px 4px -3px #9E9E9E;border-left: 4px solid #1790a5;border-right: 4px solid #1790a5;border-top: 1px solid #1790a5;
background: linear-gradient(#ffd88dd6,#23dfff);margin-left:75px;font-family: verdana;font-weight:bold;padding-top:14px;">
								Opted Out This Month - <?php echo $result6[0]['count']; ?>

							</div>

						</div>
					</div>


				</div>

			</div>
			<!-- /page content -->
			<?php include 'include/footer.php' ?>
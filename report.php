<?php include 'include/header.php' ?>

<?php
//echo $_SESSION['UserId'] . '---';
if (!isset($_SESSION['UserId'])) {
	session_destroy();
	$location = 'login.php';
	echo "<script>location.href='" . $location . "'</script>";
} else {
	$isPostBack = false;

	$referer = "";
	$alert_msg = "";
	if (isset($_SERVER['HTTPS'])) {
		define("REQUEST_SCHEME", "https");
	} else {
		define("REQUEST_SCHEME", "http");
	}
	$thisPage = REQUEST_SCHEME . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

	if (isset($_SERVER['HTTP_REFERER'])) {
		$referer = $_SERVER['HTTP_REFERER'];
	}

	if ($referer == $thisPage) {
		$isPostBack = true;
	}
	if ($isPostBack && isset($_POST)) {
		echo '1111';
		$date_To = $_POST['toDate'];
		$date_From = $_POST['fromDate'];
	} else {
		$date_To = date('Y-m-d', time());
		$date_From = date('Y-m-d', time());
	}
}
// echo "TESTING";
// die;
?>
<?php
if (isset($_POST['Getdata'])) {
	$Date1 = strtotime($_POST['fromDate']);
	$Date2 = strtotime($_POST['toDate']);
	$_date1 = date('Y-m-d H:i:s', $Date1);
	$_date2 = date('Y-m-d H:i:s', $Date2);
	//echo $_POST['fromDate'] . '----' . $_POST['toDate'] . '----' . $_POST['call_status'];
	$Query = "select l.mobile,case when optin_flag = 1 then 'Active' when  optin_flag = 0 then 'InActive' end as optin_flag,optin_time,stop_time from subscriber l inner join (select mobile, max(id) as latest from subscriber group by mobile) r on l.id = r.latest and l.mobile = r.mobile where  (cast(l.optin_time as date) between cast('" . $_POST['fromDate'] . "' as date)   and cast('" . $_POST['toDate'] . "' as date))";
	if ($_POST['call_status'] == "2") {
		$Query = $Query . " order by optin_time;";
	} else if ($_POST['call_status'] == "1") {
		$Query = $Query . " and l.optin_flag=1 order by optin_time;";
	} else if ($_POST['call_status'] == "0") {
		$Query = $Query . " and l.optin_flag=0 order by optin_time;";
	}
	echo $Query;
	$myDB = new MysqliDb();
	$resultsReport = $myDB->query($Query);
}
?>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">

			<?php include 'include/leftmenu.php' ?>
			<!-- page content -->
			<div class="right_col" role="main" style="background-color: #45dfed;">
				<div class="clearfix"></div>
				<div class="row" style="background-color: #45dfed;">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div style="background-color: #45dfed;">
							<div class="x_title">
								<h4><span style="font-family: Verdana; font-size: 16px;font-weight: bold;color: black;">Report</span></h4>
								<div class="clearfix"></div>
							</div>
							<form action="report.php" method="POST" id="myform">
								<div class="row">

									<div class="form-group col-md-3">
										<div class="form-group">

											<select class="form-control" name="call_status" id="call_status" required>
												<option value=""> Select status</option>
												<option value="2" <?php if (isset($_POST['call_status']) && $_POST['call_status'] == '2') {
																		echo "selected";
																	} ?>> Total Subscriber</option>
												<option value="1" <?php if (isset($_POST['call_status']) && $_POST['call_status'] == '1') {
																		echo "selected";
																	} ?>> Total active subscriber</option>
												<option value="0" <?php if (isset($_POST['call_status']) && $_POST['call_status'] == '0') {
																		echo "selected";
																	} ?>> Total Inactive subscriber</option>
											</select>
										</div>
									</div>

									<div class="form-group col-md-3">
										<div class="form-group">
											<div class='input-group date' id='myDatepicker1'>
												<input type='text' class="form-control" name="fromDate" id="fromDate" required placeholder="Select From Date" value="<?php echo $date_From; ?>" />
												<span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
									</div>

									<div class="form-group col-md-3">
										<div class="form-group">
											<div class='input-group date' id='myDatepicker2'>
												<input type='text' class="form-control" name="toDate" id="toDate" required placeholder="Select To Date" value="<?php echo $date_To; ?>" />
												<span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
									</div>
									<div class="form-group col-md-2">

										<div class="form-group">
											<input type="submit" class="btn btn-primary" value="Get Report" name="Getdata">
										</div>
									</div>

								</div>
							</form>

							<br />
							<hr>

							<div class="x_content">
								<?php if (isset($resultsReport)) {	?>
									<table id="example" class="table table-striped table-bordered table" style="width:100%">
										<thead>
											<tr>
												<th hidden>Optin Time </th>
												<th>Mobile</th>
												<th>Status</th>
												<th>Optin Time </th>
												<th>Stop Time </th>


											</tr>
										</thead>
										<tbody>

											<?php


											foreach ($resultsReport as $r) { ?>
												<tr class="gradeX">
													<td hidden><?php echo $r['optin_time'] ?></td>
													<td><?php echo $r['mobile'] ?></td>
													<td><?php echo $r['optin_flag'] ?></td>
													<td><?php echo $r['optin_time'] ?></td>
													<td><?php echo $r['stop_time'] ?></td>

												</tr>
											<?php } ?>

										</tbody>

									</table>
								<?php  } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

<?php include 'include/footer.php'; ?>
<script>
	$('#myDatepicker1,#myDatepicker2').datetimepicker({
		format: 'YYYY-MM-DD'
	});

	$('#example').dataTable({
		dom: 'Bfrtip',
		buttons: [
			'excelHtml5',
		],
		scrollX: 300,
		responsive: true,
		pageLength: 10

	});
</script>
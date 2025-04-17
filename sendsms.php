<?php
include 'include/init.php';

?>


<?php
if ((isset($_REQUEST['mobile']) && trim($_REQUEST['mobile']) != "" && isset($_REQUEST['msg']) && trim($_REQUEST['msg']) != "" && isset($_REQUEST['time']) && trim($_REQUEST['time']) != "")) {

	$mobile = trim($_REQUEST['mobile']);
	$msg = strtoupper(trim($_REQUEST['msg']));
	$time = trim($_REQUEST['time']);
	$Query = "select id,mobile,optin_flag from subscriber where mobile='" . $mobile . "' order by id desc limit 1";
	$myDB = new MysqliDb();
	$result = $myDB->query($Query);

	if ($result) {
		//echo $result[0]['optin_flag'];

		if ($msg == "HUG" && $result[0]['optin_flag'] == "0") {
			$strInsert = "insert into subscriber set mobile='" . $mobile . "' ,optin_time= '" . $time . "' ,optin_flag=1";
			$strquery = $myDB->query($strInsert);
			echo 'Registered---';
			$url = "https://103.229.250.200/smpp/sendsms?username=suvega&password=suvega007&from=CPLBIJ&to=" . $mobile . "&text=Welcome%20to%20Hug%20of%20Life!%20Get%20monthly%20breast%20self-exam%20reminders.%20How-to%20videos%20%26%20info%20at%20https%3A%2F%2Fwww.sbilife.co.in%2Fthanksadot%20Reply%20%27HUG%20STOP%27%20to%20unsubscribe.%20CPL";
			$curl = curl_init();

			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
			$result = curl_exec($curl);
			if (curl_errno($curl)) {
				$error_msg = curl_error($curl);
			}
			curl_close($curl);
			if (isset($error_msg)) {
				echo 'Error -- ' . $error_msg . '-----';
			}
			echo $result;
		} else if ($msg == "HUG" && $result[0]['optin_flag'] == "1") {
			echo 'Already start';
			// $url = "https://103.229.250.200/smpp/sendsms?username=suvega&password=suvega007&from=CPLBIJ&to=" . $mobile . "&text=Hi!%20It%27s%20time%20for%20your%20monthly%20breast%20self-exam.%20For%20how-to%20videos%20%26%20more%20info%2C%20visit%20https%3A%2F%2Fwww.sbilife.co.in%2Fthanksadot%20Reply%20%27HUG%20STOP%27%20to%20unsubscribe.%20CPLBIJ";
			// $curl = curl_init();

			// curl_setopt($curl, CURLOPT_URL, $url);
			// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			// curl_setopt($curl, CURLOPT_HEADER, false);
			// curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
			// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
			// $result = curl_exec($curl);
			// if (curl_errno($curl)) {
			// 	$error_msg = curl_error($curl);
			// }
			// curl_close($curl);
			// if (isset($error_msg)) {
			// 	echo 'Error -- ' . $error_msg . '-----';
			// }
			// echo $result;
		} else if ($msg == "HUG STOP" && $result[0]['optin_flag'] == "1") {
			$strUpdate = "update subscriber set optin_flag=0, stop_time='" . $time . "' where id=" . $result[0]['id'] . "";
			$strquery = $myDB->query($strUpdate);
			echo 'HUG Stop';
		} else {
			echo 'Invalid request...';
		}
	} else {
		if ($msg == "HUG") {
			$strInsert = "insert into subscriber set mobile='" . $mobile . "' ,optin_time= '" . $time . "' ,optin_flag=1";
			$strquery = $myDB->query($strInsert);
			echo 'Registered---';
			$url = "https://103.229.250.200/smpp/sendsms?username=suvega&password=suvega007&from=CPLBIJ&to=" . $mobile . "&text=Welcome%20to%20Hug%20of%20Life!%20Get%20monthly%20breast%20self-exam%20reminders.%20How-to%20videos%20%26%20info%20at%20https%3A%2F%2Fwww.sbilife.co.in%2Fthanksadot%20Reply%20%27HUG%20STOP%27%20to%20unsubscribe.%20CPL";
			$curl = curl_init();

			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
			$result = curl_exec($curl);
			if (curl_errno($curl)) {
				$error_msg = curl_error($curl);
			}
			curl_close($curl);
			if (isset($error_msg)) {
				echo 'Error -- ' . $error_msg . '-----';
			}
			echo $result;
		} else {
			echo 'Invalid request...';
		}

		//echo $strInsert;
	}


	// $loginupdate = "UPDATE users SET login='" . date("Y-m-d H:i:s") . "' where id='" . $result[0]['id'] . "'";
	// $login = $myDB->query($loginupdate);
} else {
	echo 'Invalid request...';
}

?>
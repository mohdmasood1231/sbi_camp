<?php
include 'include/init.php';

// $Query = "select l.* from subscriber l inner join (select mobile, max(id) as latest from subscriber group by mobile) r on l.id = r.latest and l.mobile = r.mobile where l.optin_flag=1 and 12days_time is null and datediff(CURDATE(),cast(optin_time as date))=5;";

$Query = "select l.* from subscriber l inner join (select mobile, max(id) as latest from subscriber group by mobile) r on l.id = r.latest and l.mobile = r.mobile where l.optin_flag=1 and 12days_time is null and TIMESTAMPDIFF(hour,optin_time,now())>=1;";
$myDB = new MysqliDb();
$result = $myDB->query($Query);

if ($result) {
	foreach ($result as $key => $value) {

		$updatequery = "update subscriber set 12days_time=now() where id=" . $value['id'];
		$myDB->query($updatequery);
		//if ($value['mobile'] == "919990015749") {
		$url = "https://103.229.250.200/smpp/sendsms?username=suvega&password=suvega007&from=CPLBIJ&to=" . $value['mobile'] . "&text=Hi!%20It%27s%20time%20for%20your%20monthly%20breast%20self-exam.%20For%20how-to%20videos%20%26%20more%20info%2C%20visit%20https%3A%2F%2Fwww.sbilife.co.in%2Fthanksadot%20Reply%20%27HUG%20STOP%27%20to%20unsubscribe.%20CPLBIJ";
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
		//}
	}
}


// $Query = "select l.* from subscriber l inner join (select mobile, max(id) as latest from subscriber group by mobile) r on l.id = r.latest and l.mobile = r.mobile where l.optin_flag=1 and 12days_time is not null and 28days_time is null and datediff(CURDATE(),cast(12days_time as date))=3;";

$Query = "select l.* from subscriber l inner join (select mobile, max(id) as latest from subscriber group by mobile) r on l.id = r.latest and l.mobile = r.mobile where l.optin_flag=1 and 12days_time is not null and 28days_time is null and TIMESTAMPDIFF(hour,12days_time,now())>=3;";
$myDB = new MysqliDb();
$result = $myDB->query($Query);

if ($result) {
	foreach ($result as $key => $value) {

		$updatequery = "update subscriber set 28days_time=now() where id=" . $value['id'];
		$myDB->query($updatequery);
		//if ($value['mobile'] == "919990015749") {
		$url = "https://103.229.250.200/smpp/sendsms?username=suvega&password=suvega007&from=CPLBIJ&to=" . $value['mobile'] . "&text=Hi!%20It%27s%20time%20for%20your%20monthly%20breast%20self-exam.%20For%20how-to%20videos%20%26%20more%20info%2C%20visit%20https%3A%2F%2Fwww.sbilife.co.in%2Fthanksadot%20Reply%20%27HUG%20STOP%27%20to%20unsubscribe.%20CPLBIJ";
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
		//}
	}
}

//$Query = "select l.* from subscriber l inner join (select mobile, max(id) as latest from subscriber group by mobile) r on l.id = r.latest and l.mobile = r.mobile where l.optin_flag=1 and 12days_time is not null and 28days_time is not null and datediff(CURDATE(),cast(28days_time as date))=3;";

$Query = "select l.* from subscriber l inner join (select mobile, max(id) as latest from subscriber group by mobile) r on l.id = r.latest and l.mobile = r.mobile where l.optin_flag=1 and 12days_time is not null and 28days_time is not null and TIMESTAMPDIFF(hour,28days_time,now())>=3;";
$myDB = new MysqliDb();
$result = $myDB->query($Query);

if ($result) {
	foreach ($result as $key => $value) {

		$updatequery = "update subscriber set 28days_time=now() where id=" . $value['id'];
		$myDB->query($updatequery);
		//if ($value['mobile'] == "919990015749") {
		$url = "https://103.229.250.200/smpp/sendsms?username=suvega&password=suvega007&from=CPLBIJ&to=" . $value['mobile'] . "&text=Hi!%20It%27s%20time%20for%20your%20monthly%20breast%20self-exam.%20For%20how-to%20videos%20%26%20more%20info%2C%20visit%20https%3A%2F%2Fwww.sbilife.co.in%2Fthanksadot%20Reply%20%27HUG%20STOP%27%20to%20unsubscribe.%20CPLBIJ";
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
		//}
	}
}

<?php 
$myDB= new MysqliDb();
date_default_timezone_set('Asia/Kolkata');
//echo date('H:i:s',$_SESSION['activesession']);
$halfSession= strtotime('+2 hours', $_SESSION['activesession']);
if($halfSession < time() )
{
	//$logoutUpdate="update user_tracking logout_time set logout_time ='".date('Y-m-d H:i:s',$_SESSION['activesession'])."' where id =(select max(id) from user_tracking where  userid ='".$_SESSION['IntUserId']."');";
	$logoutUpdate="UPDATE user_tracking AS X
INNER JOIN (select max(id) id from user_tracking where userid ='".$_SESSION['IntUserId']."') AS Y  
on  X.id = Y.id
 SET X.logout_time ='".date('Y-m-d H:i:s',$_SESSION['activesession'])."'";
	$logout =$myDB->query($logoutUpdate);
	session_destroy();
	header("location:login.php?SessionExpire=true"); 
}
else{
	unset($_SESSION['activesession']);
	 $_SESSION['activesession'] = time();
}

//print_r($_SESSION);
?>
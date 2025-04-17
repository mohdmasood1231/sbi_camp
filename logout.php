 <?php
   // echo phpinfo();
   #include 'include/header.php';
   session_start();
   // Unset all session variables
   //session_unset();

   // Destroy the session
   //session_destroy();
   session_destroy();
   $_SESSION['UserId'] = null;
   //echo $_SESSION['UserId'] . '---';

   $_SESSION['UserName'] = null;
   $_SESSION['UserType'] = null;

   $_SESSION = [];
   unset($_SESSION);
   session_unset();
   // if (!isset($_SESSION['UserId'])) {
   //    session_destroy();
   //    echo $_SESSION['UserId'] . '---';
   // }
   $location = 'login.php';
   echo "<script>location.href='" . $location . "'</script>";

   ?> 
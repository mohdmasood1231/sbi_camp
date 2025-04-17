
<?php
$user = "envogoik_amir";
$password = "H7&gs%ggs4$@";
$data_base = "envogoik_asami";
$conn = mysqli_connect("localhost", $user, $password, $data_base) or die('connection failed');
if(!$conn){
    echo mysqli_errno($conn);
}

?>
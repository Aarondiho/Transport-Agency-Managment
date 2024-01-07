
<script>
    start_load();
    </script>
<?php
include '../connection/db_connect.php';
include('../includes/session.php');
$enligne = 0;

$online = $conn->EXEC("UPDATE users SET online ='$enligne' WHERE idUser='$session_id'");

if($online){
    
unset($_SESSION['util_idUser']);

    header("location: ../index.php");
}


?>
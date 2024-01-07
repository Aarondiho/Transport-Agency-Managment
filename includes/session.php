<?php
session_start();
 //Check whether the session variable SESS_MEMBER_ID is present or not

    if (!isset($_SESSION['util_idUser']) || ($_SESSION['util_idUser'] == '')) {
        header("location: ../index.php");
        exit();
    }

	$session_id = $_SESSION['util_idUser'];
	$username = $_SESSION['util_userName'];
	$util_type = $_SESSION['util_type'];
	$mot_password = $_SESSION['util_password'];
    $firstname = $_SESSION['util_firstName'];
    $lastname = $_SESSION['util_lastName'];
    

?>
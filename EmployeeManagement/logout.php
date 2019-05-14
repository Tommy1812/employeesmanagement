<?php
    ob_start();
    session_start();
    if(!isset($_SESSION["username"])){
        header("Location: http://localhost:8082/EmployeeManagement/login.php");
    }
    
    //remove PHPSESSID from browser
    if ( isset( $_COOKIE[session_name()] ) )
    setcookie( session_name(), “”, time()-3600, “/” );
    //clear session from globals
    $_SESSION = array();
    //clear session from disk
    session_destroy();
    header("Location: http://localhost:8082/EmployeeManagement/login.php");
?>
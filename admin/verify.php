<?php
require_once("../config.php");
session_start();
if (!isset ($_SESSION['sess_user'])){
header("Location: ".LOCALHOST."/login.php") ;
}
?>
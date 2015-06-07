<?php
session_start();
if(isset($_SESSION['sess_user']))
	unset($_SESSION['sess_user']);
include_once("./verify.php")
?>
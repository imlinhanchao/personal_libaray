<?php
if(isset($_common['localPath']))
    $localPath = $_common['localPath'];
else
    $localPath = "..";
require_once($localPath.'/config.php');
session_start();
if (!isset ($_SESSION['sess_user'])){
header("Location: ".LOCALHOST."/login.php") ;
}
?>
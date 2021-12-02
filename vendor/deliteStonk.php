<?php 

session_start();
require_once 'connect.php';



$userId = $_SESSION['USER']['ID'];
$num = $_POST['num'];
$user = $_POST['user'];
$type = $_POST['type'];

if ($type == 1){
    mysqli_query($connect_users, "DELETE FROM `dohod` WHERE `user__id` = '$userId' AND `user` = '$user' AND `number` ='$num'");
}

if ($type == 2){
    mysqli_query($connect_users, "DELETE FROM `rashod` WHERE `user__id` = '$userId' AND `user` = '$user' AND `number` ='$num'");
}


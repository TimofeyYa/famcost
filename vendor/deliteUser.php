<?php 

    session_start();
    require_once 'connect.php';
    
    $data = $_POST['data'];

    $userId = $_SESSION['USER']['ID'];
    echo $data;
    mysqli_query($connect_users, "DELETE FROM `user__accaunt` WHERE `user__id` = '$userId' AND `number` = '$data'");
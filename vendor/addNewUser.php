<?php
    session_start();
    require_once 'connect.php';

    $userId = $_SESSION['USER']['ID'];

    $name = $_POST['name'];

    $lastId = mysqli_query($connect_users, "SELECT MAX(`id`) FROM `user__accaunt` WHERE `user__id` = '$userId'");
    $lastId = mysqli_fetch_assoc($lastId);

    echo $lastId['MAX(`id`)'];
    $lastId = $lastId['MAX(`id`)'];

    $lastNum = mysqli_query($connect_users, "SELECT * FROM `user__accaunt` WHERE `id` = ' $lastId'");
    $lastNum = mysqli_fetch_assoc($lastNum);


    $maxNum = intval($lastNum['number']) + 1;
    mysqli_query($connect_users, "INSERT INTO `user__accaunt` (`id`, `user__id`, `name`, `budget`,`number`) VALUES (NULL, '$userId', '$name', '0', '$maxNum')");



    
?>

<?php
    session_start();
    require_once 'connect.php';

    $userId = $_SESSION['USER']['ID'];
    $budget = $_POST['budget'];
    $user = $_POST['user'];

    mysqli_query($connect_users, "UPDATE `user__accaunt` SET `budget` = '$budget' WHERE `user__id` = '$userId'  AND `name` = '$user'");


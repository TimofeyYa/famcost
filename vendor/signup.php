<?php
    session_start();
    require_once 'connect.php';

    $login = $_POST['login'];
    $pass = $_POST['pass'];
    $email = $_POST['email'];

    $user = mysqli_query($connect_users, "SELECT * FROM `accaunt` WHERE `email` = '$email' ");

    if (mysqli_num_rows($user) > 0){
        $_SESSION['MESSAGE'] = 'Пользователь с таким E-mail уже зарегистрирован';
        
    } else {
        mysqli_query($connect_users, "INSERT INTO `accaunt` (`id`, `login`, `email`, `password`) VALUES (NULL, '$login', '$email', '$pass')");

        $user = mysqli_query($connect_users, "SELECT * FROM `accaunt` WHERE `login` = '$login' AND `password` = '$pass'");

    if (mysqli_num_rows($user) > 0){
        $user = mysqli_fetch_assoc($user);
        $id = $user['id'];
        mysqli_query($connect_users, "INSERT INTO `user__accaunt` (`id`, `user__id`, `name`, `budget`, `number`) VALUES (NULL, '$id', 'admin', '0', '1')");
    }
        $_SESSION['MESSAGE'] = 'Вы успешно зарегистрированы!';
    }
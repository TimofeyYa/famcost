<?php
    session_start();
    require_once 'connect.php';

    $login = $_POST['login'];
    $pass = $_POST['pass'];
   
    $user = mysqli_query($connect_users, "SELECT * FROM `accaunt` WHERE `login` = '$login' AND `password` = '$pass'");

    if (mysqli_num_rows($user) > 0){
        $user = mysqli_fetch_assoc($user);
        $_SESSION['USER']['ID'] = $user['id'];
        $_SESSION['USER']['LOGIN'] = $user['login'];
        $_SESSION['USER']['ACCAUNT'] = $user['login'];
        
        header('../profil.php');
    } else {
        $_SESSION['MESSAGE'] = 'Не верный логин или пароль!';
    }

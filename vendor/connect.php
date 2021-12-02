<?php 
    $DBname = 'root';
    $DBpassword = '';
    $DBhost ='localhost';

    $connect_users = mysqli_connect($DBhost, $DBname,$DBpassword,'famcost');
    mysqli_query($connect_users,"SET NAMES 'utf8'"); // База данных пользователей

    if(!$connect_users){
        die('error connect to users DataBase');
    }
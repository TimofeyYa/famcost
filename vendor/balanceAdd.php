<?php 

    session_start();
    require_once 'connect.php';

    

    $userId = $_SESSION['USER']['ID'];
    $user =$_POST['user'];
    $sum =$_POST['sum'];
    $comment =$_POST['comment'];
    $selector =$_POST['selector'];



    // Доходы
    if ($selector == 1){
        
        $lastId = mysqli_query($connect_users, "SELECT MAX(`id`) FROM `dohod` WHERE `user__id` = '$userId' AND `user` = '$user'");
        $lastId = mysqli_fetch_assoc($lastId);
    
        
        $lastId = $lastId['MAX(`id`)'];
    
        $lastNum = mysqli_query($connect_users, "SELECT * FROM `dohod` WHERE `id` = ' $lastId'");
        $lastNum = mysqli_fetch_assoc($lastNum);
        
        echo $lastNum['number'];
        if (empty($lastNum['number'])){
            $lastNum['number'] = 0;
        }
        $maxNum = intval($lastNum['number']) + 1;
        mysqli_query($connect_users,"INSERT INTO `dohod` (`id`, `user__id`, `user`, `sum`, `comment`, `number`) VALUES (NULL, '$userId', '$user', '$sum', '$comment','$maxNum')");
    }
   
    // Расходы 
    if ($selector == 2){

        $lastId = mysqli_query($connect_users, "SELECT MAX(`id`) FROM `rashod` WHERE `user__id` = '$userId' AND `user` = '$user'");
        $lastId = mysqli_fetch_assoc($lastId);
        
        $lastId = $lastId['MAX(`id`)'];
    
        $lastNum = mysqli_query($connect_users, "SELECT * FROM `rashod` WHERE `id` = ' $lastId'");
        $lastNum = mysqli_fetch_assoc($lastNum);
    
        echo $lastNum['number'];
        if (empty($lastNum['number'])){
            $lastNum['number'] = 0;
        }
        $maxNum = intval($lastNum['number']) + 1;

        mysqli_query($connect_users,"INSERT INTO `rashod` (`id`, `user__id`, `user`, `sum`, `comment`, `number`) VALUES (NULL, '$userId', '$user', '$sum', '$comment','$maxNum')");
    }
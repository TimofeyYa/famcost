<?php 
    session_start();
    $_SESSION['USER']['ID'] = '';
    unset( $_SESSION['USER']['ID']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAMCOST - планируй бюджет вместе с семьёй</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,100&display=swap" rel="stylesheet">
</head>
<body class="signBody">
    <div class="signBody__wrap">
        <div class="sign__content">
            <h2>famcost.com</h2>
            <div class="sign__formWrap">
                <h1 class="sign__title">Вход в систему</h1>
                <?php if ($_SESSION['MESSAGE']){
                    echo '<h3>'.$_SESSION['MESSAGE'].'</h3>'.$_SESSION['USER']['ID'];
                }
                
                ?>
                <form class="form__sign form__signIn" action="">
                    <input required name="login" type="text" placeholder="Логин">
                    <input required name="pass" type="text" placeholder="Пароль">
                    <button class="signBtn">Войти</button>
                </form>
                <form class="form__sign form__signUp" action="">
                    <input required name="login" type="text" placeholder="Логин">
                    <input required name="email" type="email" placeholder="E-mail">
                    <input required name="pass" type="text" placeholder="Пароль">
                    <button class="signBtn">Регистрация</button>
                </form>
                <h4 class="sign__btnUp">Регистрация</h4>
                <h4 class="sign__btnIn">Вход</h4>
            </div>
        </div>
        <div class="signPhoto">

           
        </div>
    </div>
    <script src="./js/sign.js"></script>
</body>
</html>

<?php $_SESSION['MESSAGE'] = '' ?>
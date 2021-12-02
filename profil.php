<?php 
    
    session_start();
    include './vendor/connect.php';

    $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    
    if (isset($_GET['exit'])){
        unset($_SESSION['USER']);
    }
    if(!isset($_GET['user'])){
        unset($_SESSION['USER']);
    }
    if(!isset($_SESSION['USER']['ID'])){
        header('location: signin.php');
    }


    $userId = $_SESSION['USER']['ID'];

    $allUsers = mysqli_query($connect_users, "SELECT * FROM `user__accaunt` WHERE `user__id` = '$userId'");
    $allUsersDig = mysqli_query($connect_users, "SELECT * FROM `user__accaunt` WHERE `user__id` = '$userId'");

    $lastId = mysqli_query($connect_users, "SELECT MAX(id) FROM `user__accaunt` WHERE `user__id` = '$userId'");
    $lastId = mysqli_fetch_assoc($lastId);

    $user = $_GET['user'];

    if ($user == 'admin'){
        $allRashod = mysqli_query($connect_users, "SELECT * FROM `rashod` WHERE `user__id` = '$userId'");
        $allDohod = mysqli_query($connect_users, "SELECT * FROM `dohod` WHERE `user__id` = '$userId'");
    } else {
        $allRashod = mysqli_query($connect_users, "SELECT * FROM `rashod` WHERE `user__id` = '$userId' AND `user` = '$user'");
        $allDohod = mysqli_query($connect_users, "SELECT * FROM `dohod` WHERE `user__id` = '$userId' AND `user` = '$user'");
    }
    
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>

    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/main.css">

    <script src="https://www.google.com/jsapi"></script>
</head>
<body class="profil__body">
    <div class="profil__contentWrap">
        <div class="profil__content">
            <div class="profil__top">
                <div class="profil__topInfo">
                    <div class="profil__topInfoBlock">
                        <h1>Famcost</h1>
                        <h2>Мы ради выиедть вас <?= $_SESSION['USER']['LOGIN']?> <span id="diagBtn"></span></h2>
                    </div>
                    <h2 onclick="window.location.href = '<?php echo $url?>&exit'" id="exit__btn">Выйти</h2>
                </div>
                <div class="profil__topAccaunts">
                    <div class="profil__topAccauntsPanel">
                        <h2>Аккаунты</h2>
                        <div class="profil__topAccauntsAdd">
                            +
                        </div>
                    </div>
                    <div class="profil__topBlocks">
                        <?php while($allUsersArr = mysqli_fetch_array($allUsersDig)){?>
                        <div class="profil__topBlock" data-num="<?= $allUsersArr['number']?>">
                            <div onclick="window.location.href = '?user=<?=$allUsersArr['name']?>'" class="profil__topBlockName">
                                <h3><?php if ($_GET['user'] == $allUsersArr['name']){?>
                                    <div class="selectedUser"></div>
                                    <?php }?>
                                    <span id="profilsName"><?php echo $allUsersArr['name']?></span></h3>
                            </div>
                            <div class="profil__topBlockBudget">
                                <p>Бюджет:<span id="budgetAcc"><?php echo $allUsersArr['budget']?></span></p>
                            </div>
                            <div class="profil__topBlockDelite">
                            <?php if ($allUsersArr['name'] != 'admin'){?>
                                <p>x</p>
                             <?php }?>
                            </div>
                        </div>
                        <?php }?>
                        
                    </div>
                </div>
            </div>
            <div class="profil__bottom">
                <div class="profil__stonks">
                    <div class="profil__stonksAdd">
                        <form action="">
                            <input name="user" id="userNum" type="hidden" value="<?php echo $_GET['user']?>">
                            <input required maxlength="11" name="sum" id="sumInp" type="number" placeholder="Сумма">
                            <input maxlength="55" name="comment" id="commentInp" type="text" placeholder="Комментарий">
                            <select class="select__green" name="selector" id="selectorInp">
                                <option value="1" selected>Доходы</option>
                                <option value="2">Расходы</option>
                            </select>
                            <button>Добавить</button>
                        </form>
                    </div>
                    <div class="profil__sec">
                        <div class="profil__stonksTitle">
                            <h3>Расходы <span id="rashod">3000</span></h3>
                        </div>
                        <div class="profil__stonksList"  id="rashodList">
                            <?php while($Data = mysqli_fetch_array($allRashod)){?>
                            <div class="profil__stonksBlock" data-num="<?= $Data['number']?>" data-user="<?= $Data['user']?>" data-type="2">
                                <div class="profil__stonksBlockCost">
                                    <h4><?= $Data['sum']?></h4>
                                </div>
                                <div class="profil__stonksBlockComment">
                                    <h4><?= $Data['comment']?></h4>
                                </div>
                                <div class="profil__stonksBlockDelite">
                                    <p>x</p>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                    <div class="profil__sec">
                        <div class="profil__stonksTitle">
                            <h3>Доходы <span id="dohod">3000</span></h3>
                        </div>
                        <div class="profil__stonksList" id="dohodList">
                            <?php while($Data = mysqli_fetch_array($allDohod)){?>
                            <div class="profil__stonksBlock" data-num="<?= $Data['number']?>" data-user="<?= $Data['user']?>" data-type="1">
                                <div class="profil__stonksBlockCost">
                                    <h4><?= $Data['sum']?></h4>
                                </div>
                                <div class="profil__stonksBlockComment">
                                    <h4><?= $Data['comment']?></h4>
                                </div>
                                <div class="profil__stonksBlockDelite">
                                    <p>x</p>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
    </div>

    <div class="popup" id="formPopup">
        <div class="popup__content">
            <div class="popupContentWrap">
                <h3>Добавить пользователя</h3>
                <div class="popup__contentForm">
                    <form action="">
                        <input required maxlength="15" name="name" class="nameInp" type="text" placeholder="Имя пользователя">
                        <button>Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="popup" id="diagram" >
        <div class="popup__content">
            <div class="popupContentWrap">
                <div class="airWrap">
                    <div id="air" style="width: 650px; height: 450px;"></div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- <script>
        let chartArr = [['Пользователь', 'Бюджет']];
        const profil__topBlock = document.querySelectorAll('.profil__topBlock');
        const diagBtn = document.querySelector('#diagBtn');
        const diagram = document.querySelector('#diagram');
        const airWrap = document.querySelector('.airWrap');

        diagBtn.addEventListener('click',()=>{
            airWrap.innerHTML = '<div id="air" style="width: 650px; height: 450px;"></div>';

            profil__topBlock.forEach(item =>{
            let name = item.querySelector('#profilsName').textContent;
            if (name != 'admin'){
                let budget = item.querySelector('#budgetAcc').textContent;
                let data = [name, parseInt(budget)];
            
                chartArr.push(data);
            }
           
        })


        
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable(chartArr);
            var options = {
            title: 'Бюджет',
            is3D: true,
            pieResidueSliceLabel: 'Остальное'
            };
            var chart = new google.visualization.PieChart(document.getElementById('air'));
            chart.draw(data, options);
        }
        })
        diagram.addEventListener('click', (e)=>{
            if (e.target.classList[0] == 'popup'){
               chartArr = [['Пользователь', 'Бюджет']];
               console.log(chartArr);
               console.log(document.getElementById('air'));
               document.querySelector('#air').remove();
               
               
            }
        })
    </script> -->
    <script src="./js/profil.js"></script>
    <script src="./js/profilCounter.js"></script>
</body>
</html>
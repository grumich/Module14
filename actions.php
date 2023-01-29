<?php
session_start();
include 'functions.php';

if ( isset( $_POST['dateofBirt'] ) ) {
            $array1=getUser($_SESSION['username']);
            $array1['dateb']=date('d-m-Y',strtotime($_POST['dateofBirt']));
            $_SESSION['dateb'] =$array1;
     
        }
destroySession();
?>

<!DOCTYPE html>
<html lang="RU">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    
<header>
<div class="container">
<div class="logo">
<a href="index.php">SPA салон Лотос</a>
<?php
$time1 = $_SESSION['timein']; // это время входа на сайт
$time2 = $_SESSION['timeendaction'];
$now=time();
if($now>$time2){
    if ( null !== getCurrentUser() ) {
        echo "Акция закончилась";
    }
    
}
else{
    $diff = $time2 - $now; // разница в секундах
    echo 'До конца акции осталось '.gmdate('H:i:s', $diff);
    
}


?>
<p>+7(495)123-45-67</p>

</div>
</header>
<nav>
    <div class="container">
    <ul class="menu">
        <li><a href="#">Контакты</a></li>
        <li><a href="login.php">Зарегистрироваться  на сайте</a></li>
        <li><a href="actions.php">Личный кабинет</a></li>
    </ul>
</div>
</nav>
<main>
<div class="container">
<div class="actioncol">
    <div class="actioncol1">

    <?php
    
    if (null !== getCurrentUser()){
    ?>
    <p> <?php echo $_SESSION['username'];?>  наш салон приготовил для тебя акции.</p>
    <p>Персональная скидка действует до 00:00  с момента входа на сайте.</p>
    <?php
    }else{?>

    <p> Зарегистрируйся на сайте и получи специальные предложения и акции.</p>
    <p>Персональная скидка действует до 00:00  с момента входа на сайте.</p>

<?php

    }
    if (null !== getCurrentUser()){
    ?>

     <form action="" method="post">  
        <input type="text" name="logoff" hidden>
        <input type="submit" name="submit" value="Выйти из личного кабинета">
     </form>
<?php

    }?>


    </div>


<div class="actioncol1">
   <?php
if (null !== getCurrentUser()){

   if(!isset($_SESSION['dateb'])){
    ?>
    <form class="signform" action="" method="post">
    <p>Введите дату вашего рождения и мы дадим вам скидку 5% на все услуги</p>
    <input type="date" name="dateofBirt">
    <input name="submit" type="submit" value="Отправить">
</form>

<?php
   }
}
    
    if(isset($_SESSION['dateb'])){
    
    $now1=round((time()/86400),0);
    $dateb1=round(strtotime($_SESSION['dateb']['dateb'])/86400,0);
    $dateb2=round(strtotime('2023-12-31')/86400,0);
    $dateb3=round(strtotime('2023-01-01')/86400,0);
    echo "<p>Ваш день рождение ".$_SESSION['dateb']['dateb']."</p>";

    if($now1 == $dateb1){
        echo "<p>С днем рождения, вам скидка на все 5%!!</p>";
        }
     elseif($now1>$dateb1){      
        $dateb4=$dateb2-$dateb3;
        $dateb5=$now1-$dateb1;
        $days = $dateb4-$dateb5+1;
    echo "<p>До вашего дня рожения осталось дней - ".$days."</p>";
    }
     else{
        $days = ($dateb1-$now1);
        echo "<p>До вашего дня рожения осталось дней - ".$days."</p>";
    
     }
}
?>
</div>
   
</div>
</div>
</main>

</body>
</html>

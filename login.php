<?php
session_start();
include 'functions.php';

if ( null !== getCurrentUser() ) { //Если пользователь вошёл, то редирект на главную страницу
    header('Location: actions.php');
    exit;
}

if ( isset( $_POST['login'] ) ) {
    if ( isset( $_POST['password'] ) ) { //Если  данные введены в форму входа
        if ( checkPassword( $_POST['login'], $_POST['password'] ) ) { //проверяем введённые данные
            $_SESSION['username'] = $_POST['login']; //делаем метку клиента
            $_SESSION['timein'] = time(); //делаем метку даты входа
            $_SESSION['timeendaction'] = strtotime('23:59:59'); //делаем метку даты конца акции
            header('Location: index.php'); //перенапрявляем на главную страницу
            exit;
        }
        else{
            $error="<h2 style=\"text-align:center;\">Вас нет в нашей базе</h2>";
        }
    }
}

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
    echo 'До конца акции осталось '.gmdate('H:i:s', $diff); // к сожалению не умеет показывать разницу >=24 часа
    
}


?>
<p>+7(495)123-45-67</p>

</div>
</header>
<nav>
    <div class="container">
    <ul class="menu">
        <li><a href="#">Контакты</a></li>
        <li><a href="login.php">Зарегистироваться на сайте</a></li>
        <li><a href="actions.php">Личный кабинет</a></li>
    </ul>
</div>
</nav>
<main>
    <div class="container">
        <h3>Войти в личный кабинет</h3>
        
<?php
if(isset($error)){
    echo $error;
}
else{?> 
     <form class="signform" action="" method="post">
        <input name="login" type="text" placeholder=" Логин"><br>
        <input name="password" type="password" placeholder=" Пароль"><br>
        <input name="submit" type="submit" value="Войти">
    </form>
    
<?php
    
}

?>     
   
        
        
        
      
    </div>
</main>

</body>
</html>
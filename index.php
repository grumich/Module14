<?php
session_start();
include 'functions.php';

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
        <li><a href="login.php">Зарегистрироваться на сайте</a></li>
        <li><a href="actions.php">Личный кабинет</a></li>
    </ul>
</div>
</nav>
<main>
    <div class="container">
        <h3>Вы находитесь на главной странице нашего спа-салона</h3>
        <p class="reginf">Предлагаем вам ознакомиться с фото наших услуг.</p>

<?php
if ( null !== getCurrentUser() ) { //Если пользователь вошёл, то редирект на главную страницу
echo  "<p class=\"reginf\"><b>Здравствуйте ".$_SESSION['username']."!!!</b> твои персональные предложения в разделе <b>Личный кабинет</b>.</p>";
}
else{
    echo "<p class=\"reginf\"><b>Войдите или зарегистрируйтесь!!!</b> и получите персональные предложения  в разделе <b>Личный кабинет</b>.</p>";
}
?>

         <div class="imgcontainer">
            <img src="https://img.youtube.com/vi/V-NW_u9QfAA/0.jpg" alt="">
            <img src="https://i.ytimg.com/vi/f8Rh9f1FrPA/hqdefault.jpg" alt="">
            <img src="https://i.ytimg.com/vi/lb272euAFhk/hqdefault.jpg" alt="">
            <img src="https://i.ytimg.com/vi/IHBi_snMOpA/hqdefault.jpg" alt="">
            <img src="https://sun9-74.userapi.com/impg/LzJArNaCGy9FnJStj-AWwxdD3tioV0zuyshKog/hZjypFYLcbU.jpg?size=600x400&quality=96&sign=b6146c469e82e9ed5710bd3118285c01&c_uniq_tag=vxIMKaSVCb3VxQYK3YefZEKN12I2QH6RzZtkXxxyf1c&type=album" alt="">
            <img src="https://kadinloji.com/resim/masaj-zayiflatirmi-masaj-yaptirmak-kilo-verdirir-mi.jpg" alt="">
        </div>
    </div>
</main>

</body>
</html>

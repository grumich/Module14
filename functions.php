<?php
//Функция, которая возвращает массив всех пользователей и хэш паролей.
function getUsersList(){
    return
    [
        ['login' => 'Галя', 'password' => '$2y$10$uYa/0Jyv/btDSVSQKJ3eg.YA1dSmYj3Mzf9LIh4rR.v3rCJGhrCBy'],//123 - пароль и хэш
        ['login' => 'Иван', 'password' => '$2y$10$Yd71HHyKqNV/1EJybM3kB.xYIlBPJ5vVGYDeTXT8MMjqfXP9hgiEq'],//345
        ['login' => 'Андрей', 'password' => '$2y$10$AzlC.eOJaZ5KGADoXTSvaeX1aZ/8P/WILYsHoiWRgRog3.ProOpnG'],//567
        ['login' => 'Женя', 'password' => '$2y$10$689N6dAPVsJ.0zG3klxZju7IBaOIGmMMf8XgA29pfrEHW6jFqsc2e'],//789
        ['login' => 'Маша', 'password' => '$2y$10$82MtEEUp78xnstnj0xEoGO4GGRGb4bvA324AQWFTYv8EUia/cN7fS'],//891
    ];
};

//Функция, которая проверяет - существует ли пользователь с заданным логином
function existsUser($login){ 
    return in_array( $login, array_column( getUsersList(),'login' ) );
}

//функция, которая возвратит информацию о пользователе с таким логином или null
function getUser($login) { 
    $users = getUsersList();
    foreach ($users as $user) {
        if ($login == $user['login']) {
            return $user;
        }
    }
}

//функция, которая возвращает true тогда, когда существует пользователь с указанным логином и введенный им пароль прошел проверку.
function checkPassword($login, $password) { 
if ( true === existsUser($login) ) { //проверка существует ли пользователь с таким логином
        if ( password_verify( $password, getUser($login)['password'] ) ) { //если логин пользователя найден проверяем хэш пароля пользователя
            return true;
        }
    }
    return false;
}

//Добавляем функцию getCurrentUser() которая возвращает либо имя вошедшего на сайт пользователя, либо null
function getCurrentUser() {    
    if ( isset( $_SESSION['username'] ) ) { //Проверяем, есть ли элемент с индексом 'username' в массиве сессии
        if ( existsUser( $_SESSION['username'] ) ) {  //Проверяем существует ли пользователь с заданным логином
            return $_SESSION['username'];
        }
    }
}

function destroySession(){
if(isset($_POST['logoff'])){
    session_destroy();
    header('Location: login.php');
}
}


?>
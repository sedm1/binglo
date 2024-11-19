<?php
include './connect.php';

/**
 * Результат запроса
 */
$res = [];

$q = $_GET['q'];

function getUserData(string $token): array
{
    global $pdo;
    $res = [];

    $sql = 'SELECT md5(md5(`id`)) as token, avatar, username FROM `users` WHERE md5(md5(`id`)) = :token';
    $sth = $pdo->prepare($sql);

    $sth->execute(array('token' => $token));

    $sqlResult = $sth->fetchAll(PDO::FETCH_ASSOC);

    if (!$sqlResult) {
        $res['status'] = 0;
        $res['message'] = 'Такого пользователя нет в базе данных';

        return $res;
    }

    $res['status'] = 1;
    $res['result'] = $sqlResult;

    return $res;

}
;

/**
 * Авторизация пользователя
 * @param string $name
 * @param string $pass
 */
function login(string $name, string $pass): array
{
    global $pdo;
    $UserExist = getUserExistsFromName($name);

    $res = [];

    if (!$UserExist) {
        $res['status'] = 0;
        $res['message'] = 'Пользователь с такими данными не сущетсвует. Зарегистрируйтесь';

        return $res;

    }

    $sql = 'SELECT md5(md5(`id`)) as token, username, avatar 
    FROM `users` 
    WHERE 
        `username` = :username 
        AND 
        `password` = :pass
    ';

    $sth = $pdo->prepare($sql);
    $sth->execute(array('username' => $name, 'pass' => md5(md5($pass))));

    $sqlResult = $sth->fetchAll(PDO::FETCH_ASSOC);

    if (!$sqlResult) {
        $res['status'] = 0;
        $res['message'] = 'Неверный пароль';

        return $res;
    }

    $res['status'] = 1;
    $res['message'] = 'Вход прошел успешно';
    $res['result'] = $sqlResult;

    return $res;
}

/**
 * Регистрация
 * @param mixed $name
 */
function registration(string $name, string $pass): void
{
    global $res;
    global $pdo;
    $UserExist = getUserExistsFromName($name);

    if ($UserExist) {
        $res['status'] = 0;
        $res['message'] = 'Пользователь с такими данными уже сущетсвует. Войдите в свой профиль';

        exit;
    }

    $sql = 'INSERT INTO `users` (`username`, `password`) VALUES (:username, :pass)';
    $sth = $pdo->prepare($sql);
    $sth->execute(array('username' => $name, 'pass' => md5(md5($pass))));

}

/**
 * Проверка на существование пользователя
 * @param string name
 * @param-out array
 */
function getUserExistsFromName(string $name)
{
    global $pdo;
    $sql = 'SELECT * FROM `users` WHERE `username` = :username';
    $sth = $pdo->prepare($sql);

    $sth->execute(array('username' => $name));
    $sqlResult = $sth->fetchAll(PDO::FETCH_ASSOC);

    return $sqlResult;
}

if ($q == 'getUserData') {

    $token = $_GET['userToken'];
    $res = getUserData($token);
} elseif ($q == 'login') {

    
    $username = $_GET['username'];
    $pass = $_GET['password'];

    $res = login($username, $pass);

} elseif ($q == 'registration') {

    $username = $_GET['username'];
    $pass = $_GET['password'];
    
    registration($username, $pass);

    //Автоматически войти в профиль после регистрации
    $res = login($username, $pass);

}
echo json_encode($res, JSON_UNESCAPED_UNICODE);


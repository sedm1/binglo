<?php
include './connect.php';

/**
 * Результат запроса
 */
$res = [];

$q = $_GET['q'];
$token = $_GET['token'];

/**
 * Получит все доски
 */
function getBoards(string $userToken){
    global $pdo;

    $res = [];

    $sql = 'SELECT 
    boards.id,
    boards.title,
    boards.description,
    boards.types,
    users.avatar
    FROM 
        `boards` 
    LEFT JOIN 
        `users` 
        ON 
        boards.owners_id = users.id
    WHERE 
        md5(md5(`owners_id`)) = :userToken
    ';
    
    $sth = $pdo->prepare($sql);
    $sth->execute(array('userToken' => $userToken));

    $sqlResult = $sth->fetchAll(PDO::FETCH_ASSOC);

    $res['status'] = 1;
    $res['message'] = 'Доски получены';
    $res['result'] = $sqlResult;

    return $res;
}

if ($q === 'getBoards'){
    $res = getBoards($token);
}
echo json_encode($res, JSON_UNESCAPED_UNICODE);
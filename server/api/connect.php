<?php 
$host = '127.0.0.1';
$dbname = 'binglo';
$name = 'root';
$pass = '';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Headers: *');
try{ 
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;", $name, $pass);
} catch(PDOException $exception){
    var_dump($exception -> getMessage());
}
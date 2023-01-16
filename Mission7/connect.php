<?php
$dsn='mysql:dbname=zootickoonmission6;host=localhost';
$user='root';
$pwd='';

try{
    $dbh=new PDO($dsn,$user,$pwd);
} catch(PDOException $e){
    echo 'Connexion échouée : '.$e->getMessage();
}
?>
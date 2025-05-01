<?php
$server="127.0.0.1";
$user="root";
$pass="";


$db_con=mysqli_connect($server,$user,$pass);

$dbs="create database IF NOT EXISTS phpcms";

$dbsss=mysqli_query($db_con,$dbs);



$tbls="create table IF NOT EXISTS posts";
$dbssss=mysqli_query($db_con,$tbls);

print_r($dbssss);
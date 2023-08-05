<?php

$link = mysqli_connect('localhost', 'root', '');

if ($link) {
    echo "connected successfully";
} else {
    die("Error: Could not connect".mysqli_connect_error());
}

// $sql = "DROP DATABASE IF EXIXTS shopaholic; CREATE DATABASE shopaholic;";
// $sql = "SET NAMES utf8mb4; DROP DATABASE IF EXIXTS shopaholic; CREATE DATABASE shopaholic; CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;";

$sql = "SET NAMES utf8mb4; DROP DATABASE IF EXIXTS shopaholic; CREATE SCHEMA shopaholic; CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;";

if (mysqli_multi_query($link, $sql)) {
    echo "\nSCHEMA created successfully";
} else {
    echo "\nError creating SCHEMA". mysqli_error($link);
}

// CREATE TABLE `shopaholic`.`feedback` (`id` INT(11) NOT NULL AUTO_INCREMENT , `name` VARCHAR(30) NOT NULL , `surname` VARCHAR(30) NOT NULL , `email` VARCHAR(30) NOT NULL , `message` TEXT NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;

mysqli_close($link);
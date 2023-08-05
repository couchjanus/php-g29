<?php

$address = conf('contacts');


$link = mysqli_connect('localhost', 'root', '', 'shopaholic');

if ($link) {
    echo "connected successfully";
} else {
    die("Error: Could not connect".mysqli_connect_error());
}
$messages = [];

if ($_POST) {
    // var_dump($_POST);
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $surname = mysqli_real_escape_string($link, $_POST['surname']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $message = mysqli_real_escape_string($link, $_POST['message']);
        
    // $sql = "INSERT INTO feedback (name, surname, email, message) VALUES ('$name', '$surname', '$email', '$message')";

    // mysqli_query($link, $sql);

    $stmt = mysqli_prepare($link, "INSERT INTO feedback (name, surname, email, message) VALUES (?, ?, ?, ?)");

    mysqli_stmt_bind_param($stmt, "ssss", $name, $surname, $email, $message);

    mysqli_stmt_execute($stmt);

}

$sql = "SELECT * FROM feedback";

$result = mysqli_query($link, $sql);

if($result) {
    $messages = mysqli_fetch_all($result, MYSQLI_ASSOC);
}else {
    echo "\nError Could not able to execute $sql". mysqli_error($link);
}

render('contact/index', ['messages' => $messages, 'address' => $address]);
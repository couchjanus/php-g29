<?php

// include_once realpath(ROOT."/app/Views/contact/index.php");

$messages = [
    [
        "name"=> "Mouse",
        "surname" => "Quin",
        "email" => "test@my.cat",
        "message" => "hello Cats", 
        "created_at" => "July 30, 2023"
    ],
];

if ($_POST) {
    // var_dump($_POST);

    $arr = [
        [
        'name' => htmlspecialchars($_POST['name']) ,
        'surname' => htmlspecialchars($_POST['surname']),
        'email' => htmlspecialchars($_POST['email']),
        'message' => htmlspecialchars($_POST['message']),
        'created_at' => date('F j, Y')],
    ];

    // var_dump($arr);

    $messages = array_merge($messages, $arr);
  
}

render('contact/index', ['messages' => $messages]);
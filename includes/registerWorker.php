<?php

session_start();

require_once "db.php";
require_once "../functions.php";

if (isset($_POST['registerWorker'])) {
    $name = $_POST['imie'];
    $surname = $_POST['nazwisko'];
    $email = $_POST['email'];
    $password = $_POST['haslo'];
    $user_type = $_POST['user_type'];

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $query = "INSERT INTO pracownicy (Imie, Nazwisko, email, password, user_type ) VALUES ('$name', '$surname', '$email', '$hashed_password', '$user_type')";
    $result = mysqli_query($conn, $query);

    if (! $result) {
        $message = "Nie udalo sie zarejestrować";
        header("location: ../registerWorker.php?error=$message");
        exit;
    }
    header("location: ../panelAdmin.php");
    exit;
};
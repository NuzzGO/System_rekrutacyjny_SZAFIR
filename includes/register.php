<?php

session_start();

require_once "db.php";
require_once "../functions.php";

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $query = "INSERT INTO kandydaci (Imie, Nazwisko, Nazwa_Uzytkownika, Haslo) VALUES ('$name', '$surname', '$email', '$hashed_password')";
    $result = mysqli_query($conn, $query);

    if (! $result) {
        $message = "Nie udalo sie zarejestrować";
        header("location: ../registerView.php?error=$message");
        exit;
    }
    header("location: ../loginView.php");
    exit;
};

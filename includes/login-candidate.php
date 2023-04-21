<?php

session_start();

require_once "db.php";
require_once "../functions.php";

if (isset($_POST['login-candidate'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $message = "Wypełnij wszystkie pola";
        header("location: ../loginView.php?error-k=$message");
        exit;
    }

    $query = "SELECT * FROM kandydaci WHERE Nazwa_Uzytkownika = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['Haslo'])) {
            unset($row['Haslo']);
            $_SESSION['candidate'] = $row;
            $_SESSION['candidate']['etap']=0;

            header("location: ../index.php");
            exit;
        } else {
            $message = "Nie udalo sie zalogowac";
            header("location: ../loginView.php?error-k=$message");
            exit;
        }
    } else {
        $message = "Nie udalo sie zalogowac";
        header("location: ../loginView.php?error-k=$message");
        exit;
    }
};

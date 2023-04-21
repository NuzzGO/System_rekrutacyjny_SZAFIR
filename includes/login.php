<?php

session_start();

require_once "db.php";
require_once "../functions.php";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $message = "Wypełnij wszystkie pola";
        header("location: ../loginView.php?error=$message");
        exit;
    }

    $query = "SELECT * FROM pracownicy WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            unset($row['password']);
            $_SESSION['login'] = $row;

            header("location: ../index.php");
            exit;
        } else {
            $message = "Nie udalo sie zalogowac";
            header("location: ../loginView.php?error=$message");
            exit;
        }
    } else {
        $message = "Nie udalo sie zalogowac";
        header("location: ../loginView.php?error=$message");
        exit;
    }
};



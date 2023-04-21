<?php

session_start();

require_once "db.php";
require_once "../functions.php";

if (isset($_POST['updateWorker'])) {
    $email = $_POST['email'];
    $idKierownicy = $_POST['idKierownika'];
    $idDzialy = $_POST['idDzialu'];

    $query = "UPDATE pracownicy SET ID_Kierownicy = '$idKierownicy' WHERE email = '$email';";
        $result = mysqli_query($conn, $query);
        

        $query = "UPDATE pracownicy SET ID_Dzialy = '$idDzialy' WHERE email = '$email';";
        $result = mysqli_query($conn, $query);

    header("Location: ../panelAdmin.php");
}else {
    $message = "Nie można tego zrobić! nie ma danych :<";
    header("Location: ../applicationsView.php?error=$message");
    exit;
}

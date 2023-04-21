<?php

session_start();

require_once "db.php";
require_once "../functions.php";

if (isset($_POST['modifyDzialy'])) {
    $idKierownicy = $_POST['idKierownika'];
    $nazwa = $_POST['nazwa'];

    $wybor=$_POST['wybor'];
    switch ($wybor) {
        case '+':

            $query = "INSERT INTO dzialy (Nazwa, ID_Kierownicy) VALUES('$nazwa', '$idKierownicy');";
            $result = mysqli_query($conn, $query);

            break;

        case '-':

            $query = "DELETE FROM dzialy WHERE Nazwa = '$nazwa' and ID_Kierownicy = '$idKierownicy';";
            $result = mysqli_query($conn, $query);

            break;

        default:
            # code...
            break;
    }


    header("Location: ../dzialyView.php");
}else {
    $message = "Nie można tego zrobić! nie ma danych :<";
    header("Location: ../applicationsView.php?error=$message");
    exit;
}
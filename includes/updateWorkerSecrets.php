<?php

session_start();

require_once "db.php";
require_once "../functions.php";

if (isset($_POST['updateWorkerSecrets'])) {


    $email = $_POST['email'];

    $wybor=$_POST['wybor'];
    switch ($wybor) {
        case 'imie':

            $wartosc = $_POST['wartosc'];
            $query = "UPDATE pracownicy SET Imie = '$wartosc' WHERE email = '$email';";
            $result = mysqli_query($conn, $query);

            break;

        case 'nazwisko':
            
            $wartosc = $_POST['wartosc'];
            $query = "UPDATE pracownicy SET Nazwisko = '$wartosc' WHERE email = '$email';";
            $result = mysqli_query($conn, $query);

            break;
        
       case 'email':
                
            $wartosc = $_POST['wartosc'];
            $query = "UPDATE pracownicy SET email = '$wartosc' WHERE email = '$email';";
            $result = mysqli_query($conn, $query);

            break;
            
        case 'idKierownika':
            
            $wartosc = $_POST['wartosc'];
            $query = "UPDATE pracownicy SET ID_Kierownicy = '$wartosc' WHERE email = '$email';";
            $result = mysqli_query($conn, $query);

            break;  
            
        case 'idDzialu':
             
            $wartosc = $_POST['wartosc'];
            $query = "UPDATE pracownicy SET ID_Dzialy = '$wartosc' WHERE email = '$email';";
            $result = mysqli_query($conn, $query);

            break;

        case 'user_type':
            
            $wartosc = $_POST['wartosc'];
            $query = "UPDATE pracownicy SET user_type = '$wartosc' WHERE email = '$email';";
            $result = mysqli_query($conn, $query);

             break;

        default:
            # code...
            break;
    }

    header("Location: ../panelAdmin.php");
}else {
    $message = "Nie można tego zrobić! nie ma danych :<";
    header("Location: ../applicationsView.php?error=$message");
    exit;
}

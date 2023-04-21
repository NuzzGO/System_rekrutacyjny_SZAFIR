<?php

session_start();

require_once "db.php";
require_once "../functions.php";

if (isset($_POST['reqruView'])) {
    $etap = $_POST['etap'];
    $stan = $_POST['stan'];
    $idAplikacji = $_POST['idAplikacji'];
    $data = date("Y/m/d");

    $query = "UPDATE etap_rekrutacji  SET Etap = '$etap', Stan = '$stan', Data = '$data' WHERE ID_Aplikacje = '$idAplikacji';";
    $result = mysqli_query($conn, $query);
        
        

    header("Location: ../reqruView.php");
}else {
    $message = "Nie można tego zrobić! nie ma danych :<";
    exit;
}
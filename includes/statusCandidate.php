<?php

session_start();

require_once "db.php";
require_once "../functions.php";

if (isset($_POST['sprawdz'])) 
{

    $id_Aplikacji = $_POST['id'];
    
    $query = "SELECT e.Etap FROM etap_rekrutacji e WHERE e.ID_Aplikacje = '$id_Aplikacji';";
    $result = mysqli_query($conn, $query);
    $etap = mysqli_fetch_array($result, MYSQLI_ASSOC)['Etap'];
    $etap = intval($etap);

    $_SESSION['candidate']['etap'] = $etap;
    header("location: ../index.php");

} else {

    $_SESSION['candidate']['etap'] = 0;
    $message = "Nie udalo sie sprawdzić stanu rekrutacji";
    header("location: ../index.php?error=$message");

    exit;
};

?>
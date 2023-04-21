<?php

session_start();

require_once "db.php";
require_once "../functions.php";

if (isset($_POST['remove'])) {
  
    $idKandydata = $_POST['id'];
    $query = <<<EOF
SELECT  a.ID_Aplikacje as 'ID_A', a.ID_Etap_Rekrutacji  as 'ID_E'
FROM aplikacje a 
WHERE a.ID_Kandydaci = $idKandydata;
EOF;

$resultup = mysqli_query($conn, $query);
//$data = $result->fetch_all(MYSQLI_ASSOC);

if (mysqli_num_rows($resultup) == 0) {
    echo "Brak wyników.";
    $query = "DELETE FROM kandydaci WHERE ID_Kandydaci = $idKandydata;";
        $result = mysqli_query($conn, $query);
} else {

    // Przetwarzanie wyników
        
    while ($row = mysqli_fetch_assoc($resultup)) {
        $idAplikacje = $row['ID_A'];
        $idEtap = $row['ID_E'];
        echo $idAplikacje;
        //ID Opisu
        $query = "SELECT etap_rekrutacji.ID_Opis_Statusu FROM etap_rekrutacji WHERE etap_rekrutacji.ID_Etap_Rekrutacji = '$idEtap' and ID_Aplikacje = '$idAplikacje';";
         $result = mysqli_query($conn, $query);
        $idOpis_statusu = mysqli_fetch_array($result, MYSQLI_ASSOC)['ID_Opis_Statusu'];
         $idOpis_statusu = intval($idOpis_statusu);

         //ID Zalacznik
         $query = "SELECT etap_rekrutacji.ID_Zalacznik FROM etap_rekrutacji WHERE etap_rekrutacji.ID_Etap_Rekrutacji = '$idEtap' and ID_Aplikacje = '$idAplikacje';";
         $result = mysqli_query($conn, $query);
         $idZalacznik = mysqli_fetch_array($result, MYSQLI_ASSOC)['ID_Zalacznik'];
         $idZalacznik = intval($idZalacznik);
        
        //ID Kompetencje (dzieki id_aplikacji)
        $query = "SELECT kompetencje.ID_Kompetencje FROM kompetencje WHERE kompetencje.ID_Aplikacje = '$idAplikacje';";
        $result = mysqli_query($conn, $query);
        $idKompetencje = mysqli_fetch_array($result, MYSQLI_ASSOC)['ID_Kompetencje'];
        $idKompetencje = intval($idKompetencje); 

        //ID Umiejetnosci
        $query = "SELECT kompetencje.ID_Umiejętności FROM kompetencje WHERE kompetencje.ID_Aplikacje = '$idAplikacje';";
        $result = mysqli_query($conn, $query);
        $idumiejetnosci = mysqli_fetch_array($result, MYSQLI_ASSOC)['ID_Umiejętności'];
        $idumiejetnosci = intval($idumiejetnosci); 

        $query = "DELETE FROM kompetencje WHERE ID_Kompetencje = $idKompetencje;";
        $result = mysqli_query($conn, $query);
    
        $query = "DELETE FROM umiejetnosci WHERE ID_Umiejetnosci  = $idumiejetnosci;";
        $result = mysqli_query($conn, $query);
    
        $query = "DELETE FROM opis_statusu WHERE ID_Opis_Statusu = $idOpis_statusu;";
        $result = mysqli_query($conn, $query);
    
        $query = "DELETE FROM etap_rekrutacji WHERE ID_Etap_Rekrutacji = $idEtap;";
        $result = mysqli_query($conn, $query);
    
        $query = "DELETE FROM zalacznik WHERE ID_Zalacznik = $idZalacznik;";
        $result = mysqli_query($conn, $query);
    
        $query = "DELETE FROM aplikacje WHERE ID_Aplikacje = $idAplikacje;";
        $result = mysqli_query($conn, $query);

    }
    $query = "DELETE FROM kandydaci WHERE ID_Kandydaci = $idKandydata;";
        $result = mysqli_query($conn, $query);
}
    if (! $result) {
        $message = "Nie udalo sie";
        header("location: ../panel.php?error=$message");
        exit;
    }
    header("location: ../panel.php");
    exit;
};

if (isset($_POST['add'])){
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
    header("location: ../panel.php");
    exit;
};
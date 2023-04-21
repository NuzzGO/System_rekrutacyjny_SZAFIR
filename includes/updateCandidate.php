<?php

session_start();

require_once "db.php";
require_once "../functions.php";

if (isset($_POST['updateCandidate'])){

$co_zmieniamy = $_POST['co_zmieniamy'];
$wartosc = $_POST['wartosc'];

//ID kandydata
$idKandydata = $_POST['email'];
$query = "SELECT kandydaci.ID_Kandydaci FROM kandydaci WHERE kandydaci.Nazwa_Uzytkownika = '$idKandydata';";
$result = mysqli_query($conn, $query);
$idKandydata = mysqli_fetch_array($result, MYSQLI_ASSOC)['ID_Kandydaci'];
$idKandydata = intval($idKandydata);

//ID Stanowiska
    $idStanowisko = $_POST['stanowisko'];
    $idStanowiskoQuery = "SELECT stanowiska.ID_Stanowiska FROM stanowiska where stanowiska.Nazwa = '$idStanowisko' ;";
    $idStanowiskoResult = mysqli_query($conn, $idStanowiskoQuery);
    $idStanowiskoRow = $idStanowiskoResult->fetch_assoc();
    $idStanowiska = intval($idStanowiskoRow['ID_Stanowiska']);

switch ($co_zmieniamy) {
    case 1:

       $query = "UPDATE kandydaci SET Nazwa_Uzytkownika = '$wartosc' WHERE ID_Kandydaci = '$idKandydata';";
        $result = mysqli_query($conn, $query);

      break;
    case 2:

        $query = "SELECT aplikacje.ID_Aplikacje FROM aplikacje WHERE ID_Kandydaci = '$idKandydata' and ID_Stanowiska = '$idStanowiska';";
        $result = mysqli_query($conn, $query);
        $idAplikacje = mysqli_fetch_array($result, MYSQLI_ASSOC)['ID_Aplikacje'];
        $idAplikacje = intval($idAplikacje); 
        
        $query = "UPDATE aplikacje SET ID_Pracownicy = '$wartosc' WHERE ID_Aplikacje = '$idAplikacje' and ID_Stanowiska = '$idStanowiska';";
        $result = mysqli_query($conn, $query);

      break;

      case 3:
        
        $query = "SELECT aplikacje.ID_Aplikacje FROM aplikacje WHERE ID_Kandydaci = '$idKandydata' and ID_Stanowiska = '$idStanowiska';";
        $result = mysqli_query($conn, $query);
        $idAplikacje = mysqli_fetch_array($result, MYSQLI_ASSOC)['ID_Aplikacje'];
        $idAplikacje = intval($idAplikacje); 

        $query = "SELECT kompetencje.ID_Umiejętności FROM kompetencje WHERE kompetencje.ID_Aplikacje = '$idAplikacje';";
        $result = mysqli_query($conn, $query);
        $idumiejetnosci = mysqli_fetch_array($result, MYSQLI_ASSOC)['ID_Umiejętności'];
         $idumiejetnosci = intval($idumiejetnosci);
         
        $query = "UPDATE umiejetnosci SET Nazwa = '$wartosc' WHERE ID_Umiejetnosci = '$idumiejetnosci' ";
        $result = mysqli_query($conn, $query);
        
        break;

     case 4:

        $query = "SELECT aplikacje.ID_Aplikacje FROM aplikacje WHERE ID_Kandydaci = '$idKandydata' and ID_Stanowiska = '$idStanowiska';";
        $result = mysqli_query($conn, $query);
        $idAplikacje = mysqli_fetch_array($result, MYSQLI_ASSOC)['ID_Aplikacje'];
        $idAplikacje = intval($idAplikacje); 

        $query = "SELECT aplikacje.ID_Etap_Rekrutacji FROM aplikacje WHERE aplikacje.ID_Kandydaci = '$idKandydata' and ID_Stanowiska = '$idStanowiska';";
        $result = mysqli_query($conn, $query);
        $idEtap_rekrutacji = mysqli_fetch_array($result, MYSQLI_ASSOC)['ID_Etap_Rekrutacji'];
        $idEtap_rekrutacji = intval($idEtap_rekrutacji);
        
        $query = "SELECT etap_rekrutacji.ID_Opis_Statusu FROM etap_rekrutacji WHERE etap_rekrutacji.ID_Etap_Rekrutacji = '$idEtap_rekrutacji' and ID_Aplikacje = '$idAplikacje';";
        $result = mysqli_query($conn, $query);
        $idOpis_statusu = mysqli_fetch_array($result, MYSQLI_ASSOC)['ID_Opis_Statusu'];
        $idOpis_statusu = intval($idOpis_statusu);

        $query = "UPDATE opis_statusu SET Opis = '$wartosc' WHERE ID_Opis_Statusu = '$idOpis_statusu' ";
        $result = mysqli_query($conn, $query);
        
        break;
    
    default:
      
      break;
  }
  
header("Location: ../showApplications.php");
exit;

}else {
    $message = "Nie można tego zrobić! nie ma danych :<";
    header("Location: ../applicationsView.php?error=$message");
    exit;
}

?>
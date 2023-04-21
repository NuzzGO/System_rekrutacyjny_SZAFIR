<?php
session_start();

require_once "db.php";
require_once "../functions.php";

if (isset($_POST['removeApply'])) {
//ID kandydata
    $idKandydata = $_POST['email'];
    $query = "SELECT kandydaci.ID_Kandydaci FROM kandydaci WHERE kandydaci.Nazwa_Uzytkownika = '$idKandydata';";
    $result = mysqli_query($conn, $query);
    $idKandydata = mysqli_fetch_array($result, MYSQLI_ASSOC)['ID_Kandydaci'];
    $idKandydata = intval($idKandydata);

//Nazwa stanowiska kandydata ktore bedziemy usuwac
    $idStanowiska = $_POST['stanowisko'];
    $query = "SELECT stanowiska.ID_Stanowiska FROM stanowiska where stanowiska.Nazwa = '$idStanowiska' ;";
    $result = mysqli_query($conn, $query);
    $idStanowiska = mysqli_fetch_array($result, MYSQLI_ASSOC)['ID_Stanowiska'];
    $idStanowiska = intval($idStanowiska);

//ID aplikacje

    $query = "SELECT aplikacje.ID_Aplikacje FROM aplikacje WHERE aplikacje.ID_Kandydaci = '$idKandydata' and ID_Stanowiska = '$idStanowiska';";
    $result = mysqli_query($conn, $query);
    $idAplikacje = mysqli_fetch_array($result, MYSQLI_ASSOC)['ID_Aplikacje'];
    $idAplikacje = intval($idAplikacje); //zwraca zamniejsza wartosc gdyby byly powtorzenia (najstarsza wartosc)

//ID etap_rekrutacji

    $query = "SELECT aplikacje.ID_Etap_Rekrutacji FROM aplikacje WHERE aplikacje.ID_Kandydaci = '$idKandydata' and ID_Stanowiska = '$idStanowiska';";
    $result = mysqli_query($conn, $query);
    $idEtap_rekrutacji = mysqli_fetch_array($result, MYSQLI_ASSOC)['ID_Etap_Rekrutacji'];
    $idEtap_rekrutacji = intval($idEtap_rekrutacji); //zwraca zamniejsza wartosc gdyby byly powtorzenia (najstarsza wartosc)
//ID Opis_statusu
    
    $query = "SELECT etap_rekrutacji.ID_Opis_Statusu FROM etap_rekrutacji WHERE etap_rekrutacji.ID_Etap_Rekrutacji = '$idEtap_rekrutacji' and ID_Aplikacje = '$idAplikacje';";
    $result = mysqli_query($conn, $query);
    $idOpis_statusu = mysqli_fetch_array($result, MYSQLI_ASSOC)['ID_Opis_Statusu'];
    $idOpis_statusu = intval($idOpis_statusu); //zwraca zamniejsza wartosc gdyby byly powtorzenia (najstarsza wartosc)

//ID Zalacznik

    $query = "SELECT etap_rekrutacji.ID_Zalacznik FROM etap_rekrutacji WHERE etap_rekrutacji.ID_Etap_Rekrutacji = '$idEtap_rekrutacji' and ID_Aplikacje = '$idAplikacje';";
    $result = mysqli_query($conn, $query);
    $idZalacznik = mysqli_fetch_array($result, MYSQLI_ASSOC)['ID_Zalacznik'];
    $idZalacznik = intval($idZalacznik); //zwraca zamniejsza wartosc gdyby byly powtorzenia (najstarsza wartosc)

//ID Kompetencje (dzieki id_aplikacji)

    $query = "SELECT kompetencje.ID_Kompetencje FROM kompetencje WHERE kompetencje.ID_Aplikacje = '$idAplikacje';";
    $result = mysqli_query($conn, $query);
    $idKompetencje = mysqli_fetch_array($result, MYSQLI_ASSOC)['ID_Kompetencje'];
    $idKompetencje = intval($idKompetencje); //zwraca zamniejsza wartosc gdyby byly powtorzenia (najstarsza wartosc)

//ID Umiejetnosci

    $query = "SELECT kompetencje.ID_Umiejętności FROM kompetencje WHERE kompetencje.ID_Aplikacje = '$idAplikacje';";
    $result = mysqli_query($conn, $query);
    $idumiejetnosci = mysqli_fetch_array($result, MYSQLI_ASSOC)['ID_Umiejętności'];
    $idumiejetnosci = intval($idumiejetnosci); //zwraca zamniejsza wartosc gdyby byly powtorzenia (najstarsza wartosc)

    

    $query = "DELETE FROM kompetencje WHERE ID_Kompetencje = $idKompetencje;";
    $result = mysqli_query($conn, $query);

    $query = "DELETE FROM umiejetnosci WHERE ID_Umiejetnosci  = $idumiejetnosci;";
    $result = mysqli_query($conn, $query);

    $query = "DELETE FROM opis_statusu WHERE ID_Opis_Statusu = $idOpis_statusu;";
    $result = mysqli_query($conn, $query);

    $query = "DELETE FROM etap_rekrutacji WHERE ID_Etap_Rekrutacji = $idEtap_rekrutacji;";
    $result = mysqli_query($conn, $query);

    $query = "DELETE FROM zalacznik WHERE ID_Zalacznik = $idZalacznik;";
    $result = mysqli_query($conn, $query);

    $query = "DELETE FROM aplikacje WHERE ID_Aplikacje = $idAplikacje;";
    $result = mysqli_query($conn, $query);

    

    
    header("Location: ../index.php");
    exit;
}
else {
    $message = "Nie można tego zrobić! nie ma danych :<";
    header("Location: ../applicationsView.php?error=$message");
    exit;
}

?>
<?php

session_start();

require_once "db.php";
require_once "../functions.php";


if (isset($_POST['apply'])) {
    $idKandydat = intval($_SESSION['candidate']['ID_Kandydaci']);
    $idDzial = $_POST['stanowisko'];
    $idStanowisko = $_POST['stanowisko'];
    
    $query = "SELECT dzialy.ID_Dzialy FROM stanowiska INNER JOIN dzialy ON stanowiska.ID_Dzialy = dzialy.ID_Dzialy WHERE stanowiska.Nazwa = '$idDzial';";
    $result = mysqli_query($conn, $query);
    $idDzial = mysqli_fetch_array($result, MYSQLI_ASSOC)['ID_Dzialy'];
    $idDzial = intval($idDzial);


    $idStanowiskoQuery = "SELECT stanowiska.ID_Stanowiska FROM stanowiska where stanowiska.Nazwa = '$idStanowisko' ;";
    $idStanowiskoResult = mysqli_query($conn, $idStanowiskoQuery);
    $idStanowiskoRow = $idStanowiskoResult->fetch_assoc();
    $idStanowisko = intval($idStanowiskoRow['ID_Stanowiska']);

    
    $etapRekrutacji = 1;
    $idHr = 4;

    $name = $_SESSION['candidate']['Imie'];
    $surname = $_SESSION['candidate']['Nazwisko'];
    $umiejetnosci = $_POST['skills'];

    $applicationId = createApplication($conn, $idKandydat, $idDzial, $etapRekrutacji, $idHr, $idStanowisko);

    $skillId = createSkills($conn, $umiejetnosci);
    $idKompetencji = createCompetence($conn, $idKandydat, $skillId, $applicationId);
    $AttachmentID = createAttachment($conn);
    $Phase2 = createPhase2($conn);
    $id_etap_rekrutacji = createPhase($conn, $applicationId, $AttachmentID, $Phase2, $idStanowisko); 
    Update_ID_Etap_rekrutacji ($conn, $id_etap_rekrutacji, $applicationId, $idStanowisko);

    $message = "Aplikacja została złożona";
    header("location: ../applicationsView.php?message=$message");
    exit;
}

    
function createApplication($conn, $idKandydat, $idDzial, $etapRekrutacji, $idHr, $idStanowisko)
{
    $query = "INSERT INTO aplikacje (ID_Kandydaci, ID_Dzialy, ID_Etap_Rekrutacji, ID_Pracownicy, ID_Stanowiska ) VALUES('$idKandydat', '$idDzial', '$etapRekrutacji', '$idHr', '$idStanowisko');";
    $result = mysqli_query($conn, $query);

    // zwraca ostatnie ID jakie baza utworzyła
    return mysqli_insert_id($conn);
}

function createSkills($conn, $umiejetnosci)
{
    $query = "INSERT INTO umiejetnosci(Nazwa) VALUES('$umiejetnosci');";
    $result = mysqli_query($conn, $query);

    return mysqli_insert_id($conn);
}

function createCompetence($conn, $idKandydat, $skillId, $applicationId)
{
    $query = "INSERT INTO kompetencje( ID_Umiejętności, ID_Aplikacje) VALUES('$skillId', '$applicationId');";
    $result = mysqli_query($conn, $query);

    return mysqli_insert_id($conn);
}


function createAttachment($conn)
{
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] == 0) {
        $allowed = array("pdf" => "application/pdf");

        $filename = $_FILES['cv']['name'];
        $filesize = $_FILES['cv']['size'];
        $filetype = $_FILES['cv']['type'];

        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (! array_key_exists($ext, $allowed)) {
            $message = "Niepoprawny format";
            header("Location: ../applicationsView.php?error=$message");
            exit;
        }

        $maxsize = 5 * 1024 * 1024;
        if ($filesize > $maxsize) {
            $message = "Plik za duży";
            header("Location: ../applicationsView.php?error=$message");
            exit;
        }
        if (in_array($filetype, $allowed)) {
            move_uploaded_file($_FILES['cv']['tmp_name'], "../uploads/" . $filename);
        } else {
            $message = "Problem z przesłaniem pliku";
            header("Location: ../applicationsView.php?error=$message");
            exit;
        }
    } else {
        $message = "Wsytąpił błąd";
        header("Location: ../applicationsView.php?error=$message");
        exit;
    }

    $data = date("Y/m/d");

    $query = "INSERT INTO zalacznik(Nazwa, Data) VALUES('$filename', '$data');";
    $result = mysqli_query($conn, $query); 
    return mysqli_insert_id($conn);
}

function createPhase($conn, $applicationId, $AttachmentID, $Phase2, $idStanowisko)
{
    $etap = 1;
    $stan = "Aplikacja przyjęta";
    $data = date("Y/m/d");

    $query = "INSERT INTO etap_rekrutacji (ID_Aplikacje, Etap, Stan, Data, ID_Opis_Statusu, ID_Zalacznik) VALUES('$applicationId', '$etap', '$stan', '$data', '$Phase2','$AttachmentID');";
    mysqli_query($conn, $query);
    return mysqli_insert_id($conn);   
}

function Update_ID_Etap_rekrutacji ($conn, $id_etap_rekrutacji, $applicationId, $idStanowisko)
{
    $currentCandidate = $_SESSION['candidate']['ID_Kandydaci'];
    $query = "UPDATE aplikacje SET ID_Etap_Rekrutacji = '$id_etap_rekrutacji'  WHERE ID_Kandydaci  = '$currentCandidate' and ID_Stanowiska = '$idStanowisko' AND ID_Aplikacje = '$applicationId';";
    mysqli_query($conn, $query);
}

function createPhase2($conn)
{
    $stan = null;
 
    $query = "INSERT INTO opis_statusu (Opis) VALUES('$stan');";
    $result = mysqli_query($conn, $query); 
    return mysqli_insert_id($conn);
}
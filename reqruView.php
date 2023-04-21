<head>
<link rel="stylesheet" type="text/css" href="./views/style.css">
</head>
<?php

session_start();

require_once "./includes/db.php";
require_once "./functions.php";

if($_SESSION['login']['user_type'] == 'asystent')
{
    $id = $_SESSION['login']['ID_Pracownicy'];
$query = <<<EOF
SELECT   e.ID_Etap_Rekrutacji  as 'ID_Etapu', e.ID_Aplikacje  as 'ID_Aplikacji',	e.Etap as 'Etap', e.Stan as 'Stan', e.Data as 'Data', ID_Zalacznik 'ID_Zalacznik', e.ID_Opis_Statusu as 'ID_Opis_Statusu', (select Opis from opis_statusu where e.ID_Opis_Statusu = opis_statusu.ID_Opis_Statusu) as 'opis'
FROM etap_rekrutacji e JOIN aplikacje a 
ON e.ID_Aplikacje = a.ID_Aplikacje
WHERE a.ID_Pracownicy = $id;
EOF;

}elseif($_SESSION['login']['user_type'] == 'pracownikHR'){

    $id = $_SESSION['login']['ID_Pracownicy'];
$query = <<<EOF
SELECT   e.ID_Etap_Rekrutacji  as 'ID_Etapu', e.ID_Aplikacje  as 'ID_Aplikacji',	e.Etap as 'Etap', e.Stan as 'Stan', e.Data as 'Data', ID_Zalacznik 'ID_Zalacznik', e.ID_Opis_Statusu as 'ID_Opis_Statusu', (select Opis from opis_statusu where e.ID_Opis_Statusu = opis_statusu.ID_Opis_Statusu) as 'opis'
FROM etap_rekrutacji e JOIN aplikacje a 
ON e.ID_Aplikacje = a.ID_Aplikacje
WHERE a.ID_Pracownicy = $id;
EOF;

}elseif($_SESSION['login']['user_type'] == 'kierownik'){

    $id = $_SESSION['login']['ID_Pracownicy'];
$query = <<<EOF
SELECT   e.ID_Etap_Rekrutacji  as 'ID_Etapu', e.ID_Aplikacje  as 'ID_Aplikacji',	e.Etap as 'Etap', e.Stan as 'Stan', e.Data as 'Data', ID_Zalacznik 'ID_Zalacznik', e.ID_Opis_Statusu as 'ID_Opis_Statusu', (select Opis from opis_statusu where e.ID_Opis_Statusu = opis_statusu.ID_Opis_Statusu) as 'opis'
FROM etap_rekrutacji e JOIN aplikacje a 
ON e.ID_Aplikacje = a.ID_Aplikacje
WHERE a.ID_Pracownicy = $id;
EOF;

}else{

$query = <<<EOF
SELECT   ID_Etap_Rekrutacji  as 'ID_Etapu', ID_Aplikacje  as 'ID_Aplikacji',	Etap as 'Etap', Stan as 'Stan', Data as 'Data', ID_Zalacznik 'ID_Zalacznik', ID_Opis_Statusu as 'ID_Opis_Statusu', (select Opis from opis_statusu where etap_rekrutacji.ID_Opis_Statusu = opis_statusu.ID_Opis_Statusu) as 'opis'
FROM etap_rekrutacji
EOF;

}


$result = mysqli_query($conn, $query);
$data = $result->fetch_all(MYSQLI_ASSOC);
require_once "views/header.php";
?>

<div class="panelL">
<form action="includes/reqruModify.php" method="POST" enctype="multipart/form-data">
	Zmień stan etapu rekrutacji!
	<br>
    <input type="text" name="etap" placeholder="Etap" required>
	<br>
    <input type="text" name="stan" placeholder="Stan" required>
	<br>
	<input type="text" name="idAplikacji" placeholder="ID Aplikacji" required>
	<br>

	<button name="reqruView" type="submit">Zatwierdź</button>
</form>
</div>

<div class="container" style="margin-top: 3px; padding: 0 3px;">
<table id="info">
    <thead>
        <tr>
            <th>ID Rekrutacji</th>
            <th>ID Aplikacje</th>
            <th>Etap</th>
            <th>Stan</th>
            <th>Data</th>
            <th>ID Załącznik</th>
            <th>ID Opis Statusu</th>
            <th>Opis</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row) { ?>
            <tr>
                <td><?php echo $row['ID_Etapu']; ?></td>
                <td><?php echo $row['ID_Aplikacji']; ?></td>
                <td><?php echo $row['Etap']; ?></td>
                <td><?php echo $row['Stan']; ?></td>
                <td><?php echo $row['Data']; ?></td>
                <td><?php echo $row['ID_Zalacznik']; ?></td>
                <td><?php echo $row['ID_Opis_Statusu']; ?></td>
                <td><?php echo $row['opis']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>

<?php require_once "views/footer.php" ?>
<head>
<link rel="stylesheet" type="text/css" href="/views/style.css">
</head>
<?php

session_start();


require_once "./includes/db.php";
require_once "functions.php";


$query = <<<EOF
SELECT  p.ID_Pracownicy as 'ID' ,p.Imie as 'Name', p.Nazwisko as 'Surname', p.email as 'Email', p.ID_Kierownicy as 'kierownicy', p.ID_Dzialy as 'dzialy', p.user_type as 'user_type'
FROM pracownicy p
EOF;

$result = mysqli_query($conn, $query);
$data = $result->fetch_all(MYSQLI_ASSOC);

require_once "views/header.php";
?>

<div class="panelL">
<?php
$query = "SELECT * FROM stanowiska";
$result = mysqli_query($conn, $query);
$stanowiska = $result->fetch_all(MYSQLI_ASSOC);
?>
<form action="includes/removeApply.php" method="POST" enctype="multipart/form-data">
	Stanowisko
	<select name="stanowisko" required>
		<?php foreach ($stanowiska as $stanowisko): ?>
			<option>
				<?= $stanowisko['Nazwa'] ?>
			</option>
		<?php endforeach; ?>
	</select>
	<br>

    <input type="text" name="email" placeholder="email kandydata" required>
	<br>

	<button name="removeApply" type="submit">Usuń</button>
</form>
</div>

<div  class="panelR">

<form action="includes/updateCandidate.php" method="POST" enctype="multipart/form-data">
	Stanowisko
	<select name="stanowisko" required>
		<?php foreach ($stanowiska as $stanowisko): ?>
			<option>
				<?= $stanowisko['Nazwa'] ?>
			</option>
		<?php endforeach; ?>
	</select>
	<br>

    Zmień
    <select name="co_zmieniamy" required>
			<option value="1">Email</option>
            <option value="2">Pracownika przyjmującego</option>
            <option value="3">Kompetencje</option>
            <option value="4">Opis do statusu</option>
	</select>
    <br>

    <input type="text" name="email" placeholder="email kandydata" required>
	<br>
    <input type="text" name="wartosc" placeholder="wartosc na ktora zmieniamy" required>
	<br>

	<button name="updateCandidate" type="submit">Zmień</button>
</form>
</div>

<div class="panelR">

<form action="includes/registerWorker.php" method="POST" enctype="multipart/form-data">
	
Utwórz nowego pracownika!
<br>

    <input type="text" name="email" placeholder="email kandydata" required>
	<br>
    <input type="text" name="imie" placeholder="imie" required>
	<br>
    <input type="text" name="nazwisko" placeholder="nazwisko" required>
	<br>
    <input type="text" name="haslo" placeholder="haslo" required>
	<br>
    <select name="user_type" required>
			<option value="admin">Admin</option>
            <option value="kierownikHR">KierownikHR</option>
            <option value="kierownik">Kierownik</option>
            <option value="pracownikHR">PracownikHR</option>
            <option value="pracownik">Pracownik</option>
            <option value="asystent">Asystent</option>
	</select>
    <br>

	<button name="registerWorker" type="submit">Utwórz</button>
</form>
</div>

<div class="panelR" >
Ustal ID Kierownika i ID Działu dla pracownika

<form action="includes/updateWorker.php" method="POST" enctype="multipart/form-data">

    <input type="text" name="email" placeholder="email kandydata" required>
	<br>
    <input type="text" name="idKierownika" placeholder="ID Kierownika" required>
	<br>
    <input type="text" name="idDzialu" placeholder="ID Działu" required>
	<br>
   

	<button name="updateWorker" type="submit">Ustaw</button>
</form>
</div>

<div class="panelR">
Zmień dane pracownika!

<form action="includes/updateWorkerSecrets.php" method="POST" enctype="multipart/form-data">

    <input type="text" name="email" placeholder="email pracownika" required>
	<br>
    <input type="text" name="wartosc" placeholder="wartość" required>
	<br>
    <select name="wybor" required>
            <option value="imie">Imię</option>
            <option value="nazwisko">Nazwisko</option>
			<option value="email">Email</option>
            <option value="idKierownika">ID Kierownika</option>
            <option value="idDzialu">ID Działu</option>
            <option value="user_type">User type</option>
	</select>
    <br>

	<button name="updateWorkerSecrets" type="submit">Zmień</button>
</form>
</div>


<div class="container">
<table id="info">
    <thead>
        <tr>
            <th>ID</th>
            <th>Imię Pracownika</th>
            <th>Nazwisko Pracownika</th>
            <th>Email Pracownika</th>
            <th>ID Kierownika</th>
            <th>ID Działu</th>
            <th>User Type</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row) { ?>
            <tr>
                <td><?php echo $row['ID']; ?></td>
                <td><?php echo $row['Name']; ?></td>
                <td><?php echo $row['Surname']; ?></td>
                <td><?php echo $row['Email'];?></td>
                <td><?php echo $row['kierownicy']; ?></td>
                <td><?php echo $row['dzialy']; ?></td>
                <td><?php echo $row['user_type']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

	
</div>
<?php require_once "views/footer.php" ?>

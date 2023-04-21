<head>
<link rel="stylesheet" type="text/css" href="./views/style.css">
</head>
<?php

session_start();


require_once "./includes/db.php";
require_once "functions.php";

$query = <<<EOF
SELECT  k.Imie as 'candidateName', k.Nazwisko as 'candidateSurname', k.Nazwa_Uzytkownika as 'candidateEmail', p.Imie as 
	'HrName', p.email as 'HrEmail', d.Nazwa as 'departmentName', s.Nazwa as 'positionName', u.Nazwa as 'competence', o.Opis as 'add'
	FROM aplikacje a
	INNER JOIN kandydaci k
	ON k.ID_Kandydaci = a.ID_Kandydaci
	INNER JOIN pracownicy p 
	ON p.ID_Pracownicy = a.ID_Pracownicy
	INNER JOIN dzialy d
	ON d.ID_Dzialy  = a.ID_Dzialy
	INNER JOIN stanowiska s
	ON d.ID_Dzialy = s.ID_Dzialy
    INNER JOIN kompetencje kk
    ON a.ID_Aplikacje = kk.ID_Aplikacje
    INNER JOIN umiejetnosci u
    ON kk.ID_Umiejętności = u.ID_Umiejetnosci
    INNER JOIN etap_rekrutacji e
	ON a.ID_Aplikacje = e.ID_Aplikacje
	INNER JOIN opis_statusu o
	ON e.ID_Opis_Statusu = o.ID_Opis_Statusu;
EOF;

$result = mysqli_query($conn, $query);
$data = $result->fetch_all(MYSQLI_ASSOC);

require_once "views/header.php";
?>

<div>
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

<div>

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
    <input type="text" name="wartosc" placeholder="wartosc na ktora" required>
	<br>

	<button name="updateCandidate" type="submit">Zmień</button>
</form>
</div>


<div class="container" style="margin-top: 3px; padding: 0 3px;">
<table id="info">
    <thead>
        <tr>
            <th>Imię kandydata</th>
            <th>Nazwisko kandydata</th>
            <th>Email kandydata</th>
            <th>Imię kierownika HR</th>
            <th>Email kierownika HR</th>
            <th>Nazwa działu</th>
            <th>Nazwa stanowiska</th>
            <th>Kompetencje</th>
            <th>Opis</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row) { ?>
            <tr>
                <td><?php echo $row['candidateName']; ?></td>
                <td><?php echo $row['candidateSurname']; ?></td>
                <td><?php echo $row['candidateEmail']; $email=$row['candidateEmail'];?></td>
                <td><?php echo $row['HrName']; ?></td>
                <td><?php echo $row['HrEmail']; ?></td>
                <td><?php echo $row['departmentName']; ?></td>
                <td><?php echo $row['positionName']; ?></td>
                <td><?php echo $row['competence']; ?></td>
                <td><?php echo $row['add']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

	
</div>

<?php require_once "views/footer.php" ?>

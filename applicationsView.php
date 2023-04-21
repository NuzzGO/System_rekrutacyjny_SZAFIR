<?php

session_start();

require_once "./includes/db.php";

$query = "SELECT * FROM stanowiska";
$result = mysqli_query($conn, $query);
$stanowiska = $result->fetch_all(MYSQLI_ASSOC);
?>

<?php include_once "views/header.php"; ?>

<h1>Złóż aplikacje</h1>

<?php if (isset($_GET['message'])): ?>
	<div>
		<strong>
			<?= $_GET['message']; ?>
		</strong>
	</div>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
	<div>
		<strong>
			<?= $_GET['error']; ?>
		</strong>
	</div>
<?php endif; ?>

<form action="includes/apply.php" method="POST" enctype="multipart/form-data">
	Stanowisko
	<select name="stanowisko" required>
		<?php foreach ($stanowiska as $stanowisko): ?>
			<option>
				<?= $stanowisko['Nazwa'] ?>
			</option>
		<?php endforeach; ?>
	</select>
	<br>

	Umiejętności (wpisz po przecinku)
	<input type="text" name="skills" placeholder="gotowanie, jazda rowerem, ..." required>
	<br>

	CV:
	<input type="file" name="cv" required>
	<br>

	<button name="apply" type="submit">Zaaplikuj</button>
</form>

<!-- wyświetlanie aktualnieych złożonye aplikacje -->
<?php 
if(isset($_SESSION['candidate']['ID_Kandydaci'])){
	$ID_uzytkownika = $_SESSION['candidate']['ID_Kandydaci'];
$query = <<<EOF
SELECT a.ID_Aplikacje  as 'id', k.Imie as 'candidateName', k.Nazwisko as 'candidateSurname', k.Nazwa_Uzytkownika as 'candidateEmail', p.Imie as 
'HrName', p.email as 'HrEmail', d.Nazwa as 'departmentName', s.Nazwa as 'positionName', o.Opis as 'add'
FROM aplikacje a
INNER JOIN kandydaci k
ON k.ID_Kandydaci = a.ID_Kandydaci
INNER JOIN pracownicy p 
ON p.ID_Pracownicy = a.ID_Pracownicy
INNER JOIN dzialy d
ON d.ID_Dzialy  = a.ID_Dzialy
INNER JOIN stanowiska s
ON d.ID_Dzialy = s.ID_Dzialy
INNER JOIN etap_rekrutacji e
ON a.ID_Aplikacje = e.ID_Aplikacje
INNER JOIN opis_statusu o
ON e.ID_Opis_Statusu = o.ID_Opis_Statusu
WHERE a.ID_Kandydaci = $ID_uzytkownika;
EOF;

}elseif($_SESSION['login']['user_type'] == 'pracownik'){


$ID_uzytkownika = $_SESSION['login']['ID_Pracownicy'];
$query = <<<EOF
SELECT a.ID_Aplikacje  as 'id', k.Imie as 'candidateName', k.Nazwisko as 'candidateSurname', k.Nazwa_Uzytkownika as 'candidateEmail', p.Imie as 
'HrName', p.email as 'HrEmail', d.Nazwa as 'departmentName', s.Nazwa as 'positionName', o.Opis as 'add'
FROM aplikacje a
INNER JOIN kandydaci k
ON k.ID_Kandydaci = a.ID_Kandydaci
INNER JOIN pracownicy p 
ON p.ID_Pracownicy = a.ID_Pracownicy
INNER JOIN dzialy d
ON d.ID_Dzialy  = a.ID_Dzialy
INNER JOIN stanowiska s
ON d.ID_Dzialy = s.ID_Dzialy
INNER JOIN etap_rekrutacji e
ON a.ID_Aplikacje = e.ID_Aplikacje
INNER JOIN opis_statusu o
ON e.ID_Opis_Statusu = o.ID_Opis_Statusu
WHERE a.ID_Kandydaci = $ID_uzytkownika;
EOF;
	
}elseif($_SESSION['login']['user_type'] == 'asystent'){
	$id = $_SESSION['login']['ID_Pracownicy'];
$query = <<<EOF
SELECT a.ID_Aplikacje  as 'id', k.Imie as 'candidateName', k.Nazwisko as 'candidateSurname', k.Nazwa_Uzytkownika as 'candidateEmail', p.Imie as 
'HrName', p.email as 'HrEmail', d.Nazwa as 'departmentName', s.Nazwa as 'positionName', o.Opis as 'add'
FROM aplikacje a
INNER JOIN kandydaci k
ON k.ID_Kandydaci = a.ID_Kandydaci
INNER JOIN pracownicy p 
ON p.ID_Pracownicy = a.ID_Pracownicy
INNER JOIN dzialy d
ON d.ID_Dzialy  = a.ID_Dzialy
INNER JOIN stanowiska s
ON d.ID_Dzialy = s.ID_Dzialy
INNER JOIN etap_rekrutacji e
ON a.ID_Aplikacje = e.ID_Aplikacje
INNER JOIN opis_statusu o
ON e.ID_Opis_Statusu = o.ID_Opis_Statusu
WHERE a.ID_Pracownicy = $id;
EOF;

}elseif($_SESSION['login']['user_type'] == 'pracownikHR'){
	$id = $_SESSION['login']['ID_Pracownicy'];
$query = <<<EOF
SELECT a.ID_Aplikacje  as 'id', k.Imie as 'candidateName', k.Nazwisko as 'candidateSurname', k.Nazwa_Uzytkownika as 'candidateEmail', p.Imie as 
'HrName', p.email as 'HrEmail', d.Nazwa as 'departmentName', s.Nazwa as 'positionName', o.Opis as 'add'
FROM aplikacje a
INNER JOIN kandydaci k
ON k.ID_Kandydaci = a.ID_Kandydaci
INNER JOIN pracownicy p 
ON p.ID_Pracownicy = a.ID_Pracownicy
INNER JOIN dzialy d
ON d.ID_Dzialy  = a.ID_Dzialy
INNER JOIN stanowiska s
ON d.ID_Dzialy = s.ID_Dzialy
INNER JOIN etap_rekrutacji e
ON a.ID_Aplikacje = e.ID_Aplikacje
INNER JOIN opis_statusu o
ON e.ID_Opis_Statusu = o.ID_Opis_Statusu
WHERE a.ID_Pracownicy = $id;
EOF;

}elseif($_SESSION['login']['user_type'] == 'kierownik'){
	$id = $_SESSION['login']['ID_Pracownicy'];
$query = <<<EOF
SELECT a.ID_Aplikacje  as 'id', k.Imie as 'candidateName', k.Nazwisko as 'candidateSurname', k.Nazwa_Uzytkownika as 'candidateEmail', p.Imie as 
'HrName', p.email as 'HrEmail', d.Nazwa as 'departmentName', s.Nazwa as 'positionName', o.Opis as 'add'
FROM aplikacje a
INNER JOIN kandydaci k
ON k.ID_Kandydaci = a.ID_Kandydaci
INNER JOIN pracownicy p 
ON p.ID_Pracownicy = a.ID_Pracownicy
INNER JOIN dzialy d
ON d.ID_Dzialy  = a.ID_Dzialy
INNER JOIN stanowiska s
ON d.ID_Dzialy = s.ID_Dzialy
INNER JOIN etap_rekrutacji e
ON a.ID_Aplikacje = e.ID_Aplikacje
INNER JOIN opis_statusu o
ON e.ID_Opis_Statusu = o.ID_Opis_Statusu
WHERE a.ID_Pracownicy = $id;
EOF;


}else{

$query = <<<EOF
SELECT a.ID_Aplikacje  as 'id', k.Imie as 'candidateName', k.Nazwisko as 'candidateSurname', k.Nazwa_Uzytkownika as 'candidateEmail', p.Imie as 
'HrName', p.email as 'HrEmail', d.Nazwa as 'departmentName', s.Nazwa as 'positionName', o.Opis as 'add'
FROM aplikacje a
INNER JOIN kandydaci k
ON k.ID_Kandydaci = a.ID_Kandydaci
INNER JOIN pracownicy p 
ON p.ID_Pracownicy = a.ID_Pracownicy
INNER JOIN dzialy d
ON d.ID_Dzialy  = a.ID_Dzialy
INNER JOIN stanowiska s
ON d.ID_Dzialy = s.ID_Dzialy
INNER JOIN etap_rekrutacji e
ON a.ID_Aplikacje = e.ID_Aplikacje
INNER JOIN opis_statusu o
ON e.ID_Opis_Statusu = o.ID_Opis_Statusu
EOF;
}


$result = mysqli_query($conn, $query);
$data = $result->fetch_all(MYSQLI_ASSOC);

require_once "views/header.php";
?>

<div class="container" style="margin-top: 3px; padding: 0 3px;">
<table id="info">
    <thead>
        <tr>
			<th>ID Apliakcji</th>
            <th>Imię kandydata</th>
            <th>Nazwisko kandydata</th>
            <th>Email kandydata</th>
            <th>Imię kierownika HR</th>
            <th>Email kierownika HR</th>
            <th>Nazwa działu</th>
            <th>Nazwa stanowiska</th>
			<th>Opis</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row) { ?>
            <tr>
				<td><?php echo $row['id']; ?></td>
                <td><?php echo $row['candidateName']; ?></td>
                <td><?php echo $row['candidateSurname']; ?></td>
                <td><?php echo $row['candidateEmail']; ?></td>
                <td><?php echo $row['HrName']; ?></td>
                <td><?php echo $row['HrEmail']; ?></td>
                <td><?php echo $row['departmentName']; ?></td>
                <td><?php echo $row['positionName']; ?></td>
				<td><?php echo $row['add']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

	
</div>



<?php include_once "views/footer.php" ?>

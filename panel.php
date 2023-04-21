<head>
<link rel="stylesheet" type="text/css" href="/views/style.css">
</head>
<?php

session_start();


require_once "./includes/db.php";
require_once "functions.php";


$query = <<<EOF
SELECT  k.ID_Kandydaci as 'ID' ,k.Imie as 'Name', k.Nazwisko as 'Surname', k.Nazwa_Uzytkownika as 'Email'
FROM kandydaci k
EOF;

$result = mysqli_query($conn, $query);
$data = $result->fetch_all(MYSQLI_ASSOC);

$query = "SELECT * FROM stanowiska";
$result = mysqli_query($conn, $query);
$stanowiska = $result->fetch_all(MYSQLI_ASSOC);

require_once "views/header.php";
?>

<div class="panelL">

<form action="includes/panelModify.php" method="POST" enctype="multipart/form-data">
	Usuwanie konta kandydata
    <br>
    <input type="text" name="id" placeholder="ID kandydata" required>
	<br>

	<button name="remove" type="submit">Usuń</button>
</form>

</div>

<div class="panelR">

<form action="includes/panelModify.php" method="POST" enctype="multipart/form-data">
	Dodawanie konta kandydata
    <br>
    <?php
		if (isset($_GET['error'])) {
			echo "<h1>" . $_GET['error'] . "</h1>";
		};
		?>
		<input type="text" name="name" required placeholder="Wprowadź imię">
        <br>
		<input type="text" name="surname" required placeholder="Wprowadź nazwisko">
        <br>
		<input type="email" name="email" required placeholder="Wprowadź e-mail">
        <br>
		<input type="password" name="password" required placeholder="Wprowadź hasło">
        <br>

	<button name="add" type="submit">Dodaj</button>
</form>

</div>


<div class="container">
<table id="info">
    <thead>
        <tr>
            <th>ID</th>
            <th>Imię kandydata</th>
            <th>Nazwisko kandydata</th>
            <th>Email kandydata</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row) { ?>
            <tr>
                <td><?php echo $row['ID']; ?></td>
                <td><?php echo $row['Name']; ?></td>
                <td><?php echo $row['Surname']; ?></td>
                <td><?php echo $row['Email'];?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

	
</div>
<?php require_once "views/footer.php" ?>

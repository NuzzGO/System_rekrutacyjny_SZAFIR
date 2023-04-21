<head>
<link rel="stylesheet" type="text/css" href="./views/style.css">
</head>
<?php

session_start();

require_once "./includes/db.php";
require_once "./functions.php";

$query = <<<EOF
SELECT   ID_Dzialy as 'id_dzialy', Nazwa as 'nazwa',	ID_Kierownicy as 'id_kierownicy' 
FROM dzialy
EOF;

$result = mysqli_query($conn, $query);
$data = $result->fetch_all(MYSQLI_ASSOC);
require_once "views/header.php";
?>

<form action="includes/modifyDzialy.php" method="POST" enctype="multipart/form-data">
	Dodaj/Usuń dział!
	<select name="wybor" required>
            <option value="+">Dodaj</option>
            <option value="-">Usuń</option>
	</select>
	<br>
	<input type="text" name="nazwa" placeholder="Nazwa działu" required>
	<br>
    <input type="text" name="idKierownika" placeholder="ID Kierownika" required>
	<br>

	<button name="modifyDzialy" type="submit">Zatwierdź</button>
</form>


<div class="container" style="margin-top: 3px; padding: 0 3px;">
<table id="info">
    <thead>
        <tr>
            <th>ID Działu</th>
            <th>Nazwa Działu</th>
            <th>ID Kierownika</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row) { ?>
            <tr>
                <td><?php echo $row['id_dzialy']; ?></td>
                <td><?php echo $row['nazwa']; ?></td>
                <td><?php echo $row['id_kierownicy']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>

<?php require_once "views/footer.php" ?>
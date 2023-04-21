<head>
	<link rel="stylesheet" type="text/css" href="/views/style.css">
</head>
<?php session_start(); ?>

<?php include_once "functions.php"; ?>
<?php include_once "views/header.php"; ?>
<!--	-->
<?php if (isset($_SESSION['login'])): ?>
	<!--	zalogowany -->
	<h1>Username: <?php echo $_SESSION['login']['Imie']; ?></h1>

	<!-- Sesja Admina -->
	<?php $username = $_SESSION['login']['user_type'];
	if ($username == "admin") 
	{
		echo "<p>Jestem adminem</p>";
	} ?>

	

<?php endif; ?>



<!-- Sesja Kandydata-->
<?php if (isset($_SESSION['candidate'])): ?>
	<h1>Username: <?php echo $_SESSION['candidate']['Imie']; ?></h1>

	<form action="includes/statusCandidate.php" method="POST" enctype="multipart/form-data">
	<b>Sprawdź stan aplikacji</b>
	<br>
	<input type="number" name="id" placeholder="Podaj ID aplikacji" required>
	<br>

	<button name="sprawdz" type="submit">SPRAWDŹ</button>
	</form>
	<?php 
	$stan =  $_SESSION['candidate']['etap']; 
	?>


<table id="glowna">
<tr>
    <td class="<?php echo $stan != 1 ? 'active' : ''; ?>">1</td>
    <td class="<?php echo $stan != 1 ? 'active' : ''; ?>">Rejestracja</td>
</tr>

<tr>
  <td class="<?php echo $stan != 2  ? 'active' : ''; ?>">2</td>
  <td class="<?php echo $stan != 2 ? 'active' : ''; ?>">Selekcja kandydatów</td>
</tr>

<tr>
<td class="<?php echo $stan != 3 ? 'active' : ''; ?>">3</td>
  <td class="<?php echo $stan != 3 ? 'active' : ''; ?>">Rozmowa telefoniczna/kwalifikacyjna</td>
</tr>

<tr>
    <td class="<?php echo $stan != 4 ? 'active' : ''; ?>">4</td>
    <td class="<?php echo $stan != 4 ? 'active' : ''; ?>">Badanie lekarskie z orzeczeniem zdolności do pracy</td>
</tr>

<tr>
    <td class="<?php echo $stan != 5 ? 'active' : ''; ?>">5</td>
    <td class="<?php echo $stan != 5 ? 'active' : ''; ?>">Badania psychologiczne</td>
</tr>

<tr>
    <td class="<?php echo $stan != 6 ? 'active' : ''; ?>">6</td>
    <td class="<?php echo $stan != 6 ? 'active' : ''; ?>">Spotkanie z możliwością podpisania umowy</td>
</tr>

<tr>
    <td class="<?php echo $stan != 7 ? 'active' : ''; ?>">7</td>
    <td class="<?php echo $stan != 7 ? 'active' : ''; ?>">Przyjęty</td>
</tr>
</table>

<?php endif; ?>

<?php include_once "views/footer.php"; ?>

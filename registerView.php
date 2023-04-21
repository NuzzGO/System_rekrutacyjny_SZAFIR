<?php

include_once "views/header.php"
?>

<div class="form-container">
	<form action="includes/register.php" method="post">
		<h3>Zarejestruj się!</h3>
		<?php
		if (isset($_GET['error'])) {
			echo "<h1>" . $_GET['error'] . "</h1>";
		};
		?>
		<input type="text" name="name" required placeholder="Wprowadź imię">
		<input type="text" name="surname" required placeholder="Wprowadź nazwisko">
		<input type="email" name="email" required placeholder="Wprowadź e-mail">
		<input type="password" name="password" required placeholder="Wprowadź hasło">

		<input type="submit" name="register" value="Zarejestruj" class="form-btn">

		<p>Masz już konto? <a href="loginView.php">Zaloguj się teraz</a></p>
	</form>
</div>

<?php include_once "views/footer.php"; ?>

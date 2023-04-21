<?php

include_once "views/header.php"
?>

<style>
	* {
		margin: 0;
		padding: 0;
		box-sizing: border-box;
	}

	.column {
		float: left;
		width: 50%;
		padding: 10px;
	}

	.row:after {
		content: "";
		display: table;
		clear: both;
	}

	h2 {
		margin-bottom: 15px;
	}
</style>

<div class="form-container">
	<div class="row">
		<div class="column">
			<h2>Logowanie dla pracownika</h2>
			<form action="includes/login.php" method="post">
				<h3>Zaloguj się!</h3>
				<?php
				if (isset($_GET['error-p'])) {
					echo "<h1>" . $_GET['error'] . "</h1>";
				};
				?>
				<input type="email" name="email" placeholder="Wprowadź e-mail">
				<input type="password" name="password" placeholder="Wprowadź hasło">

				<input type="submit" name="login" value="Zaloguj" class="form-btn">
			</form>
		</div>

		<div class="column">
			<h2>Logowanie dla kandydata</h2>
			<form action="includes/login-candidate.php" method="post">
				<h3>Zaloguj się!</h3>
				<?php
				if (isset($_GET['error-k'])) {
					echo "<h1>" . $_GET['error-k'] .  "</h1>";
				};
				?>
				<input type="email" name="email"  placeholder="Wprowadź e-mail">
				<input type="password" name="password"  placeholder="Wprowadź hasło">

				<input type="submit" name="login-candidate" value="Zaloguj" class="form-btn">
			</form>
		</div>
	</div>
</div>

<?php include_once "views/footer.php"; ?>

<?php

include 'config.php';
session_start();

if (isset($_POST['Zatwierdz'])) {
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pass = md5($_POST['password']);
	$cpass = md5($_POST['cpassword']);
	$user_type = $_POST['user_type'];

	$select = "SELECT * from uzytkownicy where email = '$email' && password = '$pass' ";

	$result = mysqli_query($conn, $select);

	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		unset($row['password']);

		$_SESSION['login'] = $row;
		header('location:../index.php');
	} else {
		$error[] = 'Niepoprawny e-mail lub hasło';
	}
};
?>


<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Logowanie formularz</title>
	<!-- css file -->
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<?php include_once "../views/layout/header.php"; ?>
	<div class="form-container">

		<form action="" method="post">
			<h3>Zaloguj się!</h3>
			<?php
			if (isset($error)) {
				foreach ($error as $error) {
					echo '<span class="error-msg">' . $error . '</span>';
				}
			};
			?>
			<input type="email" name="email" required placeholder="Wprowadź e-mail">
			<input type="password" name="password" required placeholder="Wprowadź hasło">

			<input type="submit" name="Zatwierdz" value="Zaloguj" class="form-btn">
			<p>nie masz jeszcze konta? <a href="register_form.php">Zarejestruj się</a></p>

		</form>

	</div>

</body>
</html>
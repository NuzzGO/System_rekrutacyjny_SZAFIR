<?php

include 'config.php';

if (isset($_POST['Zatwierdz'])) {
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pass = md5($_POST['password']);
	$cpass = md5($_POST['cpassword']);
	$user_type = $_POST['user_type'];

	$select = "SELECT * from uzytkownicy where email = 'email' && password = 'pass' ";

	$result = mysqli_query($conn, $select);

	if (mysqli_num_rows($result) > 0) {
		$error[] = 'Kandydat już istnieje';
	} else {
		if ($pass != $cpass) {
			$error[] = 'hasła nie pasują!';
		} else {
			$insert = "INSERT INTO uzytkownicy(name, email, password, user_type) values('$name','$email','$pass','$user_type')";
			mysqli_query($conn, $insert);
			header('location:login_form.php');
		}
	}
};
?>

<?php include_once "../views/layout/header.php"; ?>

<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Rejetracja formularz</title>
	<!-- css file -->
	<link rel="stylesheet" href="css/style.css">
</head>
<body>

	<div class="form-container">

		<form action="" method="post">
			<h3>Zarejestruj się!</h3>
			<?php
			if (isset($error)) {
				foreach ($error as $error) {
					echo '<span class="error-msg">' . $error . '</span>';
				};
			};
			?>
			<input type="text" name="name" required placeholder="Wprowadź imię">
			<input type="email" name="email" required placeholder="Wprowadź e-mail">
			<input type="password" name="password" required placeholder="Wprowadź hasło">
			<input type="password" name="cpassword" required placeholder="Potwierdź hasło">

			<select name="user_type">
				<option value="user">Kandydat</option>
			</select>
			<input type="submit" name="Zatwierdz" value="Zarejestruj" class="form-btn">
			<p>masz już konto? <a href="login_form.php">Zaloguj się teraz</a></p>

		</form>

	</div>

</body>
</html>
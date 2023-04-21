<?php include_once "functions.php" ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="./views/style.css">
</head>
<body>
	<nav style="background-color: deepskyblue; width: 100vw; padding: 10px 15px;">
		<ul style="display: flex; gap: 10px; list-style: none; font-size: 20px;">
			<li>
				<a href="index.php" style="margin-right: 15px;">Strona główna</a>
			</li>

			<?php if (! isLogin()): ?>
				<li>
					<a href="loginView.php">Zaloguj</a>
				</li>
				<li>
					<a href="registerView.php">Rejestracja kandydata</a>
				</li>
			<?php endif; ?>

			<?php if (isAdmin()): ?>
				<li>
					<a href="showApplications.php">Pokaż aplikacje</a>
				</li>
				<li>
					<a href="panelAdmin.php">Panel Admina</a>
				</li>
				<li>
					<a href="panel.php">Panel</a>
				</li>
				<li>
					<a href="dzialyView.php">Panel Dzialu</a>
				</li>
				<li>
					<a href="reqruView.php">Panel Etapu rekrutacji</a>
				</li>
				<li>
					<a href="panelAsyst.php">Panel Asystenta</a>
				</li>
				
				
			<?php endif; ?>

			<?php if (isKierownikHR()): ?>
				<li>
					<a href="applicationsView.php">Aplikacje</a>
				</li>
				<li>
					<a href="panelAdmin.php">Panel Admina</a>
				</li>
				<li>
					<a href="panel.php">Panel</a>
				</li>
				<li>
					<a href="dzialyView.php">Panel Dzialu</a>
				</li>
				<li>
					<a href="reqruView.php">Panel Etapu rekrutacji</a>
				</li>
			<?php endif; ?>

			<?php if (isKierownik()): ?>
				<li>
					<a href="applicationsView.php">Aplikacje</a>
				</li>
				<li>
					<a href="dzialyView.php">Panel Dzialu</a>
				</li>
				<li>
					<a href="reqruView.php">Panel Etapu rekrutacji</a>
				</li>
			<?php endif; ?>

			<?php if (isPracownikHR()): ?>
				<li>
					<a href="applicationsView.php">Aplikacje</a>
				</li>
				<li>
					<a href="reqruView.php">Panel Etapu rekrutacji</a>
				</li>
			<?php endif; ?>

			<?php if (isPracownik()): ?>
				<li>
					<a href="applicationsView.php">Aplikacje</a>
				</li>
			<?php endif; ?>

			<?php if (isAsystent()): ?>
				<li>
					<a href="applicationsView.php">Aplikacje</a>
				</li>
				<li>
					<a href="reqruView.php">Panel Etapu rekrutacji</a>
				</li>
			<?php endif; ?>

			<?php if (isCandidate()): ?>
				<li>
					<a href="applicationsView.php">Aplikacje</a>
				</li>
			<?php endif; ?>


			<?php if (isset($_SESSION['login']) || isset($_SESSION['candidate'])): ?>
				<li>
					<form action="includes/logout.php" method="post">
						<button type="submit" style="padding: 5px; background-color: white; border: 1px
					solid #bbb; cursor: pointer;">Wyloguj
						</button>
					</form>
				</li>
			<?php endif; ?>
		</ul>
	</nav>

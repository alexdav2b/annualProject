<! DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8"/>
		<title> <?= $title ?> </title>
		<link rel = "icon" href = "../images/logo.png">
		<link href = "../css/style.css" rel = "stylesheet">
		<link href = "../css/bootstrap.min.css" rel = "stylesheet"> 

		
		<!-- <link href = "../public/css/style.css" rel = "stylesheet">
		<link href = "../public/css/bootstrap.min.css" rel = "stylesheet">  -->

	</head>
	<body >
		<?php require_once __DIR__ . '/headerView.php'; ?>

			<main class = 'container-fluid' id = 'content'>
				<div id = "content-container" class = "row">
					<?= $content ?>
				</div>
			</main>

		<?php require_once __DIR__ . '/footerView.php'; ?>
	</body>
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js" ></script>
	<script src = '../js/bootstrap.min.js' ></script>
	<script src = <?= $script ?>></script>
</html>
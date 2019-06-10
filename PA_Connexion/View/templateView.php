<! DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8"/>
		<title> <?= $title ?> </title>
		<link href = "../public/css/style.css" rel = "stylesheet">
		<!-- Bootstrap CSS -->
		<link href = "../public/css/bootstrap.min.css" rel = "stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src = '../public/js/bootstrap.min.js' ></script>
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
</html>
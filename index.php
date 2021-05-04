<?php
if(isset($_FILES["zip"])) {
	$errors = array();
	$file_name = $_FILES["zip"]["name"];
	$file_size = $_FILES["zip"]["size"];
	$file_tmp = $_FILES["zip"]["tmp_name"];
	$file_type = $_FILES["zip"]["type"];
	$file_ext = strtolower(end(explode('.',	$file_name = $_FILES["zip"]["name"])));

	$expentions = array("zip", "rar", "7z");

	if($file_size > 838860800) {
		$errors[] = "Файл должен быть не более 100 Мб";
	}
	if(empty($errors) == true) {
		move_uploaded_file($file_tmp, "files/".$file_name);
		echo "Success!";
		$fp = fopen("files/meta_$file_name.txt", 'w+');
		fwrite($fp, "
			Фамилия, Имя: $_POST['name']
			Класс: $_POST['grade']
			Научный руководитель: $_POST['teacher']
			Тема работы: $_POST['topic']
		");
		fclose($fp);
	}
	else {
		print $errors;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Библиотека СПГ</title>
	<link rel="stylesheet" href="libs/bootstrap/dist/css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="css/main.css">
	<script src="js/libs.min.js"></script>
</head>
<body>
	<header class="head">

				<ul class="top-nav">
					<li><a href="">Главная</a></li>
					<li><a href="#str">СТР</a></li>
				</ul>
				
				<h1 class="head__name">Библиотека СПГ</h1>

	</header>

	<main class="content">
		
		<div id="str">
			<h1>СТР</h1>
			<form action="" name="uploader" method="POST" enctype="multipart/form-data">
				<p>Фамилия, Имя: </p><input name="name" type="text" required="required">
				<p>Класс: </p><input name="grade" type="text" required="required">
				<p>Научный руководитель</p><input name="teacher" type="text" required="required">
				<p>Тема работы</p><input type="text" name="topic" required="required">
				<p>Файлы (прикреплять архивом)</p>
				<!-- <button id="load" type="submit">Загрузить</button> -->
				<input type="file" name="zip"><br>
				<input type="submit">
			</form>
		</div>

	</main>


<script src="js/common.js"></script>
</body>
</html>

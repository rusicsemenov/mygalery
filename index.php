
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Test page</title>
	<link href="/css/main.css" media="screen, projection" rel="stylesheet" type="text/css" /> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<video autoplay="true" loop="loop">
		<source src="1.mp4" type="video/mp4">
		<!-- <source src="2.mp4" type="video/mp4"> -->
		<!-- <source src="3.mp4" type="video/mp4"> -->
		<!-- <source src="3.webm" type="video/webm"> -->
	</video>

	<div class="header">
		<p class='logo'>
		 	Photo Gallery
		<p>тестовая станица</p>
		<div class='img_big'>
			<span class="img_prev"></span>
			<img src="http://test/img/photo/1.jpg" alt="" id="test">
			<span class="img_next"></span>
		</div>
	</div>

	<div class="photo">

		<div class="item item_active">
			<div class="cover" style="background-image: url('/img/photo/1.jpg')"></div>
			<div class="alert">
				<i>!</i>
				<p>Lorem ipsum.</p>
			</div>
		</div>
		<div class="item">
			<div class="cover" style="background-image: url('/img/photo/2.jpg')"></div>
			<div class="alert">
				<i>!</i>
				<p>Dignissimos, est.</p>
			</div>
		</div>
		<div class="item">
			<div class="cover" style="background-image: url('/img/photo/3.jpg')"></div>
			<div class="alert">
				<i>!</i>
				<p>Fugiat, doloremque.</p>
			</div>
		</div>
		<div class="item">
			<div class="cover" style="background-image: url('/img/photo/4.jpg')"></div>
			<div class="alert">
				<i>!</i>
				<p>Blanditiis, explicabo.</p>
			</div>
		</div>
		<div class="item">
			<div class="cover" style="background-image: url('/img/photo/5.jpg')"></div>
			<div class="alert">
				<i>!</i>
				<p>Enim, numquam!</p>
			</div>
		</div>
		<div class="item">
			<div class="cover" style="background-image: url('/img/photo/6.jpg')"></div>
			<div class="alert">
				<i>!</i>
				<p>Ut, dolor!</p>
			</div>
		</div>
		<div class="item">
			<div class="cover" style="background-image: url('/img/photo/7.jpg')"></div>
			<div class="alert">
				<i>!</i>
				<p>Asperiores, optio.</p>
			</div>
		</div>
		<div class="item">
			<div class="cover" style="background-image: url('/img/photo/8.jpg')"></div>
			<div class="alert">
				<i>!</i>
				<p>Consequuntur, aut?</p>
			</div>
		</div>
		<div class="item">
			<div class="cover" style="background-image: url('/img/photo/9.jpg')"></div>
			<div class="alert">
				<i>!</i>
				<p>Nam, odit!</p>
			</div>
		</div>
		<div class="item">
			<div class="cover" style="background-image: url('/img/photo/10.jpg')"></div>
			<div class="alert">
				<i>!</i>
				<p>Non, minima!</p>
			</div>
		</div>
		<div class="item">
			<div class="cover" style="background-image: url('/img/photo/11.jpg')"></div>
			<div class="alert">
				<i>!</i>
				<p>Quo, esse!</p>
			</div>
		</div>
		<div class="item">
			<div class="cover" style="background-image: url('/img/photo/12.jpg')"></div>
			<div class="alert">
				<i>!</i>
				<p>Dicta, itaque.</p>
			</div>
		</div>

	</div>

<div class="admin">

	<form action="upload.php" method="post" enctype="multipart/form-data">

		<h2>Загрузка файлов на сервер</h2>
		<hr>
		<!-- <input type="text" name="fileText" id="fileText" > -->
		<input type="file" name="fileName" id="fileName" multiple="multiple" accept="image/jpeg,image/png,image/gif">
		<input type="submit" value="Отправить">

	</form>
	<div class="ajaxRespond"></div>

	<h2>Загруженные ранее файлы</h2>
	<hr>
	<div class="sortFile">
		
<?php
	$dir = 'img/upload/thumbnail/';	
	$files = scandir($dir);

	foreach ($files as $value) {
		if ($value != '.' && $value != '..')
			echo '<img src="' . $dir . $value . '" class="ajaxRespond-imgPreview">';
	}
	
?>

	</div>

</div>



<script src="/js/jquery-1.12.4.min.js"  type="text/javascript"></script>
<script src="/js/js.js"  type="text/javascript"></script>

</body>
</html>
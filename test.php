	<form action="upload.php?uploadfiles" method="post" enctype="multipart/form-data">

		<h2>Загрузка файлов на сервер</h2>
		<hr>
		<!-- <input type="text" name="fileText" id="fileText" > -->
		<input type="file" name="fileName" id="fileName" multiple="multiple" accept="image/jpeg,image/png,image/gif">
		<input type="submit" value="Отправить">

	</form>
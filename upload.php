<?php

function translit($s) {
  $s = (string) $s; // преобразуем в строковое значение
  $s = strip_tags($s); // убираем HTML-теги
  $s = str_replace(array("\n", "\r"), " ", $s); // убираем перевод каретки
  $s = preg_replace("/\s+/", ' ', $s); // удаляем повторяющие пробелы
  $s = trim($s); // убираем пробелы в начале и конце строки
  $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
  $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
  $s = preg_replace("/[^0-9.a-z-_ ]/i", "", $s); // очищаем строку от недопустимых символов
  $s = str_replace(" ", "-", $s); // заменяем пробелы знаком минус
  return $s; // возвращаем результат
}

function resize($file, $type = 1, $rotate = null, $quality = null)
{

	global $tmp_path;
	$max_thumb_size = 300;
	$max_size = 1920;

	if ($quality == null)
		$quality = 75;

	if ($file['type'] == 'image/jpeg')
		$source = imagecreatefromjpeg ($file['tmp_name']);
	elseif ($file['type'] == 'image/png')
		$source = imagecreatefrompng ($file['tmp_name']);
	elseif ($file['type'] == 'image/gif')
		$source = imagecreatefromgif ($file['tmp_name']);
	else
		return false;

	if ($rotate != null)
		$src = imagerotate($source, $rotate, 0);
	else
		$src = $source;

	$w_src = imagesx($src); 
	$h_src = imagesy($src);

	// зависимости от типа (эскиз или большое изображение)
	if ($type == 1)
		$w = $max_thumb_size;
	elseif ($type == 2)
		$w = $max_size;


	if ($w_src > $w)
	{
		// если больше нормы преобразования
		$ratio = $w_src/$w;
		$w_dest = round($w_src/$ratio);
		$h_dest = round($h_src/$ratio);
		// создаем пустую картинку
		$dest = imagecreatetruecolor($w_dest, $h_dest);
		imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);
		$fn = translit($file['name']);
		imagejpeg($dest, $tmp_path . $fn, $quality);
		imagedestroy($dest);
		imagedestroy($src);

		return $fn;
	}
	else
	{
		$fn = translit($file['name']);
		imagejpeg($src, $tmp_path . $fn , $quality);
		imagedestroy($src);

		return $fn ;
	}
}

 
// Здесь нужно сделать все проверки передаваемых файлов и вывести ошибки если нужно
 
// Переменная ответа
 
$data = array();
 
if( isset( $_GET['uploadfiles'] ) ){
    $error = false;
    $files = array();
 

    $uploaddir = './img/upload/';
    $thumbdir = './img/upload/thumbnail/';
		$tmp_path = './tmp/';
		$types = array('image/gif', 'image/png', 'image/jpeg');
		$size = 1024000;
 
    // Создадим папку если её нет
 
    if( ! is_dir( $uploaddir ) ) mkdir( $uploaddir, 0777 );
 
    // переместим файлы из временной директории в указанную
    foreach( $_FILES as $file ){

				// Проверяем тип файла
				if (!in_array($file['type'], $types)) 
				{
					$fail[] = 'Ошибка загрузки - ' . basename($file['name'])  . ' (не поддерживается) <br>'; 
					continue;
				}	

				// // Проверяем размер файла
				// if ($file['size'] > $size) 
				// {
				// 	$fail[] = 'Ошибка загрузки - ' . basename($file['name'])  . ' (большой размер) <br>'; 
				// 	continue;
				// }

				// Загружаем файл
				$bigPictures = resize($file, 2);

        if( !@rename( $tmp_path . $bigPictures, $uploaddir . $bigPictures ) )
        {
            $error = true;
        }
        else{
            $files[] =  $uploaddir . $bigPictures ;
        }

				// // Загружаем файл первью
				$thumbPictures = resize($file);

        if( !@rename( $tmp_path . $thumbPictures, $thumbdir . $thumbPictures ) )
        {
            $error = true;
        }
        else{
            $thum_files[] =  $thumbdir. $thumbPictures ;
        }

    }
 

    $data = $error ? array('error' => 'Ошибка загрузки файлов.') : array('files' => $files, 'errors' => $fail, 'thum_files'=>$thum_files);
 
    echo json_encode( $data );
    // var_dump($error);
    // var_dump($data);
}

?>
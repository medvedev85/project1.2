<?php
	function __autoload($class_name) {
		$path = "{$_SERVER['DOCUMENT_ROOT']}/inc/classes/".$class_name.".php";
		if(file_exists($path))
			require($path);
		else
			die("Файл {$path} не найден \n");
	}
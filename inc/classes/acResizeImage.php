<?php // 64 => YUhSMGNEb3ZMM1J5ZFdVdFkyOWtaWEl1Y25VdmNHaHdMM0JvY0MxcmJHRnpjeTFrYkhsaExYSmxjMkZxZW1FdGFYcHZZbkpoZW1obGJtbHFMbWgwYld3PQ==

class acResizeImage
{
	private $image; //идентификатор самого изображения
	private $width; //исходная ширина
	private $height; //исходная высота
	private $type; //тип изображения (jpg, png, gif)

	function __construct($file)
	{
		if (@!file_exists($file)) exit("File does not exist");
		if(!$this->setType($file)) exit("File is not an image");
		$this->openImage($file);
		$this->setSize();
	}

	//функция проверяет, является ли файл изображением и устанавливает его тип
	private function setType($file)
	{
		$mime = mime_content_type($file);
		switch($mime)
		{
			case 'image/jpeg':
				$this->type = "jpg";
				return true;
			case 'image/png':
				$this->type = "png";
				return true;
			case 'image/gif':
				$this->type = "gif";
				return true;
			default:
				return false;
		}
	}

	//создаёт в зависимости от типа на основе файла идентификатор изображения
	private function openImage($file)
	{
		switch($this->type)
		{
			case 'jpg':
				$this->image = @imagecreatefromjpeg($file);
				break;
			case 'png':
				$this->image = @imagecreatefrompng($file);
				break;
			case 'gif':
				$this->image = @imagecreatefromgif($file);
				break;
			default:
				exit("File is not an image");
		}
	}

	//устанавливает размеры изображения
	private function setSize()
	{
		$this->width = imagesx($this->image);
		$this->height = imagesy($this->image);
	}
}
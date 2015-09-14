<?php namespace Modelo;

use Modelo\Widgets;

class Modelos{
	public static function id($hash=null){
		return new Widgets\IdModel($hash);
	}
	public static function text($hash=null){
		return new Widgets\TextModel($hash);
	}	
	public static function numero($hash=null){
		return new Widgets\IntegerModel($hash);
	}
	public static function textarea($hash=null){
		return new Widgets\TextAreaModel($hash);
	}
	public static function tinymce($hash=null){
		return new Widgets\RichTextModel($hash);
	}
	public static function file($hash=null){
		return new Widgets\FileModel($hash);
	}
	public static function multiFile($hash=null){
		return new Widgets\MultiFileModel($hash);
	}
	public static function grid($hash=null){
		return new Widgets\GridModel($hash);
	}
	public static function opcion($hash=null){
		return new Widgets\OpcionModel($hash);
	}
	public static function multiOpcion($hash=null){
		return new Widgets\MultiOpcionModel($hash);
	}
	public static function referencia($hash=null){
		return new Widgets\ReferenciaModel($hash);
	}
	public static function referenciaMultiple($hash=null){
		return new Widgets\ReferenciaMultipleModel($hash);
	}
	public static function fecha($hash=null){
		return new Widgets\FechaModel($hash);
	}
	public static function fechayhora($hash=null){
		return new Widgets\FechaHoraModel($hash);
	}
}

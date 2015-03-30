<?php 
require '../config.php';

require BASE_DIR . 'vendor/weotch/phpthumb/src/ThumbLib.inc.php';


class MongoThumb{
	public $w;
	public $h;
	public $src;
	public $crop;
	public $baseUrl;

	public function __construct($url){
		$this->baseUrl = BASE_DIR . 'public';
		$this->cacheDir = BASE_DIR . 'public/archivos/cache/';

		$url = explode('/',$_SERVER['PATH_INFO']);

		$url = array_slice($url, 1);

		$this->w = $url[0];
		$this->h = $url[1];

		if($url[2] == 'crop'){
			$this->crop = true;
			$url = array_slice($url, 3);
			$this->src = '/' . join('/',$url);
		}else{
			$url = array_slice($url, 2);
			$this->src = '/' . join('/',$url);	
		}
	}
	public function getCacheUrl(){
		$path = pathinfo($this->src);
		return $this->cacheDir
			. str_replace('/','_',$path['dirname']) 
			. '_' . $path['filename'] . '_' 
			. $this->w . 'x' . $this->h . ($this->crop ? 'crop' : '') . '.' . $path['extension'];
	}
	public function showFromCache(){
		$url = $this->getCacheUrl();
		if(file_exists($url)){
			$imginfo = getimagesize($url);
			header("Content-type: " . $imginfo['mime']);
			readfile($url);
		}else{
			throw new Exception("No hay cache para esa foto");
		}
	}
	public function make(){
		try{
			$this->showFromCache();
		}catch(Exception $e){
			$this->makeThumb();
			if($this->saveCache())
				$this->show();
		}
		/**/
	}
	public function makeThumb(){
		$this->thumb = PhpThumbFactory::create($this->baseUrl . $this->src);
		if($this->crop){
			$this->thumb->adaptiveResize($this->w, $this->h);
		}else{
			$this->thumb->resize($this->w, $this->h);
		}
	}
	public function show(){
		$this->thumb->show();
	}
	public function saveCache(){
		try {
			$this->thumb->save($this->getCacheUrl());
			return true;			
		} catch (Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}
}



$thumb = new MongoThumb($_SERVER['PATH_INFO']);

$thumb->make();

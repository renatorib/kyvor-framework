<?php
class controller extends utils_controller {
	
	public $layout = true;

	public function home(){

	}

	public function norender(){
		
		$this->layout = false;
		echo 'Page without render';

	}

}
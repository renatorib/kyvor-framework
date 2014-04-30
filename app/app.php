<?php 
class app extends utils_app {
	
	public $page;
	public $contents;
	public $layout;
	public $Controller;
	public $flash;
	
	function __construct(){
		if(isset($_GET['page'])){
			$this->page = $_GET['page'];
		} else {
			$this->page = 'home';
		}
		
		$this->Controller = new controller();
		
		if(method_exists($this->Controller, $this->page)){
			$this->Controller->{$this->page}();
		}
		
		$this->prepare_contents();
		
		$this->layout = $this->Controller->layout;
		
	}
	
	public function contents(){
		return $this->contents;
	}

	public function flash(){
		$flash = isset($_SESSION["flash"]) ? $_SESSION["flash"] : false;
		if($flash) {
			unset($_SESSION["flash"]);
			return $flash;
		}
		return false;
	}

	private function prepare_contents(){
		if(file_exists(PAGES . DS . $this->page . '.php')){
			$contents = file_get_contents(PAGES . DS . $this->page . '.php');
		} else {
			$contents = file_get_contents(PAGES . DS . '404.php');
		}
		$this->contents = $contents;
	}
	
}



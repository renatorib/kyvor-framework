<?php

/*
 * GLOBAL UTILITIES
 */

class utils {
	
	public function clean($string) {
		$string = mysql_real_escape_string($string);
		return $string;
	} 
	
	public function setFlash($flash, $type = 'success'){
		$set = "<div class='alert alert-{$type}'>";
		$set .= $flash;
		$set .= "</div>";
		$_SESSION["flash"] = $set;
	}
	
	public function base_url($atRoot=FALSE, $atCore=FALSE, $parse=FALSE){
        if (isset($_SERVER['HTTP_HOST'])) {
            $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
            $hostname = $_SERVER['HTTP_HOST'];
            $dir =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

            $core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY);
            $core = $core[0];

            $tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
            $end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
            $base_url = sprintf( $tmplt, $http, $hostname, $end );
        }
        else $base_url = 'http://localhost/';

        if ($parse) {
            $base_url = parse_url($base_url);
            if (isset($base_url['path'])) if ($base_url['path'] == '/') $base_url['path'] = '';
        }

        return $base_url;
    }
	
	public function route($url = null){
		$base = $this->base_url(NULL, NULL, TRUE);
		return $base['path'].$url;
	}
	
}

/*
 * UTILITIES FOR CONTROLLER
 */

class utils_controller extends utils {
	
	public $Uses;
	public $post;
	public $get;
	
	function __construct(){
		$this->Uses = new uses_controller();
		$this->prepare_received();
	}
	
	public function redirect($view, $full = false){
		if($full) header('Location: '.$view);
		else header('Location: index.php?page='.$view);
	}
	
	private function prepare_received(){
		
		if (isset($_POST)) {
			$this->post = $_POST;
		} else {
			$this->post = false;
		}
		
		if (isset($_GET)) {
			$this->get = $_GET;
		} else {
			$this->get = false;
		}
		
		return true;
	}
	
	public function debug($var){
		$debug = '<b>'.__LINE__.'</b><br /><pre>';
		$debug .= print_r($var, true);
		$debug .= '</pre>';
		return $debug;
	}
	
	public function sendMail($from, $to, $subject, $msg, $html = true){
		
		$this->Uses->lib('PHPMailer/PHPMailerAutoload.php');
		
		$mail = new PHPMailer;

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.example.com.br'; 				 // Specify main and backup server
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'main@example.com.br';                            // SMTP username
		$mail->Password = 'abcd1234';                           // SMTP password
		$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'tsl', 'ssl' also accepted
		$mail->Port = 465;
		
		$mail->From = 'main@example.com.br';
		$mail->FromName = 'Main';
		
		if(is_array($to)){
			foreach($to as $recipient){
				$mail->addAddress($recipient);  				// Add a recipientName is optional
			}
		} else {
			$mail->addAddress($to);
		}
		
		$mail->isHTML($html);                                  // Set email format to HTML
		
		$mail->Subject = $subject;
		$mail->Body    = $msg;
		
		return $mail->send();
		  
		//echo 'teste';
	}
	
}

class uses_controller {
	
	public function lib($file, $require = false){
		$file = LIB . DS . $file;
		if($require) require $file;
		else include $file;
	}
	
}

/*
 * UTILITIES FOR APP
 */

class utils_app extends utils {
	
}

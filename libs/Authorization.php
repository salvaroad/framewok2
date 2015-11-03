<?php
/**
 * Clase Authorization
 * 
 * Clase para validar usuarios
 *
 * @author  sebastian <sebas@gmail.com>
 */


class Authorization{
	
	/**
	 * 
	 * Método sirve para validar usuarios del sistema
	 * @return  void no regresa ningún valor
	 */
	static function logged(){
		
		if(!isset($_SESSION)){
			session_start();
		}
		if(!$_SESSION['logged']){
		    header("Location: ".APP_URL."usuarios/login");
		    exit;
		}
	}

	/**
	 * Método login
	 * 
	 */
	public function login($user){
		session_start();
		$_SESSION['logged'] = true;
	    $_SESSION['username'] = $user["username"];
	    $_SESSION['start'] = time();
		$_SESSION['expire'] = $_SESSION['start'] + (5 * 60) ;
	}	
	
	/**
	 * Método logout
	 * 
	 * finaliza la sesion iniciada
	 * 
	 */
	public function logout(){
		
		session_unset();

		// destruye la sesion.

		session_destroy();
		echo"<script type='text/javascript'>
		     alert('Ha salido correctamente');
		    window.location='".APP_URL."usuarios/login';
		    </script>";
	}
}
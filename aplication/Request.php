<?php
/**
 * clase request filtra la url 
 *
 */

class Request{

	private $_controlador;
	private $_metodo;
	private $_argumentos;

	public function __construct(){
		//sanitiza la url 



		if(isset($_GET['url'])){
			echo $_GET['url'];
			$url=filter_input(INPUT_GET,'url',FILTER_SANITIZE_URL);
			$url=explode("/",$url);
			$url=array_filter($url);

  
			$this->_controlador=strtolower(array_shift($url));
			$this->_metodo=strtolower(array_shift($url));
			$this->_argumentos=$url;

		}

		
		if(!$this->_controlador){
			$this->_controlador= DEFAULT_CONTROLLER;


		}
		if (!$this->_metodo) {
			 $this->_metodo = "index";

		}
		if (!$this->_argumentos) {
			 $this->_argumentos = array();

		}
	}
/**
 * obtiene el controlador 
 * 
 *@return _controlador
 */
	public function getControlador(){
		return $this->_controlador;
	

	}

	/**
	 * el get metodo para optener el metodo
	 * @return getmetodo
	 */
	public function getMetodo(){
		return $this->_metodo;
		
	}
/**
 * @return _argumentos
 */
	public function getArgs(){
		return $this->_argumentos;
		
	}
}
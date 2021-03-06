<?php
/**
 * la clase usuarios que extiende la clase AppController
 */
class UsuariosController extends AppController{
	public function __construct(){
		parent::__construct();
	}

/**
 * lista los isuarios 
 */
public function index(){
		$this->_view->titulo = "Listado de usuarios";
		$this->_view->usuario= $this->db->find('usuarios', 'all');
		$this->_view->renderizar('index');
		


}

/**
 * edit es para editar un registro de los usuarios
 */
public function edit($id = NULL){
	
	if ($_POST){
			if($this->db->update('usuarios', $_POST)){
	           $this->redirect(
	      	          array('controller'=>'usuarios','action'=>'index'
	      	          	)
	      	        );
        }else{
        	$this->redirect(
        	          array(
        	                'controller'=>'usuarios',
        	                'action'=>'edit/'.$_POST['id']
        	               )
        	          );
                }

        }else{

		$conditions = array(
			      'conditions'=>'id='.$id);
		$this->_view->usuarios=$this->db->find(
			'usuarios',
			'first',
			$conditions
		);

		$this->_view->titulo="Editar usuarios";
		$this->_view->renderizar('edit');


	}
}

/**
 * add este metodo es para añadir un usuario
 */
public function add(){

	    $pass = new Password();
		

		
		if ($_POST) {
			//se invvoca al metodo para incriptar
			$cryp=$pass->getPassword($_POST['password']);
       
       //se elimina el password
       unset($_POST['password']);
       //se agrega el password ya encriptado
     $_POST=$_POST+array('password' => $cryp);
   
		  	# code...
		  }  
		  
		  
       
     

		if ($_POST){
			
			if($this->db->save('usuarios',$_POST)){
				
	           $this->redirect(
	      	          array('controller'=>'usuarios','action'=>'index'
	      	          	)
	      	        );
        }else{$this->redirect(
        	                  array(
        	                  	'controller'=>'usuarios','action'=>'add'
        	               )
        	          );
        }
		}else{

			$this->_view->titulo="Agregar usuarios";
			$this->_view->renderizar=("add");


		}
		$this->_view->renderizar('add');

}
/**
 * funcion para elimiar un usuario.
 */
public function delete($id){
	$condition='id='.$id;
	if ($this->db->delete('usuarios', $condition)) {
		$this->redirect(array('controller'=>'usuarios'));
	  }
}

/**
 * login es el metodo que se encarga de validar los datos para inicio de sesion.
 */
public function login(){
	if($_POST){
		$pass = new Password();
		$filter = new Validations();
		$auth = new Authorization();

		$username = $filter->sanitizeText($_POST['username']);
		$password = $filter->sanitizeText($_POST['password']); 

		$options = array('conditions' => "username = '$username'");		
		$usuario = $this->db->find('usuarios','first', $options);
		if ($pass->isValid($password,$usuario['password'])) {
			$auth->login($usuario);
			$this->redirect(array('controller'=>'tareas'));
		}else{
			echo "Usuario no Valido";
		}
	}
	
	$this->_view->renderizar('login');

}

/**
 * logout es para finalizar sesion.
 */
public function logout(){
		$auth = new Authorization();
		$auth->logout();
	}



}

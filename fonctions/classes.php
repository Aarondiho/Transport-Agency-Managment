<?php

session_start();



Class Action {

	private $db;

	public function __construct() {

		ob_start();

		include '../connection/db_connect.php'; 
	
    	$this->db = $conn;
	}
	
	function __destruct() {

	    ob_end_flush();
	}

	/* ***********************DEBUT FONCTION POUR UTILISATEUR ************ */

	
	function login(){

		extract($_POST);
		 $mot_pass =  md5($password);
		
		$qry = $this->db->query("SELECT * FROM users WHERE userName = '$userName' and password = '$mot_pass' ");

		if($qry->rowCount()> 0){

			foreach ($qry->fetch() as $key => $value) {
				if($key != 'passwors' && !is_numeric($key))
					$_SESSION['util_'.$key] = $value;
				}

			$init = 12345;
			$enligne = 1;

			$id = $_SESSION['util_idUser'];
			$pass = $_SESSION['util_password'];
			$pass1 = md5($init);
			$active = $_SESSION['util_status'];
			$type = $_SESSION['util_type'];

			if($active == 0){

				return 1100;
			}else{
			
				$online = $this->db->EXEC("UPDATE users SET online='$enligne' WHERE idUser='$id'");
					
				if($pass == $pass1){

						return 10;
					
				}else{

					return 1;
					
				}
			};

			}else{
				return 11;
			
		};
	}

	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:index.php");
	}

	function save_user(){

		extract($_POST);
		$active = 1;
		$password = 12345;
		$crypt_pass = md5($password);
       
		if(empty($id)){

			$stmt = $this->db->prepare("INSERT INTO users(firstName, lastName, userName, password, type, status) VALUES(?,?,?,?,?,?)");
			$save = $stmt->execute([$firstName, $lastName, $userName, $crypt_pass, $type, $active]);

			if($save){
				return 1;
			}
				 
		}else{ 
			$stmt = $this->db->prepare("UPDATE users SET firstName=?, lastName=?, userName=?, type=? WHERE idUser=? ");
			$save = $stmt->execute([$firstName, $lastName, $userName, $type, $id]);
			if($save){
				return 2;
			}
		}

		
	}

	function editer_mot_de_passe(){

		extract($_POST);

		$crypt_pass = md5($password);
		
		$stmt = $this->db->prepare("UPDATE users SET password =? WHERE idUser= ? ");
		$save = $stmt->execute([$crypt_pass,$id]);
		

		if($save)
			return 1;
	}



	



/* *********************** FIN FONCTIONS POUR LES UTILISATEURS ************ */


/* *********************** DEBUT FONCTIONS POUR LES VEHICULES ************ */
function save_car(){

	extract($_POST);

	$active = 1;

   
	if(empty($id)){

		$stmt = $this->db->prepare("INSERT INTO cars(plaque, price, status) VALUES(?,?,?)");
		$save = $stmt->execute([$plaque, $price, $active]);

		if($save){
			return 1;
		}
			 
	}else{ 

		$stmt = $this->db->prepare("UPDATE cars SET plaque=?, price=? WHERE idCar = ? ");
		$save = $stmt->execute([$plaque, $price, $id]);

		if($save){
			return 2;
		}
	}

	
}


/* *********************** DEBUT FONCTIONS POUR LES EMPLOYES ************ */
function save_worker(){

	extract($_POST);

	$active = 1;

   
	if(empty($id)){

		$stmt = $this->db->prepare("INSERT INTO workers(firstName, lastName, typeWorker, status, car, salary) VALUES(?,?,?,?,?,?)");
		$save = $stmt->execute([$firstName, $lastName, $typeWorker, $active, $car, $salary]);

		if($save){
			return 1;
		}
			 
	}else{ 

		$stmt = $this->db->prepare("UPDATE workers SET firstName=?, lastName=?, typeWorker=?, car=?, salary=? WHERE idWorker=? ");
		$save = $stmt->execute([$firstName, $lastName, $typeWorker, $car, $salary, $id]);

		if($save){
			return 2;
		}
	}

	
}

/* *********************** DEBUT FONCTIONS POUR LES Dépenses ************ */
function save_cost(){

	extract($_POST);

	if($_FILES['img']['tmp_name'] != ''){
		$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
		$move = move_uploaded_file($_FILES['img']['tmp_name'],'../photos/'.$fname);
	
		}else{
			$fname ='user.jpg';
		}
	

	
	if($nameCost != 0){
			    	    
		$nameCost = $nameCost;  
		  
		  
	  }else{
		  
		$stmt = $this->db->prepare("INSERT INTO typecost(nameTypeCost) VALUES(?)");
		$save = $stmt->execute([$nameTypeCost]);
		   
		$nameCost = $nameTypeCost;
		   
	  }

   
	if(empty($id)){

		$stmt = $this->db->prepare("INSERT INTO costs(nameCost,detail, priceCost, worker, car, bill) VALUES(?,?,?,?,?,?)");
		$save = $stmt->execute([$nameCost, $detail, $priceCost, $worker, $car, $fname]);

		if($save){
			return 1;
		}
			 
	}else{ 

		if($_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'../photos/'.$fname);

			$stmt = $this->db->prepare("UPDATE costs SET nameCost=?,detail=?, priceCost=?, worker=?, car=?, bill=? WHERE idCost=? ");
		    $save = $stmt->execute([$nameCost, $detail, $priceCost, $worker, $car, $fname, $id]);

		
			}else{

				$stmt = $this->db->prepare("UPDATE costs SET nameCost=?,detail=?, priceCost=?, worker=?, car=? WHERE idCost=? ");
		    $save = $stmt->execute([$nameCost, $detail, $priceCost, $worker, $car, $id]);

			}

		
		if($save){
			return 2;
		}
	}

	
}



/* *********************** DEBUT FONCTIONS POUR LES VERSEMENTS ************ */

function save_pay(){

	extract($_POST);

	if($_FILES['img']['tmp_name'] != ''){

		$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
		$move = move_uploaded_file($_FILES['img']['tmp_name'],'../photos/'.$fname);
	
		}else{
			$fname ='bill.png';
		}
	


   
	if(empty($id)){

		$stmt = $this->db->prepare("INSERT INTO payments(amount, bus, cheque, user) VALUES(?,?,?,?)");
		$save = $stmt->execute([$amount, $bus, $fname, $user]);

		if($save){

			return 1;
		}
			 
	}else{ 

		if($_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'../photos/'.$fname);

			$stmt = $this->db->prepare("UPDATE payments SET amount=?, bus=?, cheque=?, user=? WHERE idPay=? ");
		    $save = $stmt->execute([$amount, $bus, $fname, $user, $id]);

		
			}else{

				$stmt = $this->db->prepare("UPDATE payments SET amount=?, bus=?, user=? WHERE idPay=? ");
				$save = $stmt->execute([$amount, $bus, $user, $id]);

			}

		

		if($save){
			return 2;
		}
	}

	
}



/* *********************** DEBUT FONCTIONS POUR LES DEPOTS ************ */

function save_depot(){

	extract($_POST);

	if($_FILES['img']['tmp_name'] != ''){

		$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
		$move = move_uploaded_file($_FILES['img']['tmp_name'],'../photos/'.$fname);
	
		}else{
			$fname ='cheque.jpg';
		}
	


   
	if(empty($id)){

		$stmt = $this->db->prepare("INSERT INTO deposits(amount, content, cheque, user,dateDeposit) VALUES(?,?,?,?,?)");
		$save = $stmt->execute([$amount, $content, $fname, $user, $dateDeposit,]);

		if($save){

			return 1;
		}
			 
	}else{ 

		if($_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'../photos/'.$fname);

			$stmt = $this->db->prepare("UPDATE deposits SET amount=?, content=?, cheque=?, user=?, dateDeposit =? WHERE idDeposit=? ");
		    $save = $stmt->execute([$amount, $content, $fname, $user, $dateDeposit, $id]);

		
			}else{

				$stmt = $this->db->prepare("UPDATE deposits SET amount=?, content=?, user=?, dateDeposit=? WHERE idDeposit=? ");
				$save = $stmt->execute([$amount, $content, $user, $dateDeposit, $id]);

			}

		

		if($save){
			return 2;
		}
	}

	
}



}

?>

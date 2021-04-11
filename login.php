<?php 
session_start(); 

//aquí estamos importando el db_conn.php 
//importamos para poder usar las variables de db_conn.php
include "db_conn.php";
//isset --> determina si una variable está definida 
//$_POST --> matriz asociativa de variables pasadas al script a través del método HTTP POST  

if (isset($_POST['uname']) && isset($_POST['password'])) {


	//para evitar escribir el código varias veces creamos una función que valide
	function validate($data){
	   //paso 2:trim --> elimina los caracteres innecesarios(espacio adicional,tabulación , nueva línea)
       $data = trim($data);
	   //paso 3:striplashes --> eliminar las barras invertidas de los datos de entrada 
	   $data = stripslashes($data);
	   //paso 1: htmlspecialchars--> para pasar las variables y convertirlas en entidades html 
	   $data = htmlspecialchars($data);
	   return $data;
	}

//se valida el username and password
	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);
//si el username está vacio 
	if (empty($uname)) {
     //header() --> para redireccionar a index con mensaje de error
		header("Location: index.php?error=User Name is required");
		//exit() cada vez que uso un header()
	    exit();
		//si el password es vacío
	}else if(empty($pass)){
		//header()--> para redireccionar a index con mensaje de error 
        header("Location: index.php?error=Password is required");
		//exit() cada vez que uso un header()
	    exit();
		//si ninguno está vacío
	}else{
        //consulta: seleeciona todos los campos de la tabla useer 
		//donde el username sea igual al username ingresado 
		//y el password sea igual al password ingresado
	
		$sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";
        // mysqli_query --> para realizar la consulta a la base de datos que nosotros querramos
		$result = mysqli_query($conn, $sql);
        // mysqli_num_rows --> obtiene el número de filas en un resultado 
		//en este caso comprobamos si existe almenos un registro de este usuario
		if (mysqli_num_rows($result) === 1) {
       //mysqli_fetch_assoc --> devuelve un array asociativo a la fila obtenido
	   //obtiene todos los campos del unico usuario
	   //es como un objeto este tiene atributos user_name , password , etc
			$row = mysqli_fetch_assoc($result);
           //de este objeto su atributo user_name es igual al name del user ingresado 
		   //de este objeto su atributo password es igual al password del user ingresado
            if ($row['user_name'] === $uname && $row['password'] === $pass) {
        // $_SESSION --> es un array asociativo que contiene variables de sesión 
		// es una variable global 
            	$_SESSION['user_name'] = $row['user_name'];
            	$_SESSION['name'] = $row['name'];
            	$_SESSION['id'] = $row['id'];


				//header() me redirecciona a home.php
            	header("Location: home.php");
				//exit() cada vez q uso header()
		        exit();
            }else{
				header("Location: index.php?error=Incorect User name or password");
		        exit();
			}
		}else{
			header("Location: index.php?error=Incorect User name or password");
	        exit();
		}
	}
	
}else{
	header("Location: index.php");
	exit();
}
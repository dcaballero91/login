<?php

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
	
}
//Define variables
$apellido='';
$direccion='';

// Include config file
require_once "config.php";

 // Prepare an insert statement
        $sql = "INSERT INTO direccion (apellido, direccion) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_apellido, $param_direccion);
            
            // Set parameters
            $param_apellido = $apellido;
            $param_direccion = $direccion;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to welcome page
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }


        
       
   

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <h1 class="my-5">Hola, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Bienvenido.</h1>
	<div class="wrapper">
        <h2>Por favor</h2>
        <p>Completa tus datos.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<div class="form-group">
                <label>Apellido</label>
                <input type="text" name="apellido" value="<?php echo $apellido; ?>">
				<span class="invalid-feedback"><?php echo $apellido; ?></span>
            </div>  
			
			<div class="form-group">
                <label>Direccion</label>
                <input type="text" name="direccion"  value="<?php echo $direccion; ?>">
            </div>   			
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
        </form>
    </div>
</body>
</html>
<?php
      include_once('dbconec.php'); 

$error = false;
if(isset($_POST['btn-register'])){
    $username = $_POST['username'];
    $username = strip_tags($username);
    $username = htmlspecialchars($username);

    $email = $_POST['email'];
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $password = $_POST['password'];
    $password = strip_tags($password);
    $password =htmlspecialchars($password);

    
    if (empty($username)){
      $error = true;
      $errorUsername = 'Rellena Campo';
    }
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $error = true;
      $errorEmail = 'Introduce un Email valido';
    }

    if(empty($password)){
      $error = true;
      $errorPassword = 'Rellena Campo';
    }elseif(strlen($password) <6){
      $error = true;
      $errorPassword = 'Password debil, Intrdoduzaca un minimo de 6 caracteres';
    }

    $password = md5($password);

    if(!$error){
      echo '';
      $sql = "insert into regis(username, email, password)
                   values('$username', '$email', '$password')";
                   if(mysqli_query($conn, $sql)){
                    $successMsg = 'Registro Exitoso'; 
                   }else{
                    echo 'Error '.mysqli_error($conn);
                   }
    }
}


?>


<html>
<head>
<title> Login  </title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/estilos.css">

</head>
<body background="Picture/30316.png">
<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
      <div class="container">
      </div>
        <!-- Inicia Menú -->
      <div class="collapse navbar-collapse " id="navegacion-ga">
        <div class="container-fluid" >
          <ul class="nav navbar-nav etiqueta-header">
        <li><a href="truper.html"><img src="images/truper1.png" class="img-responsive" alt=""> </a></li>
            <li class="dropdown direccion">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" style="color: #fff;" >
                Nosotros <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="acerca-de.html">Acerca de</a></li>
                <li><a href="historia.html">Historia</a></li>
              </ul>
            </li>
            <li class="direccion2"><a href="productos.html" style="color: #fff;">Productos</a></li>
            <li class="direccion3"><a href="register.php" style="color: #fff;">Registro</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class ="container">
    <div style = "...">
     <form method = "post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete = "off">
     <center><h2> Registro </h2></center>
     <hr/>
     <?php
        if(isset($successMsg)){
          ?>

            <div class = "alert alert-success">
            <span class = " glyphicon glyphicon-info-sign"></span>
            <?php echo $successMsg; ?>
            </div>

          <?php
        }
        ?>
     <div class = "form-group">
     <label for = "username" class = "control-label"> Username</label>
     <input type = "text" name = "username" class = "form-control" autocomplete="off">
     <span class = "text-danger"><?php if (isset($errorUsername)) echo $errorUsername; ?></span>   
    </div>
    <div class = "form-group">
    <label for = "email" class = "control-label">Email</label>
    <input type = "email" name = "email" class = "form-control" autocomplete="off">
    <span class = "text-danger"><?php if (isset($errorEmail)) echo $errorEmail; ?></span>
    </div>
        <div class = "form-group">
        <label for = "password" class = "control-label">Password</label>
        <input type = "password" name = "password" class = "form-control" autocomplete="off">
    <span class ="text-danger"><?php if (isset($errorPassword)) echo $errorPassword; ?></span>    
        </div>
          <div class = "form-group">
          <center><input type = "submit" name = "btn-register" value = "Registrate" class = "btn btn-primary"></center>
    </form>
    <hr>
    <a href = "index.php">Login</a>
    </div>
    </div>

    <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>
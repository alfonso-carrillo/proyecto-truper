<?php
session_start();
include_once('dbconec.php');

$error = false;

if(isset($_POST['btn-login'])){
   $email = trim($_POST['email']);
   $email = htmlspecialchars(strip_tags($email));

   $password = trim($_POST['password']);
   $password = htmlspecialchars(strip_tags($password));

   if(empty($email)){
    $error = true;
    $errorEmail = 'Introduce Correo';

   }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $error = true;
    $errorEmail = 'Introduce un Correo Valido';

   }

   if(empty($password)){
    $error = true;
    $errorPassword = 'Introduce Password';
   }elseif(strlen($password)< 6){
    $error = true;
    $errorPassword = 'Password menor de 6 caracterees';
   }

   if(!$error){
    $password = md5($password);
    $sql = "select * from regis where email = '$email' ";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    if($count==1 && $row['password'] == $password){ 
      $_SESSION['username'] = $row['username'];
      header('location: truper.html');
    }else{
      $errorMsg = 'Password o Usuario Invalido';
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
<body background="Picture/fondo_con.jpg">
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
    <div style = "width: 500px; margin: 50px auto;">
     <form method = "post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete = "off">
     <center><h2> Login </h2></center>
     <hr/>
     <?php
      if(isset($errorMsg)){
        ?>
        <div class = "alert alert-danger">
        <span class = "glyphicon glyphicon-info-sign"></span>
        <?php echo $errorMsg; ?>
        </div>
        <?php

      }
     ?>
     
    <div class = "form-group">
    <label for = "email" class = "control-label">Email </label>
    <input type = "email" name = "email" class = "form-control" autocomplete="off">
    <span class = "text-danger"><?php if(isset($errorEmail)) echo $errorEmail; ?></span>
    </div>
        <div class = "form-group">
        <label for = "password" class = "control-label">Password</label>
        <input type = "password" name = "password" class = "form-control" autocomplete="off">
        <span class = "text-danger"><?php if(isset($errorPassword)) echo $errorPassword; ?></span>
        </div>
          <div class = "form-group">
          <center><input type = "submit" name = "btn-login" value = "Login" class = "btn btn-primary"></center>
    </div>
    <hr>
    <a href = "register.php">Registro</a>
    </form>
    </div>
    </div>
    <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>
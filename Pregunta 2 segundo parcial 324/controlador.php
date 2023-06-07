<!DOCTYPE html>
<html>
<head>
  <title>Matriculacion</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>
<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
  <div class="container px-4">
  <div class="row gx-5">
    <div class="col">
     <div class="p-3 border bg-light">
		<?php
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $codFlujo = $_POST['codFlujo'];
    $codProceso = $_POST['codProceso'];
    session_start();
    $_SESSION['usuario']=$usuario;
    $conexion = mysqli_connect("localhost", "root", "mysql", "matriculacion");
    $consulta = "SELECT usuario FROM usuario where usuario = '$usuario' and password = '$password'";
    $resultado = mysqli_query($conexion, $consulta);
    $consulta2 = "SELECT pantalla FROM flujo where codFlujo = '$codFlujo' and codProceso = '$codProceso'";
    $resultado2 = mysqli_query($conexion, $consulta2);
    $filas=mysqli_num_rows($resultado);
    $filas2=mysqli_num_rows($resultado2);
    if($filas2){
        $loc=$resultado2->fetch_assoc();
        //echo $loc["pantalla"];
        //echo $usu["usuario"];
        //echo $codFlujo;
        //echo $codProceso;

    };
    if($filas){
        $usu=$resultado->fetch_assoc();
        
        //echo $usu["usuario"];
        //echo $codFlujo;
        //echo $codProceso;

    };
    mysqli_close($conexion);

    ?>
  <?php
  echo "<h1>Hola " . $usu["usuario"] . "</h1>";
  echo "<h1>vas a " . $codProceso . " ?</h1>";
  ?>
  <form action="<?php echo $loc["pantalla"]; ?>" method="post">
  <input type="hidden" value="<?php echo $codFlujo; ?>" name="codFlujo" />
  <input type="hidden" value="<?php echo $codProceso; ?>" name="codProceso" />
  <input type="hidden" value="<?php echo $usu["usuario"]; ?>" name="usuario" />
  <input type="hidden" value="<?php echo $password; ?>" name="password" />
  <button type="submit" class="btn btn-primary">Siguiente</button>
	 </div>
    </div>
    
  </div>
  
</body>
</html>
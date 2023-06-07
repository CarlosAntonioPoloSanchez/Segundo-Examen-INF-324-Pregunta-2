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
    $consulta3 = "SELECT CIESTUDIANTE FROM usuario where usuario = '$usuario' and password = '$password'";
    $resultado3 = mysqli_query($conexion, $consulta3);
    $filas=mysqli_num_rows($resultado);
    $filas2=mysqli_num_rows($resultado2);
    $filas3=mysqli_num_rows($resultado3);
    if($filas2){
        $loc=$resultado2->fetch_assoc();
        //echo $loc["pantalla"];
        //echo $usu["usuario"];
        //echo $codFlujo;
        //echo $codProceso;

    };
    if($filas){
        $usu=$resultado->fetch_assoc();
        $ci=$resultado3->fetch_assoc();
        //echo $usu["usuario"];
        //echo $codFlujo;
        //echo $codProceso;

    };
    mysqli_close($conexion);

    ?>
  <?php
  echo "<h1>Hola " . $usu["usuario"] . "</h1>";
  echo "<h1>De CI: " . $ci["CIESTUDIANTE"] . "</h1>";
  echo "<h1>Gracias por pagar la matricula</h1>";
  ?>
  <form action="index.php" method="post">
  <button type="submit" class="btn btn-primary">Salir</button>
     </div>
    </div>
  </div>
</div>

</body>
</html>
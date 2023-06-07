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
    $consulta3 = "SELECT pagado FROM matriculas where ci = '$usuario'";
    $resultado3 = mysqli_query($conexion, $consulta3);
    $consulta4 = "SELECT MAX(CPT) AS max_clave FROM matriculas";
    $resultado4 = mysqli_query($conexion, $consulta4);
    $consulta5 = "SELECT cpt FROM matriculas where ci = '$usuario'";
    $resultado5 = mysqli_query($conexion, $consulta5);
    $filas=mysqli_num_rows($resultado);
    $filas2=mysqli_num_rows($resultado2);
    $filas3=mysqli_num_rows($resultado3);
    $filas4=mysqli_num_rows($resultado4);
    if($filas2 && $filas && $filas3){
        $loc=$resultado2->fetch_assoc();
        $pagado=$resultado3->fetch_assoc();
        $usu=$resultado->fetch_assoc();
        $row = $resultado4->fetch_assoc();
        $cpt = $resultado5->fetch_assoc();
        if($pagado["pagado"]=="NO"){
            $mostrar="no pago aun su cpt de codigo ". $cpt["cpt"];
            $ncodProceso=$codProceso;
        }else{
            $mostrar="codigo cpt pagado ". $cpt["cpt"];
            $ncodProceso="P2";

        }
        //echo $loc["pantalla"];
        //echo $usu["usuario"];
        //echo $codFlujo;
        //echo $codProceso;

    }elseif($filas2 && $filas){
        $loc=$resultado2->fetch_assoc();
        $usu=$resultado->fetch_assoc();
        $row = $resultado4->fetch_assoc();
        $maxClave = $row["max_clave"];
        $nueva=$maxClave+1;
        //$mostrar= $nueva;
        $sql = "INSERT INTO matriculas (cpt, ci, pagado) VALUES ('$nueva', '$usuario', 'NO')";

        if ($conexion->query($sql) === TRUE) {
            $mostrar="codigo cpt generado ". $nueva;
        } else {
            echo "Error al insertar el registro: " . $conexion->error;
        }
        $ncodProceso=$codProceso;
    };
    mysqli_close($conexion);

    ?>
  <?php
  echo "<h1>Hola " . $usu["usuario"] . "</h1>";
  echo $mostrar;
  ?>
  <form action="controlador.php" method="post">
  <input type="hidden" value="<?php echo $codFlujo; ?>" name="codFlujo" />
  <input type="hidden" value="<?php echo $ncodProceso; ?>" name="codProceso" />
  <input type="hidden" value="<?php echo $usu["usuario"]; ?>" name="usuario" />
  <input type="hidden" value="<?php echo $password; ?>" name="password" />
  <button type="submit" class="btn btn-primary">Siguiente</button>
     </div>
    </div>
  </div>
</div>
  
</body>
</html>
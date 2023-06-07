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
     <div class="p-3 border bg-light"><h1 >MATRICULACION</h1>
  <form action="controlador.php" method="post">
  <input type="hidden" value="F1" name="codFlujo" />
  <input type="hidden" value="P1" name="codProceso" />
  <p>USUARIO: <input type="text" name="usuario" /></p>
  <p>PASSWORD: <input type="text" name="password" /></p>
  <button type="submit" class="btn btn-primary">Ingresar</button></div>
    </div>
    
  </div>
</div>
  
</body>
</html>


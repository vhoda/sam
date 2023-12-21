<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--CDNS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <title>Cerrando sesion</title>
</head>
<body>

 <!---ESTRUCTURA PRINCIPAL-->
<div class="col py-3">
<div class="container">
  <div class="row">
    <div class="col-md-4">
        <script>
            function redireccionar(){
            window.location.href = "/";
            }
            
            setTimeout("redireccionar()", 5000);
        </script>

    </div>
    <div class="col-md-4" style="margin-top:20px;">
      <div class="card shadow-sm">
        <div class="card-body">
          <h1 class="text-center">Cerrando sesión...</h1>
            <p class="text-center">Espere un momento.</p>
              <div class=" d-flex justify-content-center">
                <img src="<?php echo APP_URL; ?>app/views/img/bubbly.gif" alt="Logo" class="img-fluid text-center" style="width: 2.5rem;" class="d-inline-block align-text-top">
              </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>
<?php
$insLogin->cerrarSesionControlador();
?>
<div class="col py-2">
<div class="container">
    <h1 class="title">Usuarios</h1>
    <h3 class="subtitle">Buscar usuarios</h3>
    <hr>
</div>
<div class="container">

<div class="container">
    <div class="row">

    <?php
    
        use app\controllers\userController;
        $insUsuario = new userController();

        if(!isset($_SESSION[$url[0]]) && empty($_SESSION[$url[0]])){
    ?>

        <div class="card shadow-sm">
        <div class="card-body">
        <form class="FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/buscadorAjax.php" method="POST" autocomplete="off" >
                        <input type="hidden" name="modulo_buscador" value="buscar">
                        <input type="hidden" name="modulo_url" value="<?php echo $url[0]; ?>">
                        <div class="field is-grouped">
                                <input class="form-control mb-3" type="text" name="txt_buscador" placeholder="¿Qué estas buscando?" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" maxlength="30" required >
                                <button class="btn btn-success" type="submit" >Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php }else{ ?>
            <div class="col mb-3">
                    <form class="has-text-centered mt-6 mb-6 FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/buscadorAjax.php" method="POST" autocomplete="off" >
                        <input type="hidden" name="modulo_buscador" value="eliminar">
                        <input type="hidden" name="modulo_url" value="<?php echo $url[0]; ?>"
                        <p>Estas buscando a <span class="badge bg-success">“<?php echo $_SESSION[$url[0]]; ?>”</span ></p>
                        <button type="submit" class="btn btn-secondary">Eliminar busqueda</button>
                    </form>
                </div>
            </div>
            <?php
                    echo $insUsuario->listarUsuarioControlador($url[1],15,$url[0],$_SESSION[$url[0]]);
                }
            ?>
    </div>
     </div>
  </div>
</div>
</div>
</div>

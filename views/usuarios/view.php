<?php require "views/shared/header.php" ?>

  <div class="container cuerpo">
    <h1 class="text-center my-5"><?= $data['titulo'] ?></h1>

    <table class="table table-hover">

     <!-- id usuario -->
    <p class="text-dark">
      <span class="fw-bold">Id Usuario:</span> 
      <?= $data['usuario']['id_usuario'] ?>
    </p>   

    <hr class="lineas">

    <!-- Nombre usuario -->
    <p class="text-dark">
      <span class="fw-bold">Nombre del Usuario:</span>
      <?= $data['usuario']['nombre_usuario'] ?>
    </p>

    <hr class="lineas">


    <!-- Extraer el cargo al cual pertenece el usuarioooooo -->
    <p class="text-dark">
    <span class="fw-bold">Cargo:</span>
    <?= $data['usuario']['tipo_cargo'] ?>
</p>
<hr class="lineas">


    <a href="index.php?controlador=usuario" class="btn btn-ver">Volver</a>

    </table>
  </div>

<?php require "views/shared/footer.php" ?>
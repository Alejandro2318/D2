<?php require "views/shared/header.php" ?>

  <div class="container cuerpo">
    <h1 class="text-center my-5"><?= $data['titulo'] ?></h1>

    <table class="table table-hover">

     <!-- id productos -->
    <p class="text-dark">
      <span class="fw-bold">Id producto:</span> 
      <?= $data['productos']['id_producto'] ?>
    </p>   

    <hr class="lineas">

    <!-- Nombre productos -->
    <p class="text-dark">
      <span class="fw-bold">Nombre del Producto:</span>
      <?= $data['productos']['nombre_producto'] ?>
    </p>

    <hr class="lineas">


     <!-- Precio productos -->
     <p class="text-dark">
      <span class="fw-bold">Precio del Producto:</span>
      <?= $data['productos']['precio_producto'] ?>
    </p>

    <hr class="lineas">


        <!-- Cantidad productos -->
        <p class="text-dark">
      <span class="fw-bold">Cantidad del Producto:</span>
      <?= $data['productos']['cantidad_producto'] ?>
    </p>

    <hr class="lineas">


        <!-- Fecha producto -->
        <p class="text-dark">
      <span class="fw-bold">Fecha Caducidad del Producto:</span>
      <?= $data['productos']['fecha_caducidad'] ?>
    </p>

    <hr class="lineas">


       <!-- Perecedro -->
       <p class="text-dark">
      <span class="fw-bold">Perecedro:</span>
      <?= $data['productos']['es_perecedero'] ?>
    </p>

    <hr class="lineas">


    <!-- Extraer la categoria al cual pertenece el producto -->
    <p class="text-dark">
    <span class="fw-bold">Categoria:</span>
    <?= $data['productos']['tipo_categoria'] ?>
</p>
<hr class="lineas">


    <a href="index.php?controlador=producto" class="btn btn-ver">Volver</a>

    </table>
  </div>

<?php require "views/shared/footer.php" ?>
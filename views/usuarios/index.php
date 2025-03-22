<?php require "views/shared/header.php" ?>

<div class="container cuerpo">
  <h1 class="text-center my-5"><?= $data['titulo'] ?></h1>
  <table class="table table-hover">
        <thead>
            <tr>
                <th>Usuarios</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['usuarios'] as $item) { ?>
                <tr>
                    <td><?= $item['nombre_usuario'] ?></td>
                    <td>
                        <a href="index.php?controlador=usuario&accion=view&id=<?= $item['id_usuario'] ?>" class="btn btn-info">Ver</a>
                        <a href="index.php?controlador=usuario&accion=edit&id=<?= $item['id_usuario'] ?>" class="btn btn-warning">Actualizar</a>
                        <a href="index.php?controlador=usuario&accion=delete&id=<?= $item['id_usuario'] ?>" class="btn btn-danger">Eliminar</a>
                    </td>
                </tr>
            <?php } ?>  
        </tbody>
    </table>
</div>

<script>
    function confirmarEliminacion(id) {
        if (confirm("¿Estás seguro de que deseas eliminar este producto? Esta acción no se puede deshacer.")) {
            window.location.href = "index.php?controlador=producto&accion=delete&id=" + id;
        }
    }
</script>
<?php require "views/shared/footer.php" ?>
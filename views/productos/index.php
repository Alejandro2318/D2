<?php require "views/shared/header.php" ?>

<?php
$alertasStock = [];

foreach ($data['productos'] as $item) {
    if ($item['cantidad_producto'] < 10) {
        $alertasStock[] = [
            'nombre' => $item['nombre_producto'],
            'cantidad' => $item['cantidad_producto']
        ];
    }
}
// ++++++++++alerta caducidad
$alertasCaducidad = [];

foreach ($data['productos'] as $item) {
    if (!empty($item['fecha_caducidad'])) {
        $fecha_actual = date("Y-m-d");
        $fecha_limite = date("Y-m-d", strtotime($fecha_actual . ' + 10 days'));

        if ($item['fecha_caducidad'] <= $fecha_limite) {
            $alertasCaducidad[] = [
                'nombre' => $item['nombre_producto'],
                'fecha' => $item['fecha_caducidad']
            ];
        }
    }
}

?>

<script>
    const alertasStock = <?= json_encode($alertasStock); ?>;
</script>
<!-- alerta caducidad -->
<script>
    const alertasCaducidad = <?= json_encode($alertasCaducidad); ?>;
</script>

<div class="container cuerpo">

    <h1 class="text-center my-5"><?= $data['titulo'] ?></h1>
    <table class="table table-hover">

        <thead>
            <tr>
                <th>Productos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['productos'] as $item) { ?>
                <tr>
                    <td><?= $item['nombre_producto'] ?></td>
                    <td>
                        <a href="index.php?controlador=producto&accion=view&id=<?= $item['id_producto'] ?>"
                            class="btn btn-info">Ver</a>
                        <?php if (isset($_SESSION['id_cargo']) && $_SESSION['id_cargo'] == 1) { ?>
                            <a href="index.php?controlador=producto&accion=edit&id=<?= $item['id_producto'] ?>"
                                class="btn btn-warning">Actualizar</a>
                            <a href="index.php?controlador=producto&accion=delete&id=<?= $item['id_producto'] ?>"
                                class="btn btn-danger"
                                onclick="event.preventDefault(); confirmarEliminacion(this.href, 'producto')">Eliminar</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php require "views/shared/footer.php" ?>
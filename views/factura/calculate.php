<?php require "views/shared/header.php" ?>

<div class="container cuerpo">
    <h1 class="text-center my-5"><?= $data['titulo'] ?></h1>

    <form method="get" action="index.php" id="filtro-fechas">
        <input type="hidden" name="controlador" value="factura">
        <input type="hidden" name="accion" value="calculate">
        <div class="row d-flex justify-content-center align-items-center gap-5">
            <div class="col-md-4">
                <label class="fechaRango" for="fecha_inicio">Desde:</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?= $_GET['fecha_inicio'] ?? '' ?>"
                    class="sm-form-control">
            </div>
            <div class="col-md-4">
                <label class="fechaRango" for="fecha_fin">Hasta:</label>
                <input type="date" id="fecha_fin" name="fecha_fin" value="<?= $_GET['fecha_fin'] ?? '' ?>"
                    class="sm-form-control">
            </div>
        </div>
    </form>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Total venta</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['totalVentaDia'] as $venta): ?>
                <tr>
                    <td><?= $venta['fecha'] ?></td>
                    <td>$<?= number_format($venta['total_ventas'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="index.php?controlador=factura&accion=calculate&pdf=1&fecha_inicio=<?= $_GET['fecha_inicio'] ?? '' ?>&fecha_fin=<?= $_GET['fecha_fin'] ?? '' ?>"
        class="btn btn-danger mb-3 imprimir" target="_blank">
        Imprimir
    </a>


</div>
<?php require "views/shared/footer.php" ?>


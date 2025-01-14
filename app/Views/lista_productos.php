<?= $this->extend('principal'); ?>

<?= $this->section('dinamico'); ?>

<div class="border border-primary rounded px-5 w-75 mx-auto bg-light bg-opacity-50 shadow text-center">

    <h4 class="my-3">Listado de Productos</h4>

    <table class="table table-striped table-bordered table-light">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Categoría</th>
                <th scope="col">Stock</th>
                <th scope="col">Precio</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($productos)) { ?>
                <?php foreach ($productos as $producto) { ?>
                    <tr>
                        <td><?= $producto['nombre'] ?></td>
                        <td><?= $producto['categoria'] ?></td>
                        <td><?= $producto['stock'] ?></td>
                        <td><?= $producto['precio'] ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.table').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ productos por página",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ productos totales)",
                "search": "Buscar:"
            }
        });
    })
</script>

<?= $this->endSection(); ?>
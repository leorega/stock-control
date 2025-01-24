<?= $this->extend('principal'); ?>

<?= $this->section('dinamico'); ?>

<div class="border border-info rounded px-1 w-75 mx-auto bg-info bg-opacity-50 shadow text-white text-center">

    <h4 class="my-3">Informes</h4>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">Fecha y Hora</th>
                <th scope="col">Tipo Movimiento</th>
                <th scope="col">Producto</th>
                <th scope="col">Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($movimientos)) { ?>
                <?php foreach ($movimientos as $producto) { ?>
                    <tr>
                        <td><?= date('d/m/Y H:i', strtotime($producto['fecha'])) ?></td>
                        <td><?= $producto['tipo'] ?></td>
                        <td><?= $producto['producto'] ?></td>
                        <td><?= $producto['cantidad'] ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
</div>

<!------------------------------------------------------------MODALES----------------------------------------------------->

<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar producto</h1>
            </div>
            <div class="modal-body alert alert-danger" role="alert">
                <p>¿Está seguro que desea eliminar el producto <i id="nombreProductoEliminar" class="fw-bold"></i> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="<?= site_url('eliminar-producto') ?>" method="post">
                    <input type="hidden" name="idProductoEliminar" id="idProductoEliminar">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('#modalEliminar').on('show.bs.modal', function(event) {
            let button = $(event.relatedTarget);
            let idProducto = button.data('id');
            let nombreProducto = button.data('nombre');
            $('#idProductoEliminar').val(idProducto);
            $('#nombreProductoEliminar').text(nombreProducto);
        });

        <?php if (session()->getFlashdata('success')) : ?>
            $('.modalMensaje-body').addClass('bg-success');
            $('.modalMensaje-body').html('<?= session()->getFlashdata('success') ?>');
            $('#modalMensaje').modal('show');
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')) : ?>
            $('.modalMensaje-body').addClass('bg-danger');
            $('.modalMensaje-body').html('<?= session()->getFlashdata('error') ?>');
            $('#modalMensaje').modal('show');
        <?php endif; ?>

        $('.table').DataTable({
            "scrollY": "45vh",
            "scrollCollapse": true,
            "paging": false,
            "info": false,
            "language": {
                "lengthMenu": "Mostrar _MENU_ productos por página",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ productos totales)",
                "search": "Buscar:"
            }
        });

        $('[data-toggle="tooltip"]').tooltip();
    })
</script>

<?= $this->endSection(); ?>
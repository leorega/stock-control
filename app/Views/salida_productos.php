<?= $this->extend('principal'); ?>

<?= $this->section('dinamico'); ?>

<div class="border border-warning rounded px-5 w-75 mx-auto bg-warning bg-opacity-50 text-white shadow text-center">

    <h4 class="my-3">Salida de Productos</h4>

    <form action="<?= site_url('confirmar-salida-producto') ?>" method="post" class="form">

        <div class="row d-flex justify-content-center">
            <div class="form-group col-4">
                <label for="nombreProductoSalida" class="form-label">Nombre:</label>
                <select name="nombreProductoSalida" id="nombreProductoSalida" class="form-control" required>
                    <option value="0">Seleccione un producto</option>
                    <?php foreach ($productos as $producto) { ?>
                        <option value="<?= $producto['id'] ?>" <?= old('nombreProductoSalida') == $producto['id'] ? 'selected' : '' ?>><?= $producto['nombre'] ?></option>
                    <?php } ?>
                </select>
                <p class="text-white bg-danger rounded mt-1"> <?= validation_show_error('nombreProductoSalida') ?> </p>
            </div>

            <div class="form-group col-2">
                <label for="cantidadProductoSalida" class="form-label">Cantidad:</label>
                <input type="number" name="cantidadProductoSalida" class="form-control" id="cantidadProductoSalida" value="<?= set_value('cantidadProductoSalida') ?>" required>
                <p class="text-white bg-danger rounded mt-1"> <?= validation_show_error('cantidadProductoSalida') ?> </p>
            </div>
        </div>
        <div class="d-flex justify-content-center p-4">
            <a href="<?= site_url('listar-productos') ?>" class="btn btn-danger mx-2">Cancelar</a>
            <button type="submit" class="btn btn-primary">Confirmar</button>
        </div>
    </form>

</div>

<!-----------------------------------------------------MODALES----------------------------------------------------->

<script type="text/javascript">
    $(document).ready(function() {
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
    })
</script>

<?= $this->endSection(); ?>
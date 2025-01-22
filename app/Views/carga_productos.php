<?= $this->extend('principal'); ?>

<?= $this->section('dinamico'); ?>

<div class="w-75 d-flex">

    <div class="border border-success rounded px-5 bg-success bg-opacity-50 text-white shadow text-center col-8 h-75">

        <h4 class="my-3">Carga de Productos</h4>

        <form action="<?= site_url('guardar-productos') ?>" method="post" class="form">
            <div class="row d-flex justify-content-center">
                <div class="form-group col-4">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <select name="nombre" id="nombreProducto" class="form-control" required>
                        <option value="0">Seleccione un producto</option>
                        <?php foreach ($productos as $producto) { ?>
                            <option value="<?= $producto['id'] ?>" <?= set_select('nombre', $producto['id']) ?>><?= $producto['nombre'] ?></option>
                        <?php } ?>
                    </select>
                    <p class="text-white bg-danger rounded mt-1"> <?= validation_show_error('nombre') ?> </p>
                </div>
                <div class="form-group col-4">
                    <label for="categoria" class="form-label">Categoría:</label>
                    <select name="categoria" id="categoriaProducto" class="form-control" required>
                        <option value="0">Seleccione una categoría</option>
                        <?php foreach ($categorias as $categoria) { ?>
                            <option value="<?= $categoria['id'] ?>" <?= set_select('categoria', $categoria['id']) ?>><?= $categoria['nombre'] ?></option>
                        <?php } ?>
                    </select>
                    <p class="text-white bg-danger rounded mt-1"> <?= validation_show_error('categoria') ?> </p>
                </div>
                <div class="form-group col-2">
                    <label for="cantidad" class="form-label">Cantidad:</label>
                    <input type="number" name="cantidad" class="form-control" id="cantidad" value="<?= set_value('cantidad') ?>" required>
                    <p class="text-white bg-danger rounded mt-1"> <?= validation_show_error('cantidad') ?> </p>
                </div>
            </div>
            <div class="d-flex justify-content-center p-4">
                <a href="<?= site_url('listar-productos') ?>" class="btn btn-danger mx-2">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>

    </div>

    <div class="col-4">
        <?= $this->include('nuevo_producto') ?>
        <?= $this->include('nueva_categoria') ?>
    </div>

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
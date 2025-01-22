<?= $this->extend('principal'); ?>

<?= $this->section('dinamico'); ?>

<div class="border border-primary rounded px-5 w-75 mx-auto bg-primary bg-opacity-50 shadow text-white text-center">

    <h4 class="my-3">Editar Producto</h4>

    <form action="<?= site_url('guardar-producto-editado') ?>" method="post">

        <input type="hidden" name="idProductoEditar" value="<?= $producto['id'] ?>">

        <div class="row">
            <div class="form-group col-4">
                <label for="nombreProductoEditar">Nombre del producto</label>
                <input type="text" class="form-control" id="nombreProductoEditar" name="nombreProductoEditar" value="<?= set_value('nombreProductoEditar', $producto['nombre']) ?>">
                <p class="text-white bg-danger rounded mt-1"><?= validation_show_error('nombreProductoEditar') ?></p>
            </div>

            <div class="form-group col-4">
                <label for="categoriaProductoEditar">Categoría</label>
                <select class="form-control" id="categoriaProductoEditar" name="categoriaProductoEditar">
                    <?php foreach ($categorias as $categoria) { ?>
                        <option value="<?= $categoria['id'] ?>" <?= $categoria['id'] == $producto['id_categoria'] ? 'selected' : '' ?>><?= $categoria['nombre'] ?></option>
                    <?php } ?>
                </select>
                <p class="text-white bg-danger rounded mt-1"><?= validation_show_error('categoriaProductoEditar') ?></p>
            </div>

            <div class="form-group col-2">
                <label for="stockProductoEditar">Stock</label>
                <input type="number" class="form-control" id="stockProductoEditar" name="stockProductoEditar" value="<?= $producto['stock'] ?>">
                <p class="text-white bg-danger rounded mt-1"><?= validation_show_error('stockProductoEditar') ?></p>
            </div>

            <div class="form-group col-2">
                <label for="precioProductoEditar">Precio</label>
                <input type="number" class="form-control" id="precioProductoEditar" name="precioProductoEditar" value="<?= $producto['precio'] ?>">
                <p class="text-white bg-danger rounded mt-1"><?= validation_show_error('precioProductoEditar') ?></p>
            </div>
        </div>

        <div>
            <a href="<?= site_url('listar-productos') ?>" class="btn btn-danger my-1">Cancelar</a>
            <button type="submit" class="btn btn-primary my-1">Guardar</button>
        </div>

    </form>

</div>

<!------------------------------------------------------------MODALES----------------------------------------------------->



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
<?= $this->extend('principal'); ?>

<?= $this->section('dinamico'); ?>

<div class="border border-primary rounded px-5 w-75 mx-auto bg-light bg-opacity-50 shadow text-center">

    <h4 class="my-3">Carga de Productos</h4>

    <form action="<?= site_url('cargar-productos') ?>" method="post" class="form">
        <div class="row">
            <div class="form-group col-4">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Ingrese nombre del producto" required>
            </div>
            <div class="form-group col-4">
                <label for="categoria" class="form-label">Categoría:</label>
                <input type="text" name="categoria" class="form-control" id="categoria" placeholder="Ingrese categoría del producto" required>
            </div>
            <div class="form-group col-2">
                <label for="stock" class="form-label">Cantidad:</label>
                <input type="number" name="stock" class="form-control" id="stock" required>
            </div>
            <div class="form-group col-2">
                <label for="precio" class="form-label">Precio:</label>
                <input type="number" name="precio" class="form-control" id="precio" required>
            </div>
        </div>
        <div class="d-flex justify-content-center p-4">
            <a href="<?= site_url('/') ?>" class="btn btn-danger mx-2">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>

</div>

<script type="text/javascript">
    $(document).ready(function() {

    })
</script>

<?= $this->endSection(); ?>
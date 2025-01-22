<div class="border border-success rounded px-5 bg-success bg-opacity-50 text-white shadow text-center">

    <h4 class="my-3">Nuevo Producto</h4>

    <form action="nuevo-producto" method="post">

        <div class="form-group">
            <label for="nombreProductoNuevo">Nombre:</label>
            <input
                type="text"
                class="form-control"
                id="nombreProductoNuevo"
                name="nombreProductoNuevo"
                value="<?= set_value('nombreProductoNuevo') ?>"
                required>
            <p class="text-white bg-danger rounded mt-1"><?= validation_show_error('nombreProductoNuevo') ?></p>
        </div>

        <button type="submit" class="btn btn-primary my-1">Guardar</button>

    </form>

</div>
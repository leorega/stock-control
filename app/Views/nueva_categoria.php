<div class="border border-success rounded px-5 bg-success bg-opacity-50 text-white shadow text-center">

    <h4 class="my-3">Nueva Categoría</h4>

    <form action="nueva-categoria" method="post">

        <div class="form-group">
            <label for="nombreCategoriaNueva">Nombre:</label>
            <input
                type="text"
                class="form-control"
                id="nombreCategoriaNueva"
                name="nombreCategoriaNueva"
                value="<?= set_value('nombreCategoriaNueva') ?>"
                required>
            <p class="text-white bg-danger rounded mt-1"><?= validation_show_error('nombreCategoriaNueva') ?></p>
        </div>

        <button type="submit" class="btn btn-primary my-1">Guardar</button>
    </form>
</div>
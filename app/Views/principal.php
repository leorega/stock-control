<?= $this->extend('layout'); ?>

<?= $this->section('contenido'); ?>

<div class="principal d-flex flex-column align-items-center">
    <h1 class="text-primary mt-1">Stock Control</h1>

    <?= $this->include('navegacion'); ?>

    <?= $this->renderSection('dinamico'); ?>

</div>

<!-----------------------------------------------------MODALES----------------------------------------------------->

<div class="modal fade" id="modalMensaje" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Stock Control</h1>
            </div>
            <div class="modal-body modalMensaje-body text-white">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
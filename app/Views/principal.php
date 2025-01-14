<?= $this->extend('layout'); ?>

<?= $this->section('contenido'); ?>

<div class="principal d-flex flex-column align-items-center pt-3">
    <h1 class="text-primary my-5">Stock Control</h1>

    <?= $this->renderSection('dinamico'); ?>

</div>

<?= $this->endSection(); ?>
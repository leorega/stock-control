<?= $this->extend('layout'); ?>

<?= $this->section('contenido'); ?>

<div class="principal d-flex flex-column align-items-center">
    <h1 class="text-primary mt-1">Stock Control</h1>

    <?= $this->include('navegacion'); ?>

    <?= $this->renderSection('dinamico'); ?>

</div>

<?= $this->endSection(); ?>
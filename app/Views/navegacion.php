<?= $this->extend('principal'); ?>

<?= $this->section('dinamico'); ?>

<div class="d-flex justify-content-around border border-primary rounded p-5 bg-light w-75 mx-auto bg-opacity-50 shadow">

    <a class="btn btn-success" href="<?= site_url('cargar-productos') ?>">Cargar Productos</a>

    <a class="btn btn-primary" href="<?= site_url('listar-productos') ?>">Listar Productos</a>

    <a class="btn btn-warning" href="<?= site_url('salida-productos') ?>">Salida de Productos</a>

</div>

<?= $this->endSection(); ?>
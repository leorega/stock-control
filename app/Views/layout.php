<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">

    <link href="<?= base_url('css/bootstrap-icons.css') ?>" rel="stylesheet">

    <link href="<?= base_url('css/estilos.css') ?>" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('css/datatables.min.css') ?>">

    <script src="<?= base_url('js/jquery-3.7.1.min.js') ?>"></script>

    <script src="<?= base_url('js/datatables.min.js') ?>"></script>

    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>

    <title>Stock Control</title>

</head>

<body class="d-flex flex-column min-vh-100">

    <main class="flex-fill w-100">
        <?= $this->renderSection('contenido'); ?>
    </main>

    <footer class="bg-dark text-center py-3">
        <p class="text-primary font-weight-bold m-0">&copy; <?php echo date('Y') ?> - Desarrollado por <a href="https://portfolio-leorega.vercel.app/" target="_blank">LeoRega!</a></p>
    </footer>
</body>

</html>
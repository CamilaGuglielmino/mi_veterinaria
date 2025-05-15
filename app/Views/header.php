


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Mi Veterinaria</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/css.css" rel="stylesheet">
</head>

<body>
    <header class="d-flex justify-content-between align-items-center p-3 bg-light border-bottom shadow-sm">
        <div class="left">
            <button class="btn btn-outline-secondary" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="right">
            <a href="<?php echo base_url('/'); ?>">
                <img src="icons/icons/logo.png" alt="logo" class="img-fluid" style="max-height: 50px;">
            </a>
        </div>
    </header>

    <div class="offcanvas offcanvas-start" id="sidebar">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Menú</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <nav>
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="<?php echo base_url('altas') ?>" class="d-flex align-items-center">
                            <img src="icons/icons/mas.png" alt="" class="me-2">
                            <span>Altas</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="<?php echo base_url('bajas') ?>" class="d-flex align-items-center">
                            <img src="icons/icons/eliminar.png" alt="" class="me-2">
                            <span>Bajas</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="<?php echo base_url('modificaciones') ?>" class="d-flex align-items-center">
                            <img src="icons/icons/tools.svg" alt="" class="me-2">
                            <span>Modificar</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="<?php echo base_url('amosMostrar') ?>" class="d-flex align-items-center">
                            <img src="icons/icons/search.svg" alt="" class="me-2">
                            <span>Mostrar</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>

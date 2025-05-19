<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Mi Veterinaria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/css.css" rel="stylesheet">
</head>

<body>
    <header class="d-flex justify-content-between align-items-center p-3 bg-light border-bottom shadow-sm">
        <div class="left">
            <button class="btn btn-outline-secondary" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#sidebar">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2 12.5a.5.5 0 0 1 0-1h12a.5.5 0 0 1 0 1H2Zm0-5a.5.5 0 0 1 0-1h12a.5.5 0 0 1 0 1H2Zm0-5a.5.5 0 0 1 0-1h12a.5.5 0 0 1 0 1H2Z" />
                </svg>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>
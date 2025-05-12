<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Mi Veterinaria</title>
    <link href="css/style.css" rel="stylesheet">

    <script src="js/scripts.js"></script>
</head>
<header>
    <div class="left">
        <div class="menu-container">
            <div class="menu" id="menu">
                <div></div>
                <div></div>
                <div></div>

            </div>
        </div>
       

    </div>
    <div class="right">

        <a href="<?php echo base_url('/'); ?>">
    <img src="icons/icons/logo.png" alt="logo">
</a>

    </div>
</header>
<div class="sidebar" id="sidebar">
    <nav>
        <ul>
            <li>
                <a href="<?php echo base_url('altas') ?>">
                    <img src="icons/icons/mas.png" alt="">
                    <span>Altas</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('bajas') ?>">
                    <img src="icons/icons/eliminar.png" alt="">
                    <span>Bajas</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('modificaciones') ?>">
                    <img src="icons/icons/tools.svg" alt="">
                    <span>Modificar</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('mostrar') ?>">

                    <img src="icons/icons/search.svg" alt="">
                    <span>Mostrar</span>
                </a>
            </li>
            
            </li>
        </ul>
    </nav>
</div>

</html>
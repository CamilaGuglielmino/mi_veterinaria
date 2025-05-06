<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Veterinaria CG</title>  
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
        <div class="brand">
            <a href="<?php echo base_url('inicio')?>">
            <img src="icons/icons/udemy.svg" alt="icon-udemy"class="logo">
            <span class="name">Veterinaria</span>
            </a>
        </div>

    </div>
    <div class="right">
        
        <img src="icons/icons/usuario.png" alt="usuario">

    </div>
</header>
<div class="sidebar" id="sidebar">
    <nav>
        <ul>
            <li>
                <a href="<?php echo base_url('altas')?>">
                    <img src="icons/icons/mas.png" alt="">
                    <span>Altas</span>
                </a>
            </li>
            <li>
            <a href="<?php echo base_url('bajas.php')?>">
                    <img src="icons/icons/eliminar.png" alt="">
                    <span>Bajas</span>
                </a>
            </li>
            <li>
            <a href="<?php echo base_url('modificaciones.php')?>">
                    <img src="icons/icons/tools.svg" alt="">
                    <span>Modificar</span>
                </a>
            </li>
            <li>
            <a href="<?php echo base_url('mostrar.php')?>">

                    <img src="icons/icons/search.svg" alt="">
                    <span>Mostrar</span>
                </a>
            </li>
        </ul>
    </nav>
</div>

</html>
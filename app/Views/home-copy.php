<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= base_url('assets/css/sidebar.css'); ?>">
    <style>
        html, body {
            height: 100%; /* Asegura que html y body ocupen el 100% de la altura */
            margin: 0; /* Elimina el margen predeterminado */
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .main-container {
            display: flex;
            flex-grow: 1; /* Ocupa el espacio restante */
            margin-left: 250px; /* Mueve el contenido para que no quede detrás del sidebar */
            margin-top: 58px;
        }
        .dropdown-menu {
            position: absolute !important;
        }

        .avatar {
            vertical-align: middle;
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }     
        
        .avatar-nav {
            vertical-align: middle;
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }  

        /*sidebar*/
        /*
        .nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
        }
        */
        /*
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100%;
            overflow-y: auto; 
            overflow-x: hidden; 
            display: flex;
            flex-direction: column;
        }
        */

        .navbar {
            position: fixed;
            left: 250px;
            width: calc(100% - 250px); /* Ajusta el ancho para que ocupe el espacio restante */
            transition: 0.6s ease;
            transition-property: left;
        }
        .menu {
            width: 100%; /* No se expande más de lo debido */
        }
        .menu .item {
            position: relative;
            cursor: pointer;
            width: 100%; /* Asegura que el ítem ocupe todo el ancho */
        }

        .menu .item a {
            font-size: 16px;
            text-decoration: none;
            display: block;
            padding: 2px 15px;
            line-height: 50px;
        }

        .item i {
            margin-right: 15px;
        }

        .item a .dropdown {
            position: absolute;
            right: 0;
            margin: 20px;
            transition: 0.3s ease;
        }

        .item .sub-menu {
            display: none;
        }

        /*
        .item .sub-menu a {
            padding-left: 80px;
        }
*/
        .rotate {
            transform: rotate(90deg);
        }



    </style>
</head>
<body>
    <nav class="navbar shadow-sm bg-primary">
        <div class="container-fluid d-flex justify-content-end">
            <!--
            <form class="d-flex" role="search">
                <input class="form-control me-2 border-0" type="search" placeholder="Search..." aria-label="Search">
                <button class="btn btn-subtle" type="submit"><i class="fa-solid fa-magnifying-glass fa-lg"></i></button>
            </form>
            -->
            <ul class="navbar-nav d-flex flex-row align-items-center">
                <li class="nav-item me-3">
                    <i class="fa-solid fa-bell fa-lg me-2 text-white"></i>
                </li>
                <li class="nav-item dropdown">
                    <a class="avatar-nav" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://picsum.photos/200" class="avatar-nav"/>
                        <!--<span class="avatar-badge border bg-red-300 p-1"></span>-->
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="<?= site_url('auth/logout') ?>">Cerrar sesión</a></li> 
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div class="main-container">
        <!--<ul class="nav flex-column bg-light shadow p-3 mb-6 bg-body">-->
        <ul class="nav flex-column sidebar p-3">    
            <div class="row g-3 p-0 mb-3 align-items-center stretched-row">
                <div class="col-auto">
                    <img src="https://picsum.photos/200" width="36" alt="Logo" />
                </div>
                <div class="col-auto ms-2">
                    <h4>Sistema</h4>
                </div>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <img src="https://picsum.photos/200" alt="Avatar" class="avatar">
                </div>
                <div class="col-auto ms-2">
                    <p class="fw-bold mb-0"><?= session('username'); ?></p>
                    <p class="mb-0">Cargo</p>
                </div>
            </div>
            <hr class="border border-1 opacity-50">

            <aside id="sidebar">
                <div class="d-flex">
                    <button class="toggle-btn" type="button">
                        <i class="lni lni-grid-alt"></i>
                    </button>
                    <div class="sidebar-logo">
                        <a href="#">CodzSword</a>
                    </div>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="lni lni-user"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="lni lni-agenda"></i>
                            <span>Task</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                            data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                            <i class="lni lni-protection"></i>
                            <span>Auth</span>
                        </a>
                        <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Login</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Register</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                            data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
                            <i class="lni lni-layout"></i>
                            <span>Multi Level</span>
                        </a>
                        <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two">
                                    Two Links
                                </a>
                                <ul id="multi-two" class="sidebar-dropdown list-unstyled collapse">
                                    <li class="sidebar-item">
                                        <a href="#" class="sidebar-link">Link 1</a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="#" class="sidebar-link">Link 2</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="lni lni-popup"></i>
                            <span>Notification</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="lni lni-cog"></i>
                            <span>Setting</span>
                        </a>
                    </li>
                </ul>
                <div class="sidebar-footer">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-exit"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </aside>
            <div class="main p-3">
                <div class="text-center">
                    <h1>
                        Sidebar Bootstrap 5
                    </h1>
                </div>
            </div>
            <!--
            <div class="menu">
                <div class="item"><a href=""><i class="fas fa-home"></i>Menú principal</a></div>

                <div class="item"><a class="sub-btn"><i class="fas fa-file-lines"></i>Constancias
                    <i class="fas fa-angle-right dropdown"></i>
                    <div class="sub-menu">
                        <a href="" class="sub-item">Sub item 01</a>
                        <a href="" class="sub-item">Sub item 02</a>
                        <a href="" class="sub-item">Sub item 03</a>
                    </div>
                    </a>
                </div>
                
                <div class="item"><a class="sub-btn"><i class="fas fa-file-arrow-up"></i>Carga de notas                
                    <i class="fas fa-angle-right dropdown"></i>
                    <div class="sub-menu">
                        <a href="" class="sub-item">Sub item 01</a>
                        <a href="" class="sub-item">Sub item 02</a>
                        <a href="" class="sub-item">Sub item 03</a>
                    </div>
                    </a>
                </div>

                <div class="item"><a class="sub-btn"><i class="fas fa-cog"></i>Administrar                
                    <i class="fas fa-angle-right dropdown"></i>
                    <div class="sub-menu">
                        <a href="" class="sub-item">Sub item 01</a>
                        <a href="" class="sub-item">Sub item 02</a>
                        <a href="" class="sub-item">Sub item 03</a>
                    </div>
                    </a>
                </div>

                <div class="item"><a href=""><i class="fas fa-circle-info"></i>Acerca</a></div>

                <div class="item"><a href=""><i class="fas fa-triangle-exclamation"></i>Reportar un Problema</a></div>
            </div>
        </ul>
        -->
        
        <div class="container-fluid bg-light p-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                </ol>
            </nav>

            <h3>Lorem itrsum</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean quis porta metus. Morbi ac ex nec odio lacinia pretium. Cras fringilla eu neque et interdum. Vestibulum egestas enim id lobortis elementum. Pellentesque aliquet purus non arcu bibendum interdum. Duis tempus dui vel nunc semper, ac euismod lorem tincidunt. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis vestibulum orci ligula, ac elementum nisi luctus et.</p>
            <!-- Content here -->
        </div>
      
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js" integrity="sha512-7Pi/otdlbbCR+LnW+F7PwFcSDJOuUJB3OxtEHbg4vSMvzvJjde4Po1v4BR9Gdc9aXNUNFVUY+SK51wWT8WF0Gg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            const hamBurger = document.querySelector(".toggle-btn");

            hamBurger.addEventListener("click", function () {
            document.querySelector("#sidebar").classList.toggle("expand");
            });

        })
    </script>
</body>
</html>
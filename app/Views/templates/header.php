    <div class="wrapper">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar">
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#"><?= esc(get_setting('system_name')) ?></a>
                </div>
                <div class="row g-2 sidebar-info">
                    <div class="col-auto">
                        <img src="<?= base_url('assets/images/default-avatar.png') ?>" alt="Avatar" class="avatar">
                    </div>
                    <div class="col-auto ms-2">
                        <p class="fw-bold mb-0"><?= session('username'); ?></p>
                        <p class="mb-0"><?= session('position'); ?></p>
                    </div>
                </div>
                <!-- Sidebar Navigation -->
                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a href="<?= site_url('home') ?>" class="sidebar-link">
                            <i class="hgi hgi-stroke hgi-home-11 pe-2 fs-5"></i>
                            Menú principal
                        </a>
                    </li>
                    <li class="sidebar-header">
                        Módulos
                    </li>
                    <li class="sidebar-item">
                        <a href="<?= site_url('records') ?>" class="sidebar-link">
                            <i class="hgi hgi-stroke hgi-file-01 pe-2 fs-5"></i>
                            Constancias
                        </a>
                    </li>
                    <li class="sidebar-header">
                        Tools & Components
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fa-solid fa-list pe-2"></i>
                            Profile
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#pages"
                            aria-expanded="false" aria-controls="pages">
                            <i class="fa-regular fa-file-lines pe-2"></i>
                            Pages
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Analytics</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Ecommerce</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Crypto</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard"
                            aria-expanded="false" aria-controls="dashboard">
                            <i class="fa-solid fa-sliders pe-2"></i>
                            Dashboard
                        </a>
                        <ul id="dashboard" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Dashboard Analytics</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Dashboard Ecommerce</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#auth"
                            aria-expanded="false" aria-controls="auth">
                            <i class="fa-regular fa-user pe-2"></i>
                            Auth
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
                    <li class="sidebar-header">
                        Administración
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#admin"
                            aria-expanded="false" aria-controls="admin">
                            <i class="hgi hgi-stroke hgi-microsoft-admin pe-2 fs-5"></i>
                            Administrar
                        </a>
                        <ul id="admin" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="<?= site_url('admin/settings') ?>" class="sidebar-link">Configuración</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="<?= site_url('admin/users') ?>" class="sidebar-link">Usuarios</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="<?= site_url('admin/employees') ?>" class="sidebar-link">Trabajadores</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-header">
                        Multi Level Nav
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#multi"
                            aria-expanded="false" aria-controls="multi">
                            <i class="fa-solid fa-share-nodes pe-2"></i>
                            Multi Level
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
                </ul>
            </div>
        </aside>
        <!-- Main Component -->
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom d-flex flex-row align-items-center">
                <!-- Button for sidebar toggle -->
                <button class="btn" type="button" data-bs-theme="light">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="ms-auto d-flex align-items-center">
                    <li class="nav-item me-3">
                        <i class="fa-solid fa-bell fa-lg me-2 text-primary"></i>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="avatar-nav" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= base_url('assets/images/default-avatar.png') ?>" class="avatar-nav"/>
                            <!--<span class="avatar-badge border bg-red-300 p-1"></span>-->
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="<?= site_url('auth/logout') ?>">Cerrar sesión</a></li> 
                        </ul>
                    </li>
                </div>
            </nav>
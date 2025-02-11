<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%; /* Asegura que html y body ocupen el 100% de la altura */
            margin: 0; /* Elimina el margen predeterminado */
        }
        body {
            display: flex;
            flex-direction: column;
        }
        .nav {
            width: 300px;
            height: 100%;
        }
        .main-container {
            display: flex;
            flex-grow: 1; /* Ocupa el espacio restante */
        }
        
    </style>
</head>
<body>
    <nav class="navbar shadow-sm bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand">
                <img src="/images/bootstrap-logo.svg" width="36" alt="Logo" />
            </a>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search">
                <button class="btn btn-subtle" type="submit"><i class="fa-solid fa-magnifying-glass fa-lg"></i></button>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="avatar" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="/images/avatar/1.jpg" />
                        <span class="avatar-badge border bg-red-300 p-1"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div class="main-container">
        <ul class="nav flex-column bg-light shadow p-3 mb-5 bg-body rounded">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Active</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('auth/logout') ?>">Cerrar sesión</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
            </li>
        </ul>
        
        <div class="container-fluid p-5">
            <h3>Lorem itrsum</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean quis porta metus. Morbi ac ex nec odio lacinia pretium. Cras fringilla eu neque et interdum. Vestibulum egestas enim id lobortis elementum. Pellentesque aliquet purus non arcu bibendum interdum. Duis tempus dui vel nunc semper, ac euismod lorem tincidunt. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis vestibulum orci ligula, ac elementum nisi luctus et.</p>
            <!-- Content here -->
        </div>
      
    </div>
</body>
</html>
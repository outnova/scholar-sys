<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        // Redirige automáticamente después de 5 segundos
        setTimeout(function() {
            window.location.href = '/login';
        }, 5000);
    </script>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <h2 class="text-success mb-4">✓</h2>
                        <h4 class="mb-3">Contraseña actualizada con éxito</h4>
                        <p>Por favor, inicia sesión nuevamente con tu nueva contraseña.</p>
                        <p class="text-secondary">Serás redirigido automáticamente en 5 segundos...</p>

                        <a href="/login" class="btn btn-primary mt-3">
                            Ir a la página de inicio de sesión ahora
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
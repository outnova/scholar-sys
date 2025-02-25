# Manual de Instalación - Scholar-sys

## Requisitos Previos

Antes de comenzar, asegúrate de tener instalado en tu sistema:

- **PHP** 8.0 o superior
- **Composer** (https://getcomposer.org/)
- **Git** (https://git-scm.com/)
- **Servidor Web** (XAMPP, Apache o Nginx)
- **Base de Datos** (MySQL o PostgreSQL)

## Paso 1: Clonar el Repositorio

Abre una terminal y ejecuta el siguiente comando para clonar el repositorio:

```bash
git clone https://github.com/outnova/scholar-sys.git
```

Luego, entra en la carpeta del proyecto:

```bash
cd scholar-sys
```

## Paso 2: Instalar Dependencias

Ejecuta el siguiente comando para instalar las dependencias del proyecto con Composer:

```bash
composer install
```

## Paso 3: Configurar el Entorno

Copia el archivo de configuración de entorno:

```bash
cp env .env
```

Abre el archivo `.env` con un editor de texto y asegúrate de configurar correctamente los siguientes valores:

```ini
CI_ENVIRONMENT = development

database.default.hostname = localhost
database.default.database = nombre_base_datos
database.default.username = usuario_bd
database.default.password = contraseña_bd
database.default.DBDriver = PostgreSQL  # O MySQL según tu caso
```

## Paso 4: Ejecutar Migraciones

Antes de ejecutar las migraciones, crea la base de datos usando el gestor de su preferencia usando la configuración que colocaste en el archivo `.env`

Luego, ejecuta las migraciones con el comando:

```bash
php spark migrate
```

Si hay datos de prueba (seeders), puedes ejecutarlos con:

```bash
php spark db:seed NombreDelSeeder
```

## Paso 5: Configurar Permisos

Asegúrate de que los directorios `writable` y `logs` tengan los permisos correctos: (esto es opcional)

```bash
chmod -R 777 writable
```

## Paso 6: Iniciar el Servidor Local

Para iniciar el servidor de desarrollo de CodeIgniter 4, usa:

```bash
php spark serve
```

El servidor correrá por defecto en `http://localhost:8080/`. Si deseas cambiar el puerto:

```bash
php spark serve --port=8000
```

## ¡Listo!

Ya puedes acceder a tu aplicación en el navegador.
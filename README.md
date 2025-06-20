# Proyecto Final Laravel 💻

Este repositorio corresponde al proyecto final de la materia **Desarrollo y Técnicas de Aplicaciones Web**.

## 🎯 Objetivo

Aplicar conocimientos sobre Laravel, integración de **CRUD**, **Roles y Permisos**, **LocalStorage**, **Manejo de eventos** y consumo de una **API** en una aplicación web funcional sobre peliculas.

## ⚙️ Funcionalidades

- Autenticación con usuario y contraseña.
- Panel de control con gestión de roles y permisos.
- Visualización de roles en una tabla con opciones para editar o eliminar.
- Integracion de API pubica.
- Manejo de CRUD de peliculas.
- Manejo de eventos javascript.


---

## 👨‍💻 Integrantes del equipo

| Nombre | Carnet |
|--------|--------|
| Alejandro Daniel Avalos Santamaria | AS19014 |
| Irvin Elias Torres Merlos | TM22012 |
| José Emmanuel Garcia Rodriguez | GR22081 |
| José Arnoldo Landaverde Gómez | LG22018 |
| José Mauricio Chavarría González | CG92088 |

---

## 🚀 Pasos para ejecutar el proyecto en local

Sigue estos pasos para poner en marcha el proyecto en tu entorno local:

### 1️⃣ Clonar el repositorio

```bash
git clone <url-del-repositorio>
cd <Parcial-3>
```

### 2️⃣ Instalar dependencias

Instala las dependencias del proyecto con Composer:

```bash
composer install
```

### 3️⃣ Configurar archivo de entorno

Copia el archivo `.env.example` y renómbralo a `.env`:

```bash
cp .env.example .env
```

Genera la clave de la aplicación:

```bash
php artisan key:generate
```

Configura en el `.env` la conexión a tu base de datos.

### 4️⃣ Ejecutar migraciones

Ejecuta las migraciones para crear las tablas necesarias:

```bash
php artisan migrate
```

### 5️⃣ Poblar la base de datos (opcional pero recomendado)

Si el proyecto incluye seeders para poblar datos iniciales, ejecuta:

```bash
php artisan db:seed
```

### 6️⃣ Iniciar el servidor de desarrollo

Finalmente, inicia el servidor de Laravel:

```bash
php artisan serve
```

Accede a la app en:

```
http://127.0.0.1:8000
```

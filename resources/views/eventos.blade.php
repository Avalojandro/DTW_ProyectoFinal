<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eventos JS</title>
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-4">
    <h2>Evento click</h2>
    <button id="miBoton" class="btn btn-primary">Hacer clic</button>

    <hr>

    <h2>Evento submit</h2>
    <form id="miFormulario">
        <input type="text" name="nombre" placeholder="El nombre" class="form-control mb-2">
        <button type="submit" class="btn btn-success">Enviar</button>
    </form>

    <hr>

    <h2>Evento change</h2>
    <select id="miSelect" class="form-select mb-3">
        <option value="">Seleccione</option>
        <option value="opcion1">Opción 1</option>
        <option value="opcion2">Opción 2</option>
    </select>

    <hr>

    <h2>Función JavaScript</h2>
    <button id="botonFuncional" class="btn btn-warning">Llamar la función</button>
</body>

</html>
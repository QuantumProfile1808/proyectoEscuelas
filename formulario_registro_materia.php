<?php
?>
<?php include "encabezado.php" // Incluye el encabezado de la página ?>
<div class="row">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/agregar-materia.css">
    <title>Agregar Materia</title>
</head>
<body>
    <div class="row">
        <div class="caja">
            <h1>Nueva Materia</h1>
            <!-- Formulario para registrar una nueva materia -->
            <form action="guardar_materia.php" method="POST">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <!-- Campo de texto para ingresar el nombre de la materia -->
                    <input name="nombre" required type="text" id="nombre" class="form-control" placeholder="Nombre">
                </div>
                <div class="form-group">
                    <!-- Botón para enviar el formulario y guardar los datos de la materia -->
                    <button class="btn boton-guardar" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php // include "pie.php" // Incluye el pie de página (actualmente comentado) ?>

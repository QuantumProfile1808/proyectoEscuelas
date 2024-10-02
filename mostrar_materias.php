<?php
// Incluye el archivo de conexión a la base de datos
include_once "conexion.php";
// Incluye el encabezado de la página
include_once "encabezado.php";
// Incluye la definición de la clase Materia
include_once "Materia.php";

// Verifica si se ha enviado un término de búsqueda
$terminoBusqueda = isset($_POST['busqueda']) ? $_POST['busqueda'] : '';
// Obtiene la lista de materias desde la base de datos, aplicando el filtro de búsqueda
$materias = Materia::obtener($terminoBusqueda);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/mostrar_estudiantes-estilos.css">
    <title>Materias</title>
</head>
<body>
<div class="contenido">
    <div class="titulo">
        <h1>Listado de materias</h1>
    </div>
    <div class="buscar-container">
        <!-- Botón para redirigir al formulario de registro de nueva materia -->
        <a href="formulario_registro_materia.php" class="btn boton-agregar">Nueva +</a>
        <!-- Formulario de búsqueda -->
        <form method="post" class="my-2">
            <input type="text" name="busqueda" value="<?php echo htmlspecialchars($terminoBusqueda); ?>" placeholder="Buscar materia" class="form-control" />
            <button type="submit" class="btn boton-buscar">Buscar</button>
        </form>
    </div>
    <div class="table-container">
        <table class="table-materias">
            <thead>
                <tr>
                    <th>Nombre</th> <!-- Encabezado para el nombre de la materia -->
                    <th>Mostrar</th> <!-- Encabezado para mostrar notas -->
                    <th>Acciones</th> <!-- Encabezado para eliminar materia -->
                </tr>
            </thead>
            <tbody>
                <?php if (empty($materias)) { // Verifica si la lista de materias está vacía ?>
                    <tr>
                        <td colspan="3" class="text-center">No hay materias registradas.</td> <!-- Mensaje cuando no hay materias -->
                    </tr>
                <?php } else { ?>
                    <?php foreach ($materias as $materia) { // Itera sobre cada materia ?>
                        <tr>
                            <td><?php echo htmlspecialchars($materia["nombre"]); ?></td> <!-- Muestra el nombre de la materia -->
                            <td>
                                <!-- Botón para mostrar notas asociadas a la materia -->
                                <a href="mostrar_notas.php?id=<?php echo $materia["id"]; ?>" class="btn boton-notas">Mostrar</a>
                            </td>
                            <td>
                                <!-- Botón para eliminar la materia -->
                                <a href="eliminar_materia.php?id=<?php echo $materia["id"] ?>" class="boton-eliminar">
                                    <img src="iconos/basura.png" alt="eliminar" class="icono">
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>



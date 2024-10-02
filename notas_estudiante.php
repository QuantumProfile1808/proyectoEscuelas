<?php
// Incluye el archivo de conexión a la base de datos
include_once "conexion.php";
// Incluye el encabezado de la página
include_once "encabezado.php";
// Incluye la definición de la clase Estudiante
include_once "Estudiante.php";
// Incluye la definición de la clase Materia
include_once "Materia.php";
// Incluye la definición de la clase Nota
include_once "Nota.php";

// Obtener los datos del estudiante a partir del ID en la URL
$estudiante = Estudiante::obtenerUno($_GET["id"]);
// Obtener la lista de materias
$materias = Materia::obtener();
// Obtener las notas del estudiante
$notas = Nota::obtenerDeEstudiante($estudiante->id);

// Combinar materias con sus respectivas notas
$materiasConCalificacion = Nota::combinar($materias, $notas);

// Contar la cantidad de materias
$cantidadMaterias = count($materiasConCalificacion);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/notas.css">
    <title>Establecer notas</title>
</head>
<body>
    
</body>
</html>
<div class="row">
    <div class="titulo">
        <h1>Notas de <?php echo htmlspecialchars($estudiante->nombre, ENT_QUOTES, 'UTF-8'); ?></h1> <!-- Muestra el nombre del estudiante -->
    </div>
    <div class="table-container">
        <?php if ($cantidadMaterias > 0): // Verifica si hay materias ?>
            <table class="table-notas">
                <thead>
                    <tr>
                        <th>Materia</th> <!-- Encabezado para el nombre de la materia -->
                        <th>Puntaje del examen</th> <!-- Encabezado para el puntaje del examen -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sumatoria = 0; // Inicializa la variable para la suma de puntajes
                    foreach ($materiasConCalificacion as $materia) { // Itera sobre cada materia con su calificación
                        $sumatoria += $materia["puntaje"]; // Suma el puntaje
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($materia["nombre"], ENT_QUOTES, 'UTF-8'); ?></td> <!-- Muestra el nombre de la materia -->
                            <td>
                                <form action="modificar_nota.php" method="POST" class="form-inline"> <!-- Formulario para modificar la nota -->
                                    <input type="hidden" name="id_estudiante" value="<?php echo (int)$estudiante->id; ?>"> <!-- ID del estudiante -->
                                    <input type="hidden" name="id_materia" value="<?php echo (int)$materia["id"]; ?>"> <!-- ID de la materia -->
                                    <input type="number" name="puntaje" value="<?php echo (int)$materia["puntaje"]; ?>" required min="0" class="form-control" placeholder="Escriba la calificación"> <!-- Campo para ingresar puntaje -->
                                    <button class="btn boton-guardar">Guardar</button> <!-- Botón para guardar la calificación -->
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td>Promedio</td>
                        <td>
                            <strong>
                                <?php
                                $promedio = $sumatoria / $cantidadMaterias; // Calcula el promedio
                                echo round($promedio, 2); // Muestra el promedio con 2 decimales
                                ?>
                            </strong>
                        </td>
                    </tr>
                </tfoot>
            </table>
        <?php else: // Si no hay materias ?>
            <div class="alert alert-warning">
                Falta agregar materias. <!-- Mensaje si no hay materias disponibles -->
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
?>

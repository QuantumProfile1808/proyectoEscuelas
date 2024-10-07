<?php

$host = "127.0.0.1:3306";
// Define el nombre de usuario para la conexión
$usuario = "root";
// Define la contraseña para la conexión
$contrasenia = "";

// Crea una nueva conexión a la base de datos MySQL
$conn_init = new mysqli($host, $usuario, $contrasenia);

// Verifica si hubo un error en la conexión
if ($conn_init->connect_errno) {

    // Si hay un error, muestra un mensaje con el error
    echo "Falló la conexión a MySQL: (" . $conn_init->connect_errno . ") " . $conn_init->connect_error;
}

// Crear la base de datos 'esquema' si no existe
$sql = "CREATE DATABASE IF NOT EXISTS sistema_gestion";
if ($conn_init->query($sql) === TRUE) {
    // Seleccionar la base de datos
    $conn_init->select_db("sistema_gestion");

    // Crear las tablas si no existen
    $tables = [
        "CREATE TABLE IF NOT EXISTS estudiantes (
            id BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
            nombre VARCHAR(255) NOT NULL,
            grupo VARCHAR(255) NOT NULL
        )",
        "CREATE TABLE IF NOT EXISTS materias (
            id BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
            nombre VARCHAR(255) NOT NULL
        )",
        "CREATE TABLE IF NOT EXISTS notas_estudiantes_materias (
            id BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
            id_estudiante BIGINT UNSIGNED NOT NULL,
            id_materia BIGINT UNSIGNED NOT NULL,
            puntaje DECIMAL(9,2) NOT NULL,
            FOREIGN KEY (id_estudiante) REFERENCES estudiantes(id) ON DELETE CASCADE ON UPDATE CASCADE,
            FOREIGN KEY (id_materia) REFERENCES materias(id) ON DELETE CASCADE ON UPDATE CASCADE
        )"
    ];

    // Ejecutar la creación de tablas
    foreach ($tables as $table) {
        if ($conn_init->query($table) !== TRUE) {
            echo "Error creando tabla: " . $conn->error;
        }
    }
} else {
    echo "Error creando base de datos: " . $conn->error;
}

// Cerrar la conexión
$conn_init->close();

// Redireccionar a mostrar_estudiantes.php
header("Location: index.html");
exit();
?>


<?php
header("Location: mostrar_estudiantes.php");

<?php
// Mostrar errores en pantalla para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conexión a la base de datos
$host = "localhost";
$usuario = "apiuser";
$contrasena = "api123";
$base_datos = "mantenimientodb";

// Crear conexión
$conn = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(["mensaje" => "Error de conexión: " . $conn->connect_error]));
}

// Cabecera para indicar respuesta en JSON
header('Content-Type: application/json');

// Recibir y decodificar datos JSON
$data = json_decode(file_get_contents("php://input"));

// Validar datos
if (!isset($data->nombre) || !isset($data->especialidad)) {
    echo json_encode(["mensaje" => "Faltan datos requeridos"]);
    exit;
}

$nombre = $data->nombre;
$especialidad = $data->especialidad;

// Insertar datos
$sql = "INSERT INTO operarios (nombre, especialidad) VALUES ('$nombre', '$especialidad')";
if ($conn->query($sql) === TRUE) {
    echo json_encode(["mensaje" => "Operario registrado con éxito"]);
} else {
    echo json_encode(["mensaje" => "Error al registrar operario: " . $conn->error]);
}

$conn->close();"Agregar registrar_operario.php"
?>

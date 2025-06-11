<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$usuario = "apiuser";
$contrasena = "api123";
$base_datos = "mantenimientodb";

$conn = new mysqli($host, $usuario, $contrasena, $base_datos);

if ($conn->connect_error) {
    die(json_encode(["mensaje" => "Error de conexión: " . $conn->connect_error]));
}

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->descripcion) || !isset($data->fecha) || !isset($data->equipo)) {
    echo json_encode(["mensaje" => "Faltan datos requeridos"]);
    exit;
}

$descripcion = $data->descripcion;
$fecha = $data->fecha;
$equipo = $data->equipo;

$sql = "INSERT INTO fallas (descripcion, fecha, equipo) VALUES ('$descripcion', '$fecha', '$equipo')";
if ($conn->query($sql) === TRUE) {
    echo json_encode(["mensaje" => "Falla registrada con éxito"]);
} else {
    echo json_encode(["mensaje" => "Error al registrar falla: " . $conn->error]);
}

$conn->close();"Agregar registrar_falla.php"

?>

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

if (!isset($data->id_falla) || !isset($data->id_operario)) {
    echo json_encode(["mensaje" => "Faltan datos requeridos"]);
    exit;
}

$id_falla = $data->id_falla;
$id_operario = $data->id_operario;

$sql = "INSERT INTO asignaciones (id_falla, id_operario) VALUES ($id_falla, $id_operario)";
if ($conn->query($sql) === TRUE) {
    echo json_encode(["mensaje" => "Asignación realizada con éxito"]);
} else {
    echo json_encode(["mensaje" => "Error al asignar operario: " . $conn->error]);
}

$conn->close();"Agregar asignar_operario.php"
?>

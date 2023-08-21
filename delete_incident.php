<?php
$conn = mysqli_connect("localhost", "root", "password", "service_availability");

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $incident_id = $_GET['id'];
	$service_id = $_GET['service_id'];


    $deleteQuery = "DELETE FROM incidents WHERE id = $incident_id";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {
        header("Location: incident_details.php?service_id=$service_id");
    } else {
        echo "Error al borrar el incidente: " . mysqli_error($conn);
    }
}
?>

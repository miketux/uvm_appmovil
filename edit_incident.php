<?php
$conn = mysqli_connect("localhost", "root", "password", "service_availability");

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $incident_id = $_GET['id'];
	$service_id = $_GET['service_id'];

    if (isset($_POST['update'])) {
        $newDescription = $_POST['new_description'];
		$service_id = $_POST['service_id'];

        $updateQuery = "UPDATE incidents SET description = '$newDescription' WHERE id = $incident_id";
        $updateResult = mysqli_query($conn, $updateQuery);

        if ($updateResult) {
            header("Location: incident_details.php?service_id=$service_id");
        } else {
            echo "Error al actualizar el incidente: " . mysqli_error($conn);
        }
    }

    $getIncidentQuery = "SELECT * FROM incidents WHERE id = $incident_id";
    $incidentResult = mysqli_query($conn, $getIncidentQuery);

    if (!$incidentResult) {
        echo "Error al obtener el incidente: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar incidente</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="header">
			<div class="header-ribbon">
				<a href="<?php echo 'services.php'; ?>" class="logo-link">
					<img src="logo.png" alt="Logo" class="logo">
				</a>
				<h2>Editar incidente</h2>
			</div>
        </div>
		<?php if ($incident = mysqli_fetch_assoc($incidentResult)) : ?>
		<form method="post" class="form-container">
			<label for="new_description">Nueva descripción:</label>
			<textarea name="new_description" id="new_description" rows="3" required><?php echo $incident['description']; ?></textarea>
			<input type="hidden" name="service_id" value="<?php echo $service_id; ?>"/>
			<br>
			<br>
			<button type="submit" name="update" class="form-submit">Actualizar incidente</button>
		</form>
		<?php else : ?>
			<p>Incidente no encontrado.</p>
		<?php endif; ?>
	</div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Incident Details</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="header">
			<div class="header-ribbon">
				<a href="<?php echo 'services.php'; ?>" class="logo-link">
					<img src="logo.png" alt="Logo" class="logo">
				</a>
				<h2>Detalles de incidentes</h2>
			</div>
        </div>
        <?php
        $host = "localhost";
        $username = "root";
        $password = "password";
        $database = "service_availability";

        $service_id = $_GET["service_id"];

        $conn = mysqli_connect($host, $username, $password, $database);

        if (!$conn) {
            die("Conexión fallida: " . mysqli_connect_error());
        }

		if (isset($_POST['create'])) {
			$description = $_POST['description'];

			$createQuery = "INSERT INTO incidents (service_id, description) VALUES ($service_id, '$description')";
			$createResult = mysqli_query($conn, $createQuery);

			if ($createResult) {
				header("Refresh:0"); 
			} else {
				echo "Error al crear el incidente: " . mysqli_error($conn);
			}
		}


        $query = "SELECT * FROM incidents WHERE service_id = $service_id ORDER BY incident_date DESC";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            echo "Error al obtener los incidentes: " . mysqli_error($conn);
        } else {
            if (mysqli_num_rows($result) > 0) {
				echo "<table class='incidents-table'>";
                echo "<tr><th>Fecha</th><th>Descripción</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["incident_date"] . "</td>";
                    echo "<td>" . $row["description"] . "</td>";
					echo "<td><a href='edit_incident.php?id={$row["id"]}&service_id={$service_id}'>Editar</a> | <a href='delete_incident.php?id={$row["id"]}&service_id={$service_id}' onclick='return confirm(\"¿Estás seguro?\")'>Eliminar</a></td>";
                    echo "</tr>";
                }
                echo "</table>";            } else {
                echo "No se encontraron incidentes para este servicio.";
            }
        }

        mysqli_close($conn);
        ?>
        <br>
		<br>
	<form method="post" class="form-container">
		<h3>Crear un nuevo incidente</h3>
		<label for="description">Descripción:</label>
		<textarea name="description" id="description" rows="3" required></textarea>
		<br>
		<br>
		<button type="submit" name="create" class="form-submit">Crear incidente</button>
	</form>
	    <br>
		<br>
        <a href="services.php"  class="btn">Regresar</a>
    </div>
</body>
</html>

<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

$host = "localhost";
$username = "root";
$password = "password";
$database = "service_availability";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$query = "SELECT * FROM services";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="styles.css">
    <title>Servicios</title>
</head>
<body>
    <div class="container">
        <div class="header">
			<div class="header-ribbon">
				<a href="<?php echo 'services.php'; ?>" class="logo-link">
					<img src="logo.png" alt="Logo" class="logo">
				</a>
				<h2>Disponibilidad de servicios</h2>
			</div>
        </div>
        <table class="services-table">
            <tr>
                <th>Nombre de servicio</th>
                <th>Disponibilidad</th>
            </tr>
			<?php
				while ($row = mysqli_fetch_assoc($result)) {
					$availabilityClass = $row["is_available"] ? "available" : "not-available";
					echo "<tr class='$availabilityClass'>";
					echo "<td><a href='incident_details.php?service_id={$row["id"]}'>" . $row["service_name"] . "</a></td>";
					echo "<td>" . ($row["is_available"] ? "Disponible" : "No disponible") . "</td>";
					echo "</tr>";
				}					
			?>
        </table>
        <br>
		<a href="logout.php" class="btn">Cerrar sesión</a>
    </div>
	<footer class="footer">
        UVM | Aplicaciones Móviles | Alejandra Aimee Rivas Montes | (c) <?php echo date("Y"); ?>
    </footer></body>
</html>

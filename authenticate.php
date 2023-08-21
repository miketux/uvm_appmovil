
<!DOCTYPE html>
<html>
<head>
    <title>Autenticación</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="header">
			<div class="header-ribbon">
				<a href="<?php echo isset($_SESSION['username']) ? 'services.php' : 'index.php'; ?>" class="logo-link">
					<img src="logo.png" alt="Logo" class="logo">
				</a>
				<h2>Autenticación</h2>
			</div>
        </div>
        <div class="form-container">
				<?php
				session_start();

				$host = "localhost";
				$username = "root";
				$password = "password";
				$database = "service_availability";

				$conn = mysqli_connect($host, $username, $password, $database);

				if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
				}

				if ($_SERVER["REQUEST_METHOD"] === "POST") {
					$username = $_POST["username"];
					$password = $_POST["password"];

					$query = "SELECT id FROM users WHERE username='$username' AND password='$password'";
					$result = mysqli_query($conn, $query);

					if (mysqli_num_rows($result) === 1) {
						$_SESSION["username"] = $username;
						header("Location: services.php");
					} else {
						echo "Credenciales inválidas. <a href='login.php'>Intenta de nuevo</a>";
					}
				}
				?>
		</div>
    </div>
    <footer class="footer">
        UVM | Aplicaciones Móviles | Alejandra Aimee Rivas Montes | (c) <?php echo date("Y"); ?>
    </footer>
</body>
</html>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="header">
			<div class="header-ribbon">
				<a href="<?php echo isset($_SESSION['username']) ? 'services.php' : 'index.php'; ?>" class="logo-link">
					<img src="logo.png" alt="Logo" class="logo">
				</a>
				<h2>Login</h2>
			</div>
        </div>
        <div class="form-container">
            <form action="authenticate.php" method="post">
                <div class="form-group">
                    <label for="username" class="form-label">Usuario:</label>
                    <input type="text" id="username" name="username" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" id="password" name="password" class="form-input" required>
                </div>
                <input type="submit" value="Iniciar" class="form-submit">
            </form>
        </div>
    </div>
	<footer class="footer">
        UVM | Aplicaciones Móviles | Alejandra Aimee Rivas Montes | (c) <?php echo date("Y"); ?>
    </footer>
</body>
</html>

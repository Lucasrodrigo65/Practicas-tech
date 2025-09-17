<?php
// Iniciar sesión al principio del script
session_start();

// Procesar el formulario de registro
$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $servername = "localhost";
    $database = "practicastech";
    $db_username = "root";
    $db_password = "";

    $conn = new mysqli($servername, $db_username, $db_password, $database);
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $nombre = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validar que las contraseñas coincidan
    if ($password !== $confirmPassword) {
        $error = "Las contraseñas no coinciden";
    } else {
        // Verificar si el email o el nombre de usuario ya existen
        $check = $conn->prepare("SELECT id FROM usuarios WHERE email = ? OR nombre = ?");
        $check->bind_param("ss", $email, $username);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = "El email o nombre de usuario ya están registrados";
        } else {
            // Hash de la contraseña
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insertar el nuevo usuario
            $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nombre, $email, $hashed_password);

            if ($stmt->execute()) {
                // Guardar el nombre de usuario en la sesión y redirigir
                $_SESSION['username'] = $username;
                header("Location: completar_habilidades.php");
                exit();
            } else {
                $error = "Error al registrar el usuario: " . $conn->error;
            }

            $stmt->close();
        }
        $check->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro - Prácticas Tech</title>
  <style>
    /* --- CSS tomado de login.html y adaptado --- */
    *{margin:0;padding:0;box-sizing:border-box}
    body{
      font-family:'Arial',sans-serif;
      background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);
      min-height:100vh;
      display:flex;align-items:center;justify-content:center;
      overflow:hidden;position:relative
    }
    .background-animation{position:fixed;top:0;left:0;width:100%;height:100%;z-index:1;overflow:hidden}
    .wave{position:absolute;width:200%;height:200%;background:linear-gradient(45deg,rgba(102,126,234,.1) 0%,rgba(118,75,162,.2) 25%,rgba(255,64,129,.15) 50%,rgba(64,196,255,.1) 75%,rgba(102,126,234,.1) 100%);animation:waveFlow 20s ease-in-out infinite;border-radius:50%}
    .wave:nth-child(2){animation-delay:-5s;animation-duration:25s;opacity:.7}
    .wave:nth-child(3){animation-delay:-10s;animation-duration:30s;opacity:.5}
    @keyframes waveFlow{0%,100%{transform:translateX(-50%) translateY(-50%) rotate(0) scale(1)}25%{transform:translateX(-45%) translateY(-55%) rotate(90deg) scale(1.1)}50%{transform:translateX(-50%) translateY(-50%) rotate(180deg) scale(.9)}75%{transform:translateX(-55%) translateY(-45%) rotate(270deg) scale(1.05)}}
    .login-container{background:rgba(255,255,255,.1);backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,.2);border-radius:24px;width:90%;max-width:1000px;min-height:600px;display:flex;box-shadow:0 25px 50px rgba(0,0,0,.3);position:relative;z-index:10;overflow:hidden}
    .login-panel{flex:1;padding:3rem;background:rgba(30,41,59,.95);backdrop-filter:blur(10px);display:flex;flex-direction:column;justify-content:center;position:relative;overflow-y:auto}
    .back-btn{position:absolute;top:20px;left:20px;background:none;border:none;color:rgba(255,255,255,.7);font-size:1.5rem;cursor:pointer}
    .back-btn:hover{color:#fff}
    .login-header h1{color:#fff;font-size:2rem;font-weight:700;margin-bottom:.5rem}
    .login-header p{color:rgba(255,255,255,.7);margin-bottom:2rem}
    .login-header p a{color:#667eea;text-decoration:none;font-weight:600}
    .form-group{margin-bottom:1.2rem}
    .form-group label{display:block;color:rgba(255,255,255,.8);margin-bottom:.4rem;font-weight:500}
    .form-input,.form-select{
      width:100%;padding:1rem;background:rgba(255,255,255,.1);
      border:1px solid rgba(255,255,255,.2);border-radius:12px;color:#fff;
      font-size:1rem;transition:.3s;
    }
    .form-input::placeholder{color:rgba(255,255,255,.5)}
    .form-input:focus,.form-select:focus{outline:none;border-color:#667eea;background:rgba(255,255,255,.15);box-shadow:0 0 20px rgba(102,126,234,.3)}
    .login-btn{width:100%;padding:1rem;background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:#fff;border:none;border-radius:12px;font-size:1.1rem;font-weight:600;cursor:pointer;transition:.3s}
    .login-btn:hover{transform:translateY(-2px);box-shadow:0 15px 30px rgba(102,126,234,.4)}
    .visual-panel{flex:1;background:linear-gradient(135deg,#1e293b 0%,#0f172a 100%);display:flex;align-items:center;justify-content:center;position:relative}
    .visual-content{z-index:5;text-align:center;color:#fff}
    .visual-content h2{font-size:2.3rem;font-weight:700;margin-bottom:1rem;background:linear-gradient(45deg,#667eea,#764ba2,#ff4081);-webkit-background-clip:text;-webkit-text-fill-color:transparent}
    @media(max-width:768px){.login-container{flex-direction:column;max-width:400px}.visual-panel{display:none}}

    /* Estilos para mensajes de error y éxito */
    .message {
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 5px;
      text-align: center;
    }
    .error {
      background-color: #f8d7da;
      color: #721c24;
    }
    .success {
      background-color: #d4edda;
      color: #155724;
    }
  </style>
</head>
<body>
  <div class="background-animation">
    <div class="wave"></div><div class="wave"></div><div class="wave"></div>
  </div>

  <div class="login-container">
    <!-- Panel de registro -->
    <div class="login-panel">
      <button class="back-btn" onclick="goBack()">&larr;</button>
      <div class="login-header">
        <h1>Crear Cuenta</h1>
        <p>Regístrate para acceder a empleos y pasantías en tecnología.<br>
        ¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
      </div>

      <?php if ($error): ?>
        <div class="message error"><?php echo $error; ?></div>
      <?php endif; ?>

      <?php if ($success): ?>
        <div class="message success"><?php echo $success; ?></div>
      <?php endif; ?>

      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
          <label for="fullname">Nombre completo</label>
          <input type="text" id="fullname" name="fullname" class="form-input" placeholder="Ej: Ana Pérez" required value="<?php echo isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : ''; ?>">
        </div>
        <div class="form-group">
          <label for="email">Correo electrónico</label>
          <input type="email" id="email" name="email" class="form-input" placeholder="ejemplo@correo.com" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
        </div>
        <div class="form-group">
          <label for="username">Usuario</label>
          <input type="text" id="username" name="username" class="form-input" placeholder="Elige un nombre de usuario" required value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
        </div>
        <div class="form-group">
          <label for="password">Contraseña</label>
          <input type="password" id="password" name="password" class="form-input" placeholder="Crea una contraseña" required>
        </div>
        <div class="form-group">
          <label for="confirmPassword">Confirmar contraseña</label>
          <input type="password" id="confirmPassword" name="confirmPassword" class="form-input" placeholder="Repite tu contraseña" required>
        </div>
        <button type="submit" class="login-btn">Registrarme</button>
      </form>
    </div>

    <!-- Panel derecho -->
    <div class="visual-panel">
      <div class="visual-content">
        <h2>Prácticas Tech</h2>
        <p>Conéctate con oportunidades de pasantías y empleos en programación.<br>
        Impulsa tu carrera en tecnología.</p>
      </div>
    </div>
  </div>

  <script>
    function goBack(){ window.location.href="index.php"; }
  </script>
</body>
</html>

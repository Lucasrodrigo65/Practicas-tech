<?php
session_start();

// Verificar si el usuario está logueado (redirigir si no)
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Procesar el formulario de habilidades
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
    
    // Obtener habilidades del formulario
    $habilidades = isset($_POST['habilidades']) ? implode(", ", $_POST['habilidades']) : "";
    $nivel = $_POST['nivel'] ?? "";
    $experiencia = isset($_POST['experiencia']) ? intval($_POST['experiencia']) : 0;
    $intereses = $_POST['intereses'] ?? "";
    $username = $_SESSION['username'];

    // Actualizar el perfil del usuario con las habilidades
    $stmt = $conn->prepare("UPDATE usuarios SET habilidades = ?, nivel_experiencia = ?, anos_experiencia = ?, intereses = ? WHERE nombre = ?");
    $stmt->bind_param("ssiss", $habilidades, $nivel, $experiencia, $intereses, $username);
    
    if ($stmt->execute()) {
        // Redirigir a la página principal después de guardar
        header("Location: sesioniniciada.php");
        exit();
    } else {
        $error = "Error al guardar las habilidades: " . $conn->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Completar Perfil - Prácticas Tech</title>
  <style>
    /* Mantener el mismo estilo que las otras páginas */
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

    /* Estilos para mensajes de error */
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

    /* Estilos para checkboxes de habilidades */
    .skills-container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
      gap: 10px;
      margin-bottom: 1.2rem;
    }
    .skill-checkbox {
      display: none;
    }
    .skill-checkbox + label {
      display: block;
      padding: 0.8rem;
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 8px;
      color: rgba(255, 255, 255, 0.8);
      text-align: center;
      cursor: pointer;
      transition: all 0.3s;
    }
    .skill-checkbox:checked + label {
      background: rgba(102, 126, 234, 0.3);
      border-color: #667eea;
      color: #fff;
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
        <h1>Completa tu Perfil</h1>
        <p>Cuéntanos sobre tus habilidades técnicas para personalizar tu experiencia.</p>
      </div>

      <?php if (isset($error)): ?>
        <div class="message error"><?php echo $error; ?></div>
      <?php endif; ?>

      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
          <label>Habilidades Técnicas</label>
          <div class="skills-container">
            <input type="checkbox" id="python" name="habilidades[]" value="Python" class="skill-checkbox">
            <label for="python">Python</label>
            
            <input type="checkbox" id="javascript" name="habilidades[]" value="JavaScript" class="skill-checkbox">
            <label for="javascript">JavaScript</label>
            
            <input type="checkbox" id="java" name="habilidades[]" value="Java" class="skill-checkbox">
            <label for="java">Java</label>
            
            <input type="checkbox" id="html" name="habilidades[]" value="HTML/CSS" class="skill-checkbox">
            <label for="html">HTML/CSS</label>
            
            <input type="checkbox" id="php" name="habilidades[]" value="PHP" class="skill-checkbox">
            <label for="php">PHP</label>
            
            <input type="checkbox" id="sql" name="habilidades[]" value="SQL" class="skill-checkbox">
            <label for="sql">SQL</label>
            
            <input type="checkbox" id="react" name="habilidades[]" value="React" class="skill-checkbox">
            <label for="react">React</label>
            
            <input type="checkbox" id="node" name="habilidades[]" value="Node.js" class="skill-checkbox">
            <label for="node">Node.js</label>
            
            <input type="checkbox" id="angular" name="habilidades[]" value="Angular" class="skill-checkbox">
            <label for="angular">Angular</label>
            
            <input type="checkbox" id="vue" name="habilidades[]" value="Vue.js" class="skill-checkbox">
            <label for="vue">Vue.js</label>
            
            <input type="checkbox" id="csharp" name="habilidades[]" value="C#" class="skill-checkbox">
            <label for="csharp">C#</label>
            
            <input type="checkbox" id="cplus" name="habilidades[]" value="C++" class="skill-checkbox">
            <label for="cplus">C++</label>
          </div>
        </div>
        
        <div class="form-group">
          <label for="nivel">Nivel de experiencia</label>
          <select id="nivel" name="nivel" class="form-select" required>
            <option value="">Selecciona tu nivel</option>
            <option value="Principiante">Principiante</option>
            <option value="Intermedio">Intermedio</option>
            <option value="Avanzado">Avanzado</option>
            <option value="Experto">Experto</option>
          </select>
        </div>
        
        <div class="form-group">
          <label for="experiencia">Años de experiencia</label>
          <input type="number" id="experiencia" name="experiencia" class="form-input" min="0" max="50" placeholder="Ej: 2">
        </div>
        
        <div class="form-group">
          <label for="intereses">Áreas de interés</label>
          <input type="text" id="intereses" name="intereses" class="form-input" placeholder="Ej: Desarrollo web, Inteligencia Artificial, DevOps...">
        </div>
        
        <button type="submit" class="login-btn">Completar Perfil</button>
      </form>
    </div>

    <!-- Panel derecho -->
    <div class="visual-panel">
      <div class="visual-content">
        <h2>Prácticas Tech</h2>
        <p>Completa tu perfil para encontrar oportunidades<br> 
        que coincidan con tus habilidades e intereses.</p>
      </div>
    </div>
  </div>

  <script>
    function goBack(){ window.location.href="registrarse.php"; }
  </script>
</body>
</html>
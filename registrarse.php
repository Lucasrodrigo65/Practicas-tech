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

      <form id="registerForm" onsubmit="handleRegister(event)">
        <div class="form-group">
          <label for="fullname">Nombre completo</label>
          <input type="text" id="fullname" class="form-input" placeholder="Ej: Ana Pérez" required>
        </div>
        <div class="form-group">
          <label for="email">Correo electrónico</label>
          <input type="email" id="email" class="form-input" placeholder="ejemplo@correo.com" required>
        </div>
        <div class="form-group">
          <label for="username">Usuario</label>
          <input type="text" id="username" class="form-input" placeholder="Elige un nombre de usuario" required>
        </div>
        <div class="form-group">
          <label for="role">Me registro como</label>
          <select id="role" class="form-select" required>
            <option value="">Selecciona una opción</option>
            <option value="candidato">Programador / Estudiante</option>
            <option value="empresa">Empresa / Reclutador</option>
          </select>
        </div>
        <div class="form-group">
          <label for="skills">Habilidades principales</label>
          <input type="text" id="skills" class="form-input" placeholder="Ej: JavaScript, Python, React">
        </div>
        <div class="form-group">
          <label for="password">Contraseña</label>
          <input type="password" id="password" class="form-input" placeholder="Crea una contraseña" required>
        </div>
        <div class="form-group">
          <label for="confirmPassword">Confirmar contraseña</label>
          <input type="password" id="confirmPassword" class="form-input" placeholder="Repite tu contraseña" required>
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

    function handleRegister(e){
      e.preventDefault();
      const pass=document.getElementById("password").value;
      const confirm=document.getElementById("confirmPassword").value;
      if(pass!==confirm){alert("Las contraseñas no coinciden");return;}
      alert("¡Registro exitoso! Ahora puedes iniciar sesión.");
      window.location.href="login.php";
    }
  </script>
</body>
</html>

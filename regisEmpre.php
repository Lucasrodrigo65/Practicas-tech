<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Empresa - Prácticas Tech</title>
  <style>
    *{margin:0;padding:0;box-sizing:border-box}
    body{
      font-family:'Arial',sans-serif;
      background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);
      min-height:100vh;display:flex;align-items:center;justify-content:center;
      overflow:hidden;position:relative
    }
    .background-animation{position:fixed;inset:0;z-index:1;overflow:hidden}
    .wave{position:absolute;width:200%;height:200%;
      background:linear-gradient(45deg,rgba(102,126,234,.1) 0%,rgba(118,75,162,.2) 25%,rgba(255,64,129,.15) 50%,rgba(64,196,255,.1) 75%,rgba(102,126,234,.1) 100%);
      animation:waveFlow 20s ease-in-out infinite;border-radius:50%}
    .wave:nth-child(2){animation-delay:-5s;animation-duration:25s;opacity:.7}
    .wave:nth-child(3){animation-delay:-10s;animation-duration:30s;opacity:.5}
    @keyframes waveFlow{0%,100%{transform:translate(-50%,-50%) rotate(0) scale(1)}
      25%{transform:translate(-45%,-55%) rotate(90deg) scale(1.1)}
      50%{transform:translate(-50%,-50%) rotate(180deg) scale(.9)}
      75%{transform:translate(-55%,-45%) rotate(270deg) scale(1.05)}}
    .container{position:relative;z-index:10;width:90%;max-width:1000px;display:flex;border-radius:24px;overflow:hidden;
      background:rgba(255,255,255,.1);backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,.2);box-shadow:0 25px 50px rgba(0,0,0,.3)}
    .panel{flex:1;padding:3rem;background:rgba(30,41,59,.95);color:#fff;position:relative}
    .panel h1{font-size:2rem;margin-bottom:.5rem}
    .panel p{color:rgba(255,255,255,.7);margin-bottom:1.5rem}
    .form-group{margin-bottom:1rem}
    label{display:block;margin-bottom:.4rem;color:rgba(255,255,255,.85)}
    input,select,textarea{
      width:100%;padding:1rem;border-radius:12px;border:1px solid rgba(255,255,255,.2);
      background:rgba(255,255,255,.1);color:#fff;font-size:1rem;outline:none;transition:.2s}
    input::placeholder,textarea::placeholder{color:rgba(255,255,255,.5)}
    input:focus,select:focus,textarea:focus{border-color:#667eea;box-shadow:0 0 20px rgba(102,126,234,.3)}
    .row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
    .btn{
      width:100%;margin-top:8px;padding:1rem;border-radius:12px;border:none;cursor:pointer;font-weight:700;
      background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:#fff;transition:.2s}
    .btn:hover{transform:translateY(-2px);box-shadow:0 15px 30px rgba(102,126,234,.4)}
    .side{
      flex:.95;display:flex;align-items:center;justify-content:center;padding:2rem;
      background:linear-gradient(135deg,#1e293b 0%,#0f172a 100%);color:#fff;text-align:center}
    .side h2{font-size:2.2rem;margin-bottom:.6rem;
      background:linear-gradient(45deg,#667eea,#764ba2,#ff4081);-webkit-background-clip:text;-webkit-text-fill-color:transparent}
    .link{color:#a5b4fc;text-decoration:none;font-weight:700}
    .btn-volver{
      position:absolute;left:16px;top:14px;background:none;border:none;
      color:#cbd5e1;font-size:20px;cursor:pointer;font-weight:bold
    }
    .btn-volver:hover{color:#fff;transform:scale(1.1)}
    @media (max-width:900px){.container{flex-direction:column;max-width:420px}.side{display:none}}
  </style>
</head>
<body>
  <div class="background-animation"><div class="wave"></div><div class="wave"></div><div class="wave"></div></div>

  <div class="container">
    <!-- Formulario empresa -->
    <section class="panel">
      <!-- Botón Volver -->
      <button class="btn-volver" onclick="window.location.href='index.php'">&larr; Volver</button>

      <h1>Registrar empresa</h1>
      <p>Crea tu cuenta de empresa para <b>publicar pasantías</b> y gestionar postulaciones.</p>

      <form id="empresaForm" onsubmit="registrarEmpresa(event)">
        <div class="form-group">
          <label for="razon">Razón social</label>
          <input id="razon" required placeholder="Ej: Innovación SA" />
        </div>

        <div class="row">
          <div class="form-group">
            <label for="fantasia">Nombre de fantasía</label>
            <input id="fantasia" placeholder="Ej: Innovatech" />
          </div>
          <div class="form-group">
            <label for="cuit">CUIT</label>
            <input id="cuit" placeholder="XX-XXXXXXXX-X" />
          </div>
        </div>

        <div class="row">
          <div class="form-group">
            <label for="industria">Industria</label>
            <select id="industria" required>
              <option value="">Selecciona una industria</option>
              <option>Software / SaaS</option>
              <option>Fintech</option>
              <option>Educación</option>
              <option>E-commerce</option>
              <option>Salud</option>
              <option>Otra</option>
            </select>
          </div>
          <div class="form-group">
            <label for="tamano">Tamaño</label>
            <select id="tamano">
              <option value="">Selecciona</option>
              <option>1-10</option><option>11-50</option><option>51-200</option>
              <option>201-500</option><option>500+</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="form-group">
            <label for="web">Sitio web</label>
            <input id="web" placeholder="https://empresa.com" />
          </div>
          <div class="form-group">
            <label for="linkedin">LinkedIn</label>
            <input id="linkedin" placeholder="https://linkedin.com/company/..." />
          </div>
        </div>

        <div class="form-group">
          <label for="descripcion">Descripción breve</label>
          <textarea id="descripcion" rows="3" placeholder="¿Qué hace tu empresa?"></textarea>
        </div>

        <hr style="border:none;border-top:1px solid rgba(255,255,255,.2);margin:10px 0 14px">

        <div class="row">
          <div class="form-group">
            <label for="reclutador">Nombre del reclutador</label>
            <input id="reclutador" required placeholder="Nombre y apellido" />
          </div>
          <div class="form-group">
            <label for="cargo">Cargo</label>
            <input id="cargo" placeholder="Ej: HR / Talent Acquisition" />
          </div>
        </div>

        <div class="row">
          <div class="form-group">
            <label for="email">Email de contacto</label>
            <input id="email" type="email" required placeholder="rrhh@empresa.com" />
          </div>
          <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input id="telefono" placeholder="+54 9 ..." />
          </div>
        </div>

        <div class="row">
          <div class="form-group">
            <label for="password">Contraseña</label>
            <input id="password" type="password" required placeholder="Crea una contraseña" />
          </div>
          <div class="form-group">
            <label for="password2">Confirmar contraseña</label>
            <input id="password2" type="password" required placeholder="Repite la contraseña" />
          </div>
        </div>

        <button class="btn" type="submit">Crear cuenta de empresa</button>
      </form>
    </section>

    <!-- Lateral -->
    <aside class="side">
      <div>
        <h2>Publica tus pasantías</h2>
        <p>Recibe postulaciones verificadas, filtra por skills y chatea con candidatos.</p>
        <p style="opacity:.75;margin-top:12px">¿Eres estudiante? <a class="link" href="registrarse.php">Regístrate aquí</a></p>
      </div>
    </aside>
  </div>

  <script>
    function registrarEmpresa(e){
      e.preventDefault();
      const p=document.getElementById('password').value;
      const p2=document.getElementById('password2').value;
      if(p!==p2){alert('Las contraseñas no coinciden');return;}
      alert('¡Empresa registrada! Ya puedes iniciar sesión y publicar pasantías.');
      window.location.href='login.php';
    }
  </script>
</body>
</html>

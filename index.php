<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Prácticas Tech | Encuentra pasantías y primeros empleos</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root{
      --bg:#ffffff;
      --ink:#0f172a;
      --muted:#475569;
      --line:#e2e8f0;
      --brand:#6b4eff;
      --brand-ink:#543bff;
      --chip:#f8fafc;
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0;
      font-family:"Inter",system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,"Helvetica Neue",Arial;
      color:var(--ink);
      background:var(--bg);
      line-height:1.6;
    }
    a{color:inherit;text-decoration:none}
    img{max-width:100%;display:block}

    .container{width:min(1120px,92%);margin-inline:auto}

    /* NAVBAR */
    .nav{position:sticky;top:0;background:#fff;z-index:40;border-bottom:1px solid var(--line)}
    .nav-wrap{display:flex;align-items:center;justify-content:space-between;padding:14px 0}
    .brand{display:flex;align-items:center;gap:10px;font-weight:800;font-size:20px}
    .brand .logo-dot{width:12px;height:12px;border-radius:50%;background:linear-gradient(135deg,#6b4eff,#a78bfa)}
    .nav-links{display:flex;gap:18px;align-items:center}
    .nav-links a{color:var(--muted);font-weight:600}
    .nav-links a:hover{color:var(--brand)}
    .btn{appearance:none;border:1px solid transparent;border-radius:999px;padding:10px 16px;font-weight:700;cursor:pointer;transition:.2s ease;display:inline-flex;align-items:center;gap:8px}
    .btn.primary{background:var(--brand);color:#fff}
    .btn.primary:hover{background:var(--brand-ink)}
    .btn.ghost{background:transparent;border-color:var(--line);color:var(--ink)}
    .btn.ghost:hover{border-color:var(--brand);color:var(--brand)}

    /* HERO */
    .hero{padding:64px 0;background:linear-gradient(180deg,#fbfbff,transparent 60%)}
    .hero-grid{display:grid;grid-template-columns:1.15fr .85fr;gap:48px;align-items:center}
    .badges{display:flex;flex-wrap:wrap;gap:10px;margin:0 0 14px}
    .badge{display:inline-flex;align-items:center;gap:8px;background:var(--chip);border:1px solid var(--line);padding:6px 10px;border-radius:999px;font-size:13px;color:#334155}
    .hero h1{font-size:clamp(28px,4.2vw,48px);line-height:1.15;margin:0 0 12px 0}
    .hero p{font-size:18px;color:var(--muted);margin:0 0 20px}
    .cta{display:flex;gap:12px;flex-wrap:wrap}
    .search{margin-top:16px;display:flex;gap:10px;flex-wrap:wrap}
    .search input{flex:1;min-width:240px;padding:12px 14px;border:1px solid var(--line);border-radius:12px}
    .search .btn{border-radius:12px}

    .hero-visual{position:relative;border-radius:24px;overflow:hidden;border:1px solid var(--line);background:#fff}
    .hero-visual img{aspect-ratio:1/1;object-fit:cover}
    .pin{position:absolute;display:grid;place-items:center;width:60px;height:60px;border-radius:50%;background:#fff;border:1px solid var(--line);box-shadow:0 6px 18px rgba(0,0,0,.06)}
    .pin small{font-size:11px;color:#64748b}
    .pin b{font-size:13px}
    .pin.p1{left:8%;top:10%}
    .pin.p2{right:10%;top:20%}
    .pin.p3{left:18%;bottom:10%}

    /* QUICK FILTERS */
    .quick{padding:24px 0}
    .chips{display:flex;flex-wrap:wrap;gap:10px}
    .chip{background:#fff;border:1px solid var(--line);padding:8px 12px;border-radius:999px;font-weight:600;color:#334155;cursor:pointer}
    .chip.active,.chip:hover{border-color:var(--brand);color:var(--brand)}

    /* CATEGORIES */
    .cats{padding:24px 0 56px;border-top:1px solid var(--line)}
    .cats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px}
    .cat{border:1px solid var(--line);border-radius:16px;padding:18px;background:#fff;transition:.2s ease;cursor:pointer}
    .cat:hover{transform:translateY(-3px);box-shadow:0 10px 22px rgba(2,6,23,.06)}
    .cat h3{margin:8px 0 6px;font-size:16px}
    .cat p{margin:0;color:#64748b;font-size:14px}

    /* JOB CARDS */
    .list{padding:16px 0 64px;border-top:1px solid var(--line)}
    .grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:18px}
    .card{border:1px solid var(--line);border-radius:16px;padding:16px;background:#fff;transition:.2s ease}
    .card:hover{transform:translateY(-4px);box-shadow:0 12px 26px rgba(2,6,23,.08)}
    .card .ico{width:48px;height:48px;border-radius:12px;background:linear-gradient(135deg,#6b4eff,#a78bfa);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800}
    .title{font-weight:800;margin:12px 0 4px}
    .meta{color:#64748b;font-size:14px;margin-bottom:10px}
    .desc{color:#475569;font-size:14px;margin-bottom:12px}
    .card .btn{width:100%;border-radius:10px}

    /* FOOTER */
    footer{border-top:1px solid var(--line);padding:36px 0;color:#475569}
    .foot-grid{display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:28px}
    .foot-grid h4{margin:0 0 10px;font-size:14px;color:#0f172a}
    .foot-grid a{display:block;padding:6px 0;color:#475569;font-size:14px}

    /* RESPONSIVE */
    @media (max-width: 960px){
      .hero{padding:40px 0}
      .hero-grid{grid-template-columns:1fr;gap:28px}
      .cats-grid{grid-template-columns:repeat(2,1fr)}
      .foot-grid{grid-template-columns:1fr 1fr}
    }
    @media (max-width:600px){
      .cats-grid{grid-template-columns:1fr}
      .nav-wrap{padding:10px 0}
      .nav-links{display:none}
    }
  </style>
</head>
<body>
  <!-- NAV -->
  <nav class="nav">
    <div class="container nav-wrap">
      <a class="brand" href="#">
        <span class="logo-dot"></span>
        <span>Prácticas<span style="color:var(--brand)">Tech</span></span>
      </a>
      <div class="nav-links">
        <a href="#oportunidades">Explorar pasantías</a>
        <a href="#" onclick="alert('Muy pronto: empresas publicando pasantías')">Empresas</a>
        <a href="#" onclick="alert('Recurso para estudiantes próximamente')">Recursos</a>
        <a class="btn ghost" href="login.php">Ingresar</a>
        <a class="btn primary" href="registrarse.php">Regístrate</a>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <header class="hero">
    <div class="container hero-grid">
      <div>
        <div class="badges">
          <span class="badge">🆓 Publicar es gratis</span>
          <span class="badge">✅ Garantía de satisfacción</span>
          <span class="badge">🔒 Perfiles verificados</span>
        </div>
        <h1>Conecta con <span style="color:var(--brand)">pasantías</span> y tu <span style="color:var(--brand)">primer empleo</span> en tecnología</h1>
        <p>Encuentra oportunidades reales en tu idioma y zona horaria. Postula en minutos; empresas y organizaciones educativas revisan tu perfil.</p>
        <div class="cta">
          <a class="btn primary" href="#oportunidades">Quiero aplicar</a>
          <a class="btn ghost" href="regisEmpre.php">Quiero publicar</a>
        </div>
        <div class="search">
          <input id="q" placeholder="Ej: Frontend, Python, QA, remoto..." />
          <button class="btn ghost" onclick="filtrar()">Buscar</button>
        </div>
        <div class="quick" aria-label="filtros rápidos">
          <div class="chips">
            <button class="chip active" onclick="setFiltro('todos')">Todos</button>
            <button class="chip" onclick="setFiltro('remoto')">Remoto</button>
            <button class="chip" onclick="setFiltro('frontend')">Frontend</button>
            <button class="chip" onclick="setFiltro('data')">Data / IA</button>
            <button class="chip" onclick="setFiltro('devops')">DevOps</button>
          </div>
        </div>
      </div>
      <div>
        <div class="hero-visual">
          <img alt="Estudiante en laptop" src="img/istockphoto-2105091005-612x612.jpg" />
        </div>
      </div>
    </div>
  </header>

  <!-- CATEGORIES -->
  <section class="cats">
    <div class="container">
      <div class="cats-grid">
        <article class="cat" onclick="setFiltro('frontend')">
          <div>🎨</div>
          <h3>Desarrollo Frontend</h3>
          <p>React, Vue, Angular y diseño de interfaces.</p>
        </article>
        <article class="cat" onclick="setFiltro('data')">
          <div>📈</div>
          <h3>Datos & IA</h3>
          <p>Python, SQL, ML, análisis y visualización.</p>
        </article>
        <article class="cat" onclick="setFiltro('devops')">
          <div>⚙️</div>
          <h3>DevOps & Cloud</h3>
          <p>Docker, Linux, CI/CD, AWS/Azure/GCP.</p>
        </article>
        <article class="cat" onclick="setFiltro('movil')">
          <div>📱</div>
          <h3>Móvil</h3>
          <p>React Native, Flutter, Kotlin, Swift.</p>
        </article>
      </div>
    </div>
  </section>

  <!-- LIST -->
  <section class="list" id="oportunidades">
    <div class="container">
      <div class="grid" id="grid"></div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <div class="container">
      <div class="foot-grid">
        <div>
          <div class="brand"><span class="logo-dot"></span><span>PrácticasTech</span></div>
          <p style="margin:10px 0 0">© <span id="y"></span> PrácticasTech. Todos los derechos reservados.</p>
        </div>
        <div>
          <h4>Producto</h4>
          <a href="#oportunidades">Explorar</a>
          <a href="#" onclick="alert('Próximamente: planes')">Planes</a>
          <a href="#" onclick="alert('Próximamente: preguntas frecuentes')">FAQ</a>
        </div>
        <div>
          <h4>Comunidad</h4>
          <a href="registrarse.php">Regístrate</a>
          <a href="login.php">Ingresa</a>
          <a href="#" onclick="alert('Próximamente: blog')">Blog</a>
        </div>
        <div>
          <h4>Legal</h4>
          <a href="#" onclick="alert('Próximamente: términos')">Términos</a>
          <a href="#" onclick="alert('Próximamente: privacidad')">Privacidad</a>
          <a href="#" onclick="alert('Próximamente: cookies')">Cookies</a>
        </div>
      </div>
    </div>
  </footer>

  <script>
    // Mock de oportunidades (puedes conectar a tu backend luego)
    const todas = [
      {id:1, titulo:"Pasantía Frontend (React)", empresa:"StartupVibe", tipo:"frontend", modalidad:"remoto", desc:"Crea componentes modernos y accesibles con React y CSS."},
      {id:2, titulo:"Pasantía Data Analyst", empresa:"DataFlow", tipo:"data", modalidad:"híbrido", desc:"Limpieza de datos, SQL y dashboards iniciales."},
      {id:3, titulo:"Pasantía DevOps Jr", empresa:"CloudTech", tipo:"devops", modalidad:"remoto", desc:"Automatiza pipelines y aprende contenedores."},
      {id:4, titulo:"Pasantía Mobile (Flutter)", empresa:"AppLab", tipo:"movil", modalidad:"presencial", desc:"Pantallas y estados en Flutter para app educativa."},
      {id:5, titulo:"Pasantía QA Manual", empresa:"QualityNow", tipo:"frontend", modalidad:"remoto", desc:"Casos de prueba, reportes y trabajo en equipo."},
    ];
    let filtro = "todos";

    function pintar(list){
      const grid = document.getElementById("grid");
      grid.innerHTML = "";
      list.forEach(job => {
        const el = document.createElement("article");
        el.className = "card";
        el.innerHTML = `
          <div class="ico">PT</div>
          <div class="title">${job.titulo}</div>
          <div class="meta">${job.empresa} • ${job.modalidad.toUpperCase()}</div>
          <div class="desc">${job.desc}</div>
          <a class="btn primary" href="registrarse.php">Postular</a>
        `;
        grid.appendChild(el);
      });
    }

    function setFiltro(f){ 
      filtro = f; 
      document.querySelectorAll(".chip").forEach(c=>c.classList.remove("active"));
      const map = {todos:0, remoto:1, frontend:2, data:3, devops:4};
      document.querySelectorAll(".chip")[map[f]].classList.add("active");
      filtrar();
    }

    function filtrar(){
      const q = (document.getElementById("q").value || "").toLowerCase();
      let base = [...todas];
      if (filtro!=="todos") base = base.filter(j=>j.tipo===filtro || j.modalidad===filtro);
      if (q) base = base.filter(j => j.titulo.toLowerCase().includes(q) || j.empresa.toLowerCase().includes(q) || j.desc.toLowerCase().includes(q));
      pintar(base);
    }

    document.addEventListener("DOMContentLoaded",()=>{
      pintar(todas);
      document.getElementById("y").textContent = new Date().getFullYear();
    });
  </script>
</body>
</html>

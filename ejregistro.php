<?php
// CONEXIÓN A LA BASE DE DATOS
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "practicastech";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Lista de provincias argentinas
$provincias = [
    "Buenos Aires", "Catamarca", "Chaco", "Chubut", "Córdoba", "Corrientes",
    "Entre Ríos", "Formosa", "Jujuy", "La Pampa", "La Rioja", "Mendoza",
    "Misiones", "Neuquén", "Río Negro", "Salta", "San Juan", "San Luis",
    "Santa Cruz", "Santa Fe", "Santiago del Estero", "Tierra del Fuego", "Tucumán"
];

// Variables de estado
$registroExitoso = null;
$mensajeError = null;
$mensaje = "";

// Procesamiento de la imagen (archivo o base64)
$ruta_destino = null;

// Imagen por archivo
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
    $archivo_tmp = $_FILES['foto']['tmp_name'];
    $nombre_archivo = basename($_FILES['foto']['name']);
    $directorio = "uploads/registro_personas";
    $extensiones_validas = ['jpg', 'jpeg', 'png', 'gif'];
    $extension = strtolower(pathinfo($nombre_archivo, PATHINFO_EXTENSION));

    if (in_array($extension, $extensiones_validas)) {
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }
        // Obtener datos para generar nombre del archivo
        $nombre_persona = $_POST['nombres'] ?? 'Usuario';
        $apellido_persona = $_POST['apellidos'] ?? '';

        // Limpiar y crear entidad
        $entidad = preg_replace('/[^A-Za-z0-9_-]/', '', $nombre_persona);
        if (!empty($apellido_persona)) {
            $apellido_limpio = preg_replace('/[^A-Za-z0-9_-]/', '', $apellido_persona);
            $entidad = $entidad . '_' . $apellido_limpio;
        }

        // Si no hay nombre válido, usar identificador genérico
        if (empty($entidad)) {
            $entidad = 'Persona';
        }

        // Generar fecha y hora
        $fecha_hora = date('Y-m-d_H-i-s');

        // Crear nombre final del archivo
        $nombre_archivo_final = $entidad . '_' . $fecha_hora . '.' . $extension;
        $ruta_destino = $directorio . '/' . $nombre_archivo_final;
        if (!move_uploaded_file($archivo_tmp, $ruta_destino)) {
            $mensaje = "❌ Error al guardar la imagen.";
        }
    } else {
        $mensaje = "❌ Solo se permiten archivos JPG, JPEG, PNG o GIF.";
    }
}

// Imagen capturada con cámara (base64)
elseif (!empty($_POST['imagen_base64'])) {
    $img_base64 = $_POST['imagen_base64'];
    if (preg_match('/^data:image\/(\w+);base64,/', $img_base64, $type)) {
        $extension = strtolower($type[1]);
        if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
            $img_base64 = substr($img_base64, strpos($img_base64, ',') + 1);
            $img_base64 = base64_decode($img_base64);
            if (!is_dir("uploads")) {
                mkdir("uploads", 0777, true);
            }
            // Obtener datos para generar nombre del archivo
            $nombre_persona = $_POST['nombres'] ?? 'Usuario';
            $apellido_persona = $_POST['apellidos'] ?? '';

            // Limpiar y crear entidad
            $entidad = preg_replace('/[^A-Za-z0-9_-]/', '', $nombre_persona);
            if (!empty($apellido_persona)) {
                $apellido_limpio = preg_replace('/[^A-Za-z0-9_-]/', '', $apellido_persona);
                $entidad = $entidad . '_' . $apellido_limpio;
            }

            // Si no hay nombre válido, usar identificador genérico
            if (empty($entidad)) {
                $entidad = 'Persona';
            }

            // Generar fecha y hora
            $fecha_hora = date('Y-m-d_H-i-s');

            // Crear nombre final del archivo
            $nombre_archivo_final = $entidad . '_' . $fecha_hora . '.' . $extension;
            $ruta_destino = "uploads/registro_personas/" . $nombre_archivo_final;
            if (!file_put_contents($ruta_destino, $img_base64)) {
                $mensaje = "❌ Error al guardar imagen de la cámara.";
            }
        } else {
            $mensaje = "❌ Formato de imagen de cámara no permitido.";
        }
    }
} else {
    $mensaje = "❌ No se seleccionó ninguna imagen ni se capturó.";
}

// Guardar en base de datos
if (isset($_POST['registrar'])) {
    $nombre = $_POST['nombres'] ?? '';
    $apellido = $_POST['apellidos'] ?? '';
    $dni = $_POST['dni'] ?? '';
    $fecha_nac = $_POST['fecha_nacimiento'] ?? '';
    $genero = $_POST['genero'] ?? '';
    $provincia = $_POST['provincia'] ?? '';
    $departamento = $_POST['departamento'] ?? '';
    $municipio = $_POST['municipio'] ?? '';
    $localidad = $_POST['localidad'] ?? '';
    $codigopostal = $_POST['codigopostal'] ?? '';
    $barrio = $_POST['barrio'] ?? '';
    $calle = $_POST['calle'] ?? '';
    $altura = $_POST['altura_calle'] ?? null;
    $latitud = $_POST['latitud'] ?? null;
    $longitud = $_POST['longitud'] ?? null;

    // Verificación previa: ¿el DNI ya está registrado?
    $verificarDNI = $conn->prepare("SELECT dni_persona FROM registro_persona WHERE dni_persona = ?");
    $verificarDNI->bind_param("s", $dni);
    $verificarDNI->execute();
    $verificarDNI->store_result();

    if ($verificarDNI->num_rows > 0) {
        // Ya existe una persona con ese DNI
        echo "<script>alert('⚠️ Ya existe una persona registrada con ese DNI.'); window.history.back();</script>";
        $verificarDNI->close();
        exit;
    }

    $verificarDNI->close();


    $sql = "INSERT INTO registro_persona 
        (nombre_persona, apellido_persona, dni_persona, fechanac_persona, genero_persona,
         provincia_persona, departamento_persona, municipio_persona,
         localidad_persona, codigo_postal, barrio_persona, calle_persona, altura_persona, latitud, longitud, imagen_persona)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
          $stmt->bind_param("ssssssssssssidds",
        $nombre, $apellido, $dni, $fecha_nac, $genero,
              $provincia, $departamento, $municipio, $localidad,
              $codigopostal, $barrio, $calle, $altura,
              $latitud, $longitud, $ruta_destino
        );

        if ($stmt->execute()) {
            $registroExitoso = true;
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
            exit;
        } else {
            $registroExitoso = false;
            $mensajeError = $stmt->error;
        }

        $stmt->close();
    } else {
        echo "<p style='color:red;'>❌ Error al preparar la consulta: " . $conn->error . "</p>";
    }
}

$provinciaSeleccionada = $_POST['provincia'] ?? '';
$departamentoSeleccionado = $_POST['departamento'] ?? '';
$campos = ($_SERVER['REQUEST_METHOD'] === 'POST') ? $_POST : [];

if (isset($_GET['success']) && $_GET['success'] == 1) {
    $registroExitoso = true;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Persona con Georeferencia</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Agregar esta línea después de Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    body {
      background-color: #eaf4fb;
    }
    .form-container {
      background-color: #fff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      margin-top: 20px;
      margin-bottom: 20px;
    }
    .form-label {
      font-weight: 500;
    }
    #map {
      height: 400px;
      width: 100%;
      border-radius: 10px;
      margin-bottom: 20px;
    }
    .map-container {
      margin-top: 20px;
    }
    .filter-controls {
      background-color: white;
      padding: 10px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      margin-bottom: 10px;
    }
    .coordinates-info {
      font-size: 0.9rem;
      color: #6c757d;
      margin-top: 5px;
    }
  </style>
</head>
<body>

<!-- ENCABEZADO -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
  <div class="container">
  <a class="navbar-brand"></i> Practicas Tech </a> <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Alternar navegación">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-3">
  <a href="registroperso.php" class="text-primary text-decoration-none d-inline-flex align-items-center">
    <i class="bi bi-arrow-left me-2"></i> Volver al Registro
  </a>
</div>


  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="form-container">
          <h2 class="text-center text-primary mb-4">Registro de Persona con Georeferencia</h2>
          
          <?php if (isset($registroExitoso)): ?>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      <?php if ($registroExitoso === true): ?>
        Swal.fire({
          icon: 'success',
          title: '¡Éxito!',
          text: '✅ Registro guardado correctamente.',
          confirmButtonText: 'Aceptar'
        });
      <?php elseif ($registroExitoso === false): ?>
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: '❌ <?= htmlspecialchars($mensajeError, ENT_QUOTES) ?>',
          confirmButtonText: 'Intentar nuevamente'
        });
      <?php endif; ?>
    });
  </script>
<?php endif; ?>


          <!-- <div class="text-center mb-4">
  <input type="file" name="foto" id="foto" accept="image/*" hidden>
  <label for="foto" class="d-block">
    <div id="preview" class="rounded-circle mx-auto" style="width: 100px; height: 100px; background-color: #f0f0f0; background-size: cover; background-position: center; border: 2px solid #ddd; display: flex; align-items: center; justify-content: center;">
      <i class="bi bi-person" style="font-size: 2rem; color: #999;"></i>
    </div>
    <small class="text-primary d-block mt-1"><i class="bi bi-camera"></i> Subir foto Persona</small>
  </label>
</div> -->
<?php
$mensaje = "";
?>

          <div class="map-container">
            <div id="map"></div>
            <div class="filter-controls">
              <div class="row g-2">
                <div class="col-md-4">
                  <label class="form-label">Filtrar por provincia:</label>
                  <select id="filter-province" class="form-select">
                    <option value="">Todas</option>
                    <?php foreach ($provincias as $prov): ?>
                      <option value="<?= $prov ?>"><?= $prov ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Filtrar por localidad:</label>
                  <input type="text" id="filter-locality" class="form-control" placeholder="Nombre de localidad">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                  <button id="filter-btn" class="btn btn-primary w-100">Filtrar</button>
                </div>
              </div>
            </div>
          </div>

          <form method="POST" action="EJREGISTRO.php" enctype="multipart/form-data">
            <div class="row g-3">
              <!-- Datos personales -->
              <div class="col-md-6">
  <label class="form-label">Nombres</label>
  <input type="text" id="nombre" name="nombres" class="form-control" required
         value="<?= htmlspecialchars($campos['nombres'] ?? '') ?>">
  <div id="error-nombre" class="text-danger" style="display: none;">
    Ingrese un nombre válido (solo letras, sin caracteres especiales, sin espacios al inicio o múltiples).
  </div>
</div>

<div class="col-md-6">
  <label class="form-label">Apellidos</label>
  <input type="text" id="apellido" name="apellidos" class="form-control" required
         value="<?= htmlspecialchars($campos['apellidos'] ?? '') ?>">
  <div id="error-apellido" class="text-danger" style="display: none;">
    Ingrese un apellido válido (solo letras, sin caracteres especiales, sin espacios al inicio o múltiples).
  </div>
</div>

              
              <!-- Campos de ubicación -->
              <div class="col-md-4">
                <label class="form-label">Provincia</label>
                <input type="text" id="provincia" name="provincia" class="form-control" required value="<?= htmlspecialchars($campos['provincia'] ?? '') ?>">
              </div>
              <div class="col-md-4">
                <label class="form-label">Departamento</label>
                <input type="text" id="departamento" name="departamento" class="form-control" required value="<?= htmlspecialchars($campos['departamento'] ?? '') ?>">
              </div>
              <div class="col-md-4">
                <label class="form-label">Municipio</label>
                <input type="text" id="municipio" name="municipio" class="form-control" required value="<?= htmlspecialchars($campos['municipio'] ?? '') ?>">
              </div>
              
              <div class="col-md-4">
                <label class="form-label">Localidad</label>
                <input type="text" id="localidad" name="localidad" class="form-control" required value="<?= htmlspecialchars($campos['localidad'] ?? '') ?>">
              </div>
              <div class="col-md-4">
                <label class="form-label">CodigoPostal</label>
                <input type="text" id="codigopostal" name="codigopostal" class="form-control" required value="<?= htmlspecialchars($campos['codigopostal'] ?? '') ?>">
              </div>
              <div class="col-md-4">
                <label class="form-label">Barrio</label>
                <input type="text" id="barrio" name="barrio" class="form-control" required value="<?= htmlspecialchars($campos['barrio'] ?? '') ?>">
              </div>
              <div class="col-md-4">
                <label class="form-label">Calle</label>
                <input type="text" id="calle" name="calle" class="form-control" required value="<?= htmlspecialchars($campos['calle'] ?? '') ?>">
              </div>
              
              <div class="col-md-6">
                <label class="form-label">Altura</label>
                <input type="number" id="altura" name="altura_calle" class="form-control" min="0" max="1000" step="1" required value="<?= htmlspecialchars($campos['altura_calle'] ?? '') ?>">
              </div>
              <div class="col-md-6">
                <label class="form-label">Coordenadas</label>
                <input type="text" id="coordenadas" class="form-control" readonly>
                <div class="coordinates-info">Haz clic en el mapa para seleccionar ubicación</div>
                <input type="hidden" id="latitud" name="latitud" value="<?= htmlspecialchars($campos['latitud'] ?? '') ?>">
                <input type="hidden" id="longitud" name="longitud" value="<?= htmlspecialchars($campos['longitud'] ?? '') ?>">
              </div>
              
              <!-- Resto de campos del formulario -->
              <div class="col-md-6">
  <label class="form-label">DNI</label>
  <input type="text" id="dni" name="dni" class="form-control" required
         value="<?= htmlspecialchars($campos['dni'] ?? '') ?>">
  <div id="error-dni" class="text-danger" style="display: none;">
    Ingrese un DNI válido (solo números, 7 u 8 dígitos).
  </div>
</div>

              <div class="col-md-6">
  <label class="form-label">Fecha de nacimiento</label>
  <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" required
         value="<?= htmlspecialchars($campos['fecha_nacimiento'] ?? '') ?>">
  <div class="invalid-feedback">Debe tener entre 18 y 100 años.</div>
</div>
              
              <div class="col-md-6">
                <label class="form-label">Género</label>
                <select class="form-select" name="genero" required>
                  <option value="">Seleccione</option>
                  <option value="M" <?= ($campos['genero'] ?? '') == 'M' ? 'selected' : '' ?>>Masculino</option>
                  <option value="F" <?= ($campos['genero'] ?? '') == 'F' ? 'selected' : '' ?>>Femenino</option>
                  <option value="Otros" <?= ($campos['genero'] ?? '') == 'Otros' ? 'selected' : '' ?>>Otro</option>
                </select>
              </div>


              <div class="col-md-12">
  <label class="form-label">Subir foto o capturar con cámara</label>
  
  <!-- Vista previa de la imagen -->
  <div class="text-center mb-3">
    <div id="preview-container" style="display: none;">
      <img id="preview-image" src="/placeholder.svg" alt="Vista previa" style="max-width: 200px; max-height: 200px; border: 2px solid #ddd; border-radius: 10px; object-fit: cover;">
      <div class="mt-2">
        <small class="text-muted">Vista previa de la imagen seleccionada</small>
        <br>
        <button type="button" id="remove-image" class="btn btn-sm btn-outline-danger mt-1">
          <i class="bi bi-trash"></i> Quitar imagen
        </button>
      </div>
    </div>
  </div>
  
  <!-- Input clásico de archivo -->
  <input type="file" name="foto" id="foto" accept="image/*" class="form-control mb-2">

  <!-- Botón para abrir cámara -->
  <button type="button" id="abrirCamara" class="btn btn-secondary mb-2">📷 Usar Cámara</button>

  <!-- Vista previa y captura -->
  <div id="contenedorCamara" style="display:none;">
    <video id="video" autoplay style="width: 100%; max-width: 400px;"></video>
    <br>
    <button type="button" id="capturar" class="btn btn-sm btn-success mt-2">📸 Capturar Foto</button>
    <!-- Botón para cancelar -->
    <button type="button" id="cancelarCaptura" class="btn btn-sm btn-danger mt-2">❌ Cancelar</button>
    <canvas id="canvas" style="display:none;"></canvas>
  </div>

  <!-- Campo oculto para imagen capturada -->
  <input type="hidden" name="imagen_base64" id="imagen_base64">
</div>

<script>
  const video = document.getElementById('video');
  const canvas = document.getElementById('canvas');
  const imagenBase64 = document.getElementById('imagen_base64');
  const contenedorCamara = document.getElementById('contenedorCamara');
  const abrirCamara = document.getElementById('abrirCamara');
  const capturar = document.getElementById('capturar');
  const cancelar = document.getElementById('cancelarCaptura');
  const inputFile = document.getElementById('foto');
  
  // Elementos para preview de archivo
  const previewContainer = document.getElementById('preview-container');
  const previewImage = document.getElementById('preview-image');
  const removeImageBtn = document.getElementById('remove-image');

  let streamActual = null;

  // Preview de imagen desde archivo
  inputFile.addEventListener('change', function(e) {
    const file = e.target.files[0];
    
    if (file) {
      // Validar tipo de archivo
      const tiposValidos = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
      if (!tiposValidos.includes(file.type)) {
        Swal.fire({
          icon: 'error',
          title: 'Tipo de archivo no permitido',
          text: '❌ Solo se permiten imágenes JPG, JPEG, PNG o GIF.',
          confirmButtonColor: '#d33'
        });
        this.value = '';
        previewContainer.style.display = 'none';
        return;
      }
      
      // Validar tamaño (máximo 5MB)
      if (file.size > 5 * 1024 * 1024) {
        Swal.fire({
          icon: 'error',
          title: 'Archivo muy grande',
          text: '❌ La imagen no debe superar los 5MB.',
          confirmButtonColor: '#d33'
        });
        this.value = '';
        previewContainer.style.display = 'none';
        return;
      }
      
      // Mostrar preview
      const reader = new FileReader();
      reader.onload = function(e) {
        previewImage.src = e.target.result;
        previewContainer.style.display = 'block';
        
        // Limpiar imagen de cámara si existe
        imagenBase64.value = '';
        contenedorCamara.style.display = 'none';
        if (streamActual) {
          streamActual.getTracks().forEach(track => track.stop());
        }
      };
      reader.readAsDataURL(file);
    } else {
      previewContainer.style.display = 'none';
    }
  });

  // Quitar imagen seleccionada
  removeImageBtn.addEventListener('click', function() {
    inputFile.value = '';
    previewContainer.style.display = 'none';
    imagenBase64.value = '';
    
    Swal.fire({
      icon: 'info',
      title: 'Imagen eliminada',
      text: 'La imagen ha sido quitada del formulario.',
      confirmButtonColor: '#3085d6'
    });
  });

  abrirCamara.addEventListener('click', () => {
    // Limpiar preview de archivo si existe
    inputFile.value = '';
    previewContainer.style.display = 'none';
    
    contenedorCamara.style.display = 'block';
    navigator.mediaDevices.getUserMedia({ video: true })
      .then(stream => {
        video.srcObject = stream;
        streamActual = stream;
      })
      .catch(err => alert("No se pudo acceder a la cámara: " + err));
  });

  capturar.addEventListener('click', () => {
    canvas.style.display = 'block';
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    const ctx = canvas.getContext('2d');
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
    imagenBase64.value = canvas.toDataURL('image/jpeg');

    // Ocultar cámara después de capturar
    contenedorCamara.style.display = 'none';
    if (streamActual) {
      streamActual.getTracks().forEach(track => track.stop());
    }

    Swal.fire({
      icon: 'success',
      title: '📸 Foto capturada correctamente',
      text: 'La imagen se guardará al registrar.',
      confirmButtonColor: '#3085d6'
    });
  });

  cancelar.addEventListener('click', () => {
    // Detener cámara
    if (streamActual) {
      streamActual.getTracks().forEach(track => track.stop());
    }

    // Ocultar y limpiar
    contenedorCamara.style.display = 'none';
    canvas.style.display = 'none';
    video.srcObject = null;
    imagenBase64.value = '';

    Swal.fire({
      icon: 'info',
      title: 'Captura cancelada',
      text: 'La cámara fue cerrada y los campos fueron limpiados.',
      confirmButtonColor: '#3085d6'
    });
  });
</script>


              <div class="mt-4">
                <div class="row">
    <div class="col-md-6 text-center">
      <a href="indexadmin.php" class="btn btn-outline-secondary" style="width: 180px;">
        <i class="bi bi-arrow-left"></i> Cancelar
      </a>
    </div>
    <div class="col-md-6 text-center">
      <button type="submit" name="registrar" class="btn btn-primary" style="width: 180px;">
        <i class="bi bi-check-circle"></i> Registrar
      </button>
    </div>
  </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- FOOTER -->
<footer class="bg-primary text-white mt-5">
  <div class="container text-center py-4">
    <p class="mb-0">&copy; <?php echo date('Y'); ?> Practicas Tech. Todos los derechos reservados.</p>
  </div>
</footer>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Leaflet JS -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <!-- Nominatim para geocodificación inversa -->


  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Inicializar el mapa centrado en Argentina
      const map = L.map('map').setView([-34.6037, -58.3816], 5);
      
      // Añadir capa de OpenStreetMap
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);
      
      // Capa para marcadores
      const markersLayer = L.layerGroup().addTo(map);
      
      // Variable para el marcador actual
      let currentMarker = null;

      // Obtener ubicación actual del usuario
if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(function(position) {
    const userLat = position.coords.latitude;
    const userLng = position.coords.longitude;

    // Centrar mapa en la ubicación del usuario
    map.setView([userLat, userLng], 15);

    // Eliminar marcador anterior si existe
    if (currentMarker) {
      markersLayer.removeLayer(currentMarker);
    }

    // Añadir marcador actual
    currentMarker = L.marker([userLat, userLng]).addTo(markersLayer)
      .bindPopup(`Tu ubicación<br>Lat: ${userLat.toFixed(4)}, Lng: ${userLng.toFixed(4)}`)
      .openPopup();

    // Actualizar campos
    document.getElementById('coordenadas').value = `${userLat.toFixed(4)}, ${userLng.toFixed(4)}`;
    document.getElementById('latitud').value = userLat;
    document.getElementById('longitud').value = userLng;

    // Realizar geocodificación inversa
    reverseGeocode(userLat, userLng);

  }, function(error) {
    console.error("Error obteniendo la ubicación:", error.message);
  });
} else {
  console.error("La geolocalización no es compatible con este navegador.");
}

      
      // Evento de clic en el mapa
      map.on('click', function(e) {
        // Eliminar marcador anterior si existe
        if (currentMarker) {
          markersLayer.removeLayer(currentMarker);
        }
        
        // Añadir nuevo marcador
        currentMarker = L.marker(e.latlng).addTo(markersLayer)
          .bindPopup(`Ubicación seleccionada<br>Lat: ${e.latlng.lat.toFixed(4)}, Lng: ${e.latlng.lng.toFixed(4)}`)
          .openPopup();
        
        // Actualizar campo de coordenadas
        document.getElementById('coordenadas').value = `${e.latlng.lat.toFixed(4)}, ${e.latlng.lng.toFixed(4)}`;
        document.getElementById('latitud').value = e.latlng.lat;
        document.getElementById('longitud').value = e.latlng.lng;
        
        // Realizar geocodificación inversa para obtener dirección
        reverseGeocode(e.latlng.lat, e.latlng.lng);
      });
      
      // Función para geocodificación inversa (obtener dirección desde coordenadas)
      function reverseGeocode(lat, lng) {
        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1&accept-language=es`)
          .then(response => response.json())
          .then(data => {
            if (data.address) {
              const address = data.address;
              
              // Rellenar formulario con los datos obtenidos
              document.getElementById('provincia').value = address.state || address.region || '';
              document.getElementById('departamento').value = address.county || '';
              document.getElementById('municipio').value = address.municipality || address.city || address.town || address.village || '';
              document.getElementById('localidad').value = address.city || address.town || address.village || address.hamlet || '';
              document.getElementById('barrio').value = address.neighbourhood || address.suburb || '';
              document.getElementById('calle').value = address.road || '';
              
              // Intentar extraer número de casa si está disponible
              if (address.house_number) {
                document.getElementById('altura').value = address.house_number;
              }
            }
          })
          .catch(error => console.error('Error en geocodificación inversa:', error));
      }
      
      // Función para filtrar marcadores
      document.getElementById('filter-btn').addEventListener('click', function() {
        const province = document.getElementById('filter-province').value;
        const locality = document.getElementById('filter-locality').value.toLowerCase();
        
        // Aquí podrías filtrar marcadores existentes si los tuvieras
        // Por ahora solo centramos el mapa en la provincia seleccionada
        if (province) {
          // Coordenadas aproximadas de algunas provincias argentinas
          const provinceCoords = {
            "Buenos Aires": [-34.6037, -58.3816],
            "Catamarca": [-28.4696, -65.7795],
            "Córdoba": [-31.4201, -64.1888],
            "Mendoza": [-32.8895, -68.8458],
            "Santa Fe": [-31.6107, -60.6973],
            // Agregar más provincias según sea necesario
          };
          
          if (provinceCoords[province]) {
            map.setView(provinceCoords[province], 8);
          }
        }
      });

      
      
      // Cargar puntos existentes desde la base de datos
      function loadPointsFromDatabase() {
        fetch('get_points.php')
          .then(response => response.json())
          .then(points => {
            points.forEach(point => {
              const marker = L.marker([point.latitud, point.longitud]).addTo(markersLayer)
                .bindPopup(`
                  <b>${point.nombre_persona} ${point.apellido_persona}</b><br>
                  ${point.provincia_persona}<br>
                  ${point.localidad_persona}<br>
                  ${point.calle_persona} ${point.altura_persona}
                `);
            });
          })
          .catch(error => console.error('Error cargando puntos:', error));
      }
      
      // Cargar puntos al iniciar
      loadPointsFromDatabase();
    });
  </script>



<script>
document.getElementById('fecha_nacimiento').addEventListener('change', function () {
    const input = this;
    const fechaNacimiento = new Date(input.value);
    const hoy = new Date();

    const edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
    const mes = hoy.getMonth() - fechaNacimiento.getMonth();
    const dia = hoy.getDate() - fechaNacimiento.getDate();

    let edadReal = edad;
    if (mes < 0 || (mes === 0 && dia < 0)) {
        edadReal--;
    }

    if (edadReal >= 18 && edadReal <= 100) {
        input.setCustomValidity('');
        input.classList.remove('is-invalid');
    } else {
        input.setCustomValidity('Debe tener entre 18 y 100 años.');
        input.classList.add('is-invalid');
    }
});
</script>

<script>
function validarCampo(input, regex, errorId) {
    const errorMsg = document.getElementById(errorId);
    errorMsg.style.display = regex.test(input.value) ? "none" : "block";
}

function validarNoVacio(input, errorId) {
    const errorMsg = document.getElementById(errorId);
    errorMsg.style.display = input.value.trim() === "" ? "block" : "none";
}

function evitarEspacioInicial(idCampo) {
    const campo = document.getElementById(idCampo);
    campo.value = campo.value.replace(/^\s+/, '');
}

document.getElementById("nombre").addEventListener("input", function () {
    this.value = this.value.replace(/\s{2,}/g, ' '); // evita más de un espacio seguido
    evitarEspacioInicial("nombre");

    const regex = /^(?! )[A-Za-zÁÉÍÓÚáéíóúñÑ]+(?: [A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/;
    validarCampo(this, regex, "error-nombre");
});
</script>

<script>
function validarCampo(input, regex, errorId) {
    const errorMsg = document.getElementById(errorId);
    errorMsg.style.display = regex.test(input.value) ? "none" : "block";
}

function validarNoVacio(input, errorId) {
    const errorMsg = document.getElementById(errorId);
    errorMsg.style.display = input.value.trim() === "" ? "block" : "none";
}

function evitarEspacioInicial(idCampo) {
    const campo = document.getElementById(idCampo);
    campo.value = campo.value.replace(/^\s+/, '');
}

const regexNombreApellido = /^(?! )[A-Za-zÁÉÍÓÚÜáéíóúüñÑ]+(?: [A-Za-zÁÉÍÓÚÜáéíóúüñÑ]+)*$/;

document.getElementById("nombre").addEventListener("input", function () {
    this.value = this.value.replace(/\s{2,}/g, ' ');
    evitarEspacioInicial("nombre");
    validarCampo(this, regexNombreApellido, "error-nombre");
});

document.getElementById("apellido").addEventListener("input", function () {
    this.value = this.value.replace(/\s{2,}/g, ' ');
    evitarEspacioInicial("apellido");
    validarCampo(this, regexNombreApellido, "error-apellido");
});
</script>

<script>
function validarCampo(input, regex, errorId) {
    const errorMsg = document.getElementById(errorId);
    errorMsg.style.display = regex.test(input.value) ? "none" : "block";
}

// Validación para DNI (solo números, 7 u 8 dígitos)
document.getElementById("dni").addEventListener("input", function () {
    // Reemplaza todo lo que no sea dígito
    this.value = this.value.replace(/\D/g, '');
    validarCampo(this, /^\d{7,8}$/, "error-dni");
});
</script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>

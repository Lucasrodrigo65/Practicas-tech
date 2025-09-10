<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Personas</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Custom CSS -->
  <style>
    :root {
      --primary-color: #0056B3;
      --secondary-color: #F8F9F4;
      --accent-color: #2e59d9;
    }

    body {
      background-color: var(--secondary-color);
      padding-top: 80px;
    }

    .navbar {
      background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand, .nav-link {
      color: white !important;
    }

    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .card-header {
      background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
      color: white;
      border-radius: 10px 10px 0 0 !important;
    }

    .table th {
      background-color: var(--accent-color);
      color: white;
    }

    footer {
      background-color: #0056B3;
      color: white;
      padding: 1rem 0;
      margin-top: 3rem;
    }

    footer a {
      color: #ccc;
      text-decoration: none;
    }

    footer a:hover {
      text-decoration: underline;
    }

    .detail-image {
      max-width: 200px;
      max-height: 200px;
      object-fit: cover;
      border-radius: 8px;
    }

    .detail-row {
      margin-bottom: 0.5rem;
    }

    .detail-label {
      font-weight: bold;
      color: var(--primary-color);
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="indexadmin.php">Terminal de Chumbicha</a>
    <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<!-- Flecha de volver -->
<div class="container mt-3">
  <a href="indexadmin.php" class="text-primary text-decoration-none d-inline-flex align-items-center">
    <i class="bi bi-arrow-left me-2"></i> Volver a Inicio
  </a>
</div>

<!-- Contenido -->
<div class="container-fluid px-5">
  <div class="card mt-4">
    <div class="card-header text-center">
      <h3>Personas</h3>
    </div>
    <div class="card-body">

      <div class="text-center mt-4 mb-4">
        <a href="ejregistro.php" class="btn btn-primary btn-lg">
          <i class="bi bi-person-plus-fill"></i> Registrar nueva persona
        </a>
      </div>

      <?php
      $conn = new mysqli("localhost", "root", "", "terminal");
      if ($conn->connect_error) {
          die("<div class='alert alert-danger'>Error de conexión: " . $conn->connect_error . "</div>");
      }

      $sql = "SELECT * FROM registro_persona";
      $resultado = $conn->query($sql);

      if ($resultado->num_rows > 0) {
          echo "<div class='table-responsive'>";
          echo "<table class='table table-bordered table-striped align-middle'>";
          echo "<thead><tr>
                  <th>Nombre</th><th>Apellido</th><th>DNI</th><th>Fecha Nac.</th>
                  <th>Género</th><th>Acciones</th>
                </tr></thead><tbody>";

          while ($fila = $resultado->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . htmlspecialchars($fila['nombre_persona']) . "</td>";
              echo "<td>" . htmlspecialchars($fila['apellido_persona']) . "</td>";
              echo "<td>{$fila['dni_persona']}</td>";
              echo "<td>{$fila['fechanac_persona']}</td>";
              echo "<td>{$fila['genero_persona']}</td>";
              echo "<td>
        <button type='button' class='btn btn-outline-info btn-sm me-1' onclick='verDetalles(" . json_encode($fila) . ")'>
            <i class='bi bi-eye'></i> Ver más
        </button>
        <button type='button' class='btn btn-outline-warning btn-sm me-1' onclick='editarImagen(" . json_encode($fila) . ")'>
            <i class='bi bi-pencil-square'></i> Editar
        </button>
        <button type='button' class='btn btn-outline-primary btn-sm' onclick='abrirModalExportar({$fila['id_persona']})'>
            <i class='bi bi-download'></i> Exportar
        </button>
      </td>";
              echo "</tr>";
          }
          echo "</tbody></table></div>";
      } else {
          echo "<div class='alert alert-warning'>No se encontraron personas registradas.</div>";
      }

      $conn->close();
      ?>

    </div>
  </div>
</div>

<!-- Modal para ver detalles -->
<div class="modal fade" id="detallesModal" tabindex="-1" aria-labelledby="detallesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detallesModalLabel">
          <i class="bi bi-person-circle"></i> Detalles de la Persona
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- Columna izquierda: Datos -->
          <div class="col-md-8">
            <div class="row detail-row">
              <div class="col-sm-4 detail-label">ID:</div>
              <div class="col-sm-8" id="detalle-id"></div>
            </div>
            <div class="row detail-row">
              <div class="col-sm-4 detail-label">Nombre completo:</div>
              <div class="col-sm-8" id="detalle-nombre-completo"></div>
            </div>
            <div class="row detail-row">
              <div class="col-sm-4 detail-label">DNI:</div>
              <div class="col-sm-8" id="detalle-dni"></div>
            </div>
            <div class="row detail-row">
              <div class="col-sm-4 detail-label">Fecha de nacimiento:</div>
              <div class="col-sm-8" id="detalle-fecha"></div>
            </div>
            <div class="row detail-row">
              <div class="col-sm-4 detail-label">Género:</div>
              <div class="col-sm-8" id="detalle-genero"></div>
            </div>
            
            <hr>
            <h6 class="text-primary"><i class="bi bi-geo-alt"></i> Ubicación</h6>
            
            <div class="row detail-row">
              <div class="col-sm-4 detail-label">Provincia:</div>
              <div class="col-sm-8" id="detalle-provincia"></div>
            </div>
            <div class="row detail-row">
              <div class="col-sm-4 detail-label">Departamento:</div>
              <div class="col-sm-8" id="detalle-departamento"></div>
            </div>
            <div class="row detail-row">
              <div class="col-sm-4 detail-label">Municipio:</div>
              <div class="col-sm-8" id="detalle-municipio"></div>
            </div>
            <div class="row detail-row">
              <div class="col-sm-4 detail-label">Localidad:</div>
              <div class="col-sm-8" id="detalle-localidad"></div>
            </div>
            <div class="row detail-row">
              <div class="col-sm-4 detail-label">CodigoPostal:</div>
              <div class="col-sm-8" id="detalle-codigopostal"></div>
            </div>
            <div class="row detail-row">
              <div class="col-sm-4 detail-label">Barrio:</div>
              <div class="col-sm-8" id="detalle-barrio"></div>
            </div>
            <div class="row detail-row">
              <div class="col-sm-4 detail-label">Calle:</div>
              <div class="col-sm-8" id="detalle-calle"></div>
            </div>
            <div class="row detail-row">
              <div class="col-sm-4 detail-label">Altura:</div>
              <div class="col-sm-8" id="detalle-altura"></div>
            </div>
            
            <hr>
            <h6 class="text-primary"><i class="bi bi-compass"></i> Coordenadas</h6>
            
            <div class="row detail-row">
              <div class="col-sm-4 detail-label">Latitud:</div>
              <div class="col-sm-8" id="detalle-latitud"></div>
            </div>
            <div class="row detail-row">
              <div class="col-sm-4 detail-label">Longitud:</div>
              <div class="col-sm-8" id="detalle-longitud"></div>
            </div>
          </div>
          
          <!-- Columna derecha: Imagen -->
          <div class="col-md-4 text-center">
            <h6 class="text-primary"><i class="bi bi-image"></i> Fotografía</h6>
            <div id="detalle-imagen-container">
              <!-- Aquí se mostrará la imagen -->
            </div>
            
            <!-- Botones para cambiar imagen -->
            <div class="mt-3">
              <button type="button" class="btn btn-outline-primary btn-sm" onclick="cambiarImagen()">
                <i class="bi bi-camera"></i> Cambiar imagen
              </button>
            </div>
            
            <!-- Formulario oculto para cambio de imagen -->
            <div id="cambio-imagen-container" style="display: none;" class="mt-3">
              <div class="border rounded p-3 bg-light">
                <h6 class="text-secondary mb-3">Seleccionar nueva imagen</h6>
                
                <!-- Input de archivo -->
                <input type="file" id="nueva-imagen-file" accept="image/*" class="form-control form-control-sm mb-2">
                
                <!-- Botón para cámara -->
                <button type="button" id="usar-camara-modal" class="btn btn-secondary btn-sm mb-2 w-100">
                  <i class="bi bi-camera-video"></i> Usar cámara
                </button>
                
                <!-- Vista previa de cámara -->
                <div id="camara-container-modal" style="display: none;" class="mb-2">
                  <video id="video-modal" autoplay style="width: 100%; max-width: 200px; border-radius: 8px;"></video>
                  <div class="mt-2">
                    <button type="button" id="capturar-modal" class="btn btn-success btn-sm">
                      <i class="bi bi-camera"></i> Capturar
                    </button>
                    <button type="button" id="cancelar-camara-modal" class="btn btn-danger btn-sm">
                      <i class="bi bi-x"></i> Cancelar
                    </button>
                  </div>
                  <canvas id="canvas-modal" style="display: none;"></canvas>
                </div>
                
                <!-- Preview de nueva imagen -->
                <div id="preview-nueva-imagen" style="display: none;" class="mb-2">
                  <img id="img-preview-nueva" src="/placeholder.svg" alt="Nueva imagen" style="max-width: 150px; max-height: 150px; border-radius: 8px;" class="img-thumbnail">
                  <div class="mt-2">
                    <small class="text-muted d-block" id="info-nueva-imagen"></small>
                  </div>
                </div>
                
                <!-- Botones de acción -->
                <div class="d-flex gap-2">
                  <button type="button" id="guardar-nueva-imagen" class="btn btn-success btn-sm" disabled>
                    <i class="bi bi-check"></i> Guardar
                  </button>
                  <button type="button" onclick="cancelarCambioImagen()" class="btn btn-secondary btn-sm">
                    <i class="bi bi-x"></i> Cancelar
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="bi bi-x-circle"></i> Cerrar
        </button>
        <button type="button" class="btn btn-primary" onclick="exportarDesdeDetalle()">
          <i class="bi bi-download"></i> Exportar datos
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal para editar imagen -->
<div class="modal fade" id="editarImagenModal" tabindex="-1" aria-labelledby="editarImagenModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editarImagenModalLabel">
          <i class="bi bi-pencil-square"></i> Editar Imagen
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <!-- Información de la persona -->
        <div class="text-center mb-4">
          <h6 class="text-primary" id="editar-nombre-persona"></h6>
          <small class="text-muted">DNI: <span id="editar-dni-persona"></span></small>
        </div>
        
        <!-- Imagen actual -->
        <div class="text-center mb-4">
          <h6 class="text-secondary">Imagen actual</h6>
          <div id="editar-imagen-actual-container">
            <!-- Aquí se mostrará la imagen actual -->
          </div>
        </div>
        
        <hr>
        
        <!-- Sección para nueva imagen -->
        <div class="text-center">
          <h6 class="text-secondary mb-3">Seleccionar nueva imagen</h6>
          
          <!-- Input de archivo -->
          <input type="file" id="editar-nueva-imagen-file" accept="image/*" class="form-control mb-3">
          
          <!-- Botón para cámara -->
          <button type="button" id="editar-usar-camara" class="btn btn-secondary mb-3 w-100">
            <i class="bi bi-camera-video"></i> Usar cámara
          </button>
          
          <!-- Vista previa de cámara -->
          <div id="editar-camara-container" style="display: none;" class="mb-3">
            <video id="editar-video" autoplay style="width: 100%; max-width: 300px; border-radius: 8px;" class="border"></video>
            <div class="mt-2">
              <button type="button" id="editar-capturar" class="btn btn-success btn-sm me-2">
                <i class="bi bi-camera"></i> Capturar
              </button>
              <button type="button" id="editar-cancelar-camara" class="btn btn-danger btn-sm">
                <i class="bi bi-x"></i> Cancelar
              </button>
            </div>
            <canvas id="editar-canvas" style="display: none;"></canvas>
          </div>
          
          <!-- Preview de nueva imagen -->
          <div id="editar-preview-nueva-imagen" style="display: none;" class="mb-3">
            <h6 class="text-success">Nueva imagen</h6>
            <img id="editar-img-preview-nueva" src="/placeholder.svg" alt="Nueva imagen" style="max-width: 250px; max-height: 250px; border-radius: 8px;" class="img-thumbnail">
            <div class="mt-2">
              <small class="text-muted d-block" id="editar-info-nueva-imagen"></small>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="bi bi-x-circle"></i> Cancelar
        </button>
        <button type="button" id="editar-guardar-imagen" class="btn btn-success" disabled>
          <i class="bi bi-check-circle"></i> Guardar cambios
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal para selección de campos -->
<div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <form id="exportForm" method="GET" action="exportar.php" target="_blank">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exportModalLabel">Seleccionar datos y formato</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="personaIdSeleccionada">
          <div class="mb-2">Seleccioná los campos:</div>
          <div class="form-check"><input class="form-check-input" type="checkbox" name="mostrar[]" value="nombre_persona" checked> Nombre</div>
          <div class="form-check"><input class="form-check-input" type="checkbox" name="mostrar[]" value="apellido_persona" checked> Apellido</div>
          <div class="form-check"><input class="form-check-input" type="checkbox" name="mostrar[]" value="dni_persona" checked> DNI</div>
          <div class="form-check"><input class="form-check-input" type="checkbox" name="mostrar[]" value="fechanac_persona"> Fecha de Nacimiento</div>
          <div class="form-check"><input class="form-check-input" type="checkbox" name="mostrar[]" value="genero_persona"> Género</div>
          <div class="form-check"><input class="form-check-input" type="checkbox" name="mostrar[]" value="provincia_persona"> Provincia</div>
          <div class="form-check"><input class="form-check-input" type="checkbox" name="mostrar[]" value="departamento_persona"> Departamento</div>
          <div class="form-check"><input class="form-check-input" type="checkbox" name="mostrar[]" value="municipio_persona"> Municipio</div>
          <div class="form-check"><input class="form-check-input" type="checkbox" name="mostrar[]" value="localidad_persona"> Localidad</div>
          <div class="form-check"><input class="form-check-input" type="checkbox" name="mostrar[]" value="barrio_persona"> Barrio</div>
          <div class="form-check"><input class="form-check-input" type="checkbox" name="mostrar[]" value="calle_persona"> Calle</div>
          <div class="form-check"><input class="form-check-input" type="checkbox" name="mostrar[]" value="altura_persona"> Altura</div>
          <div class="form-check"><input class="form-check-input" type="checkbox" name="mostrar[]" value="latitud"> Latitud</div>
          <div class="form-check"><input class="form-check-input" type="checkbox" name="mostrar[]" value="longitud"> Longitud</div>
          <div class="form-check"><input class="form-check-input" type="checkbox" name="mostrar[]" value="imagen_persona"> Imagen</div>

          <hr>
          <label class="form-label">Formato de exportación:</label>
          <select class="form-select" name="formato" required>
            <option value="pdf" selected>PDF</option>
            <option value="xls">XLS</option>
            <option value="xlsx">XLSX</option>
            <option value="csv">CSV</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Exportar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Footer -->
<footer class="text-center">
  <div class="container">
    <p class="mb-0">© 2025 Terminal de Chumbicha. Todos los derechos reservados.</p>
  </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Variable global para almacenar el ID de la persona actual
let personaActualId = null;

// Variables para el cambio de imagen
let streamCamara = null;
let personaIdActual = null;
let nuevaImagenData = null;

function cambiarImagen() {
  document.getElementById('cambio-imagen-container').style.display = 'block';
}

function cancelarCambioImagen() {
  // Limpiar formulario
  document.getElementById('nueva-imagen-file').value = '';
  document.getElementById('preview-nueva-imagen').style.display = 'none';
  document.getElementById('camara-container-modal').style.display = 'none';
  document.getElementById('cambio-imagen-container').style.display = 'none';
  document.getElementById('guardar-nueva-imagen').disabled = true;
  
  // Detener cámara si está activa
  if (streamCamara) {
    streamCamara.getTracks().forEach(track => track.stop());
    streamCamara = null;
  }
  
  nuevaImagenData = null;
}

// Preview de archivo seleccionado
document.getElementById('nueva-imagen-file').addEventListener('change', function(e) {
  const file = e.target.files[0];
  
  if (file) {
    // Validar tipo
    const tiposValidos = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
    if (!tiposValidos.includes(file.type)) {
      Swal.fire({
        icon: 'error',
        title: 'Tipo de archivo no permitido',
        text: 'Solo se permiten imágenes JPG, JPEG, PNG o GIF.',
        confirmButtonColor: '#d33'
      });
      this.value = '';
      return;
    }
    
    // Validar tamaño (5MB)
    if (file.size > 5 * 1024 * 1024) {
      Swal.fire({
        icon: 'error',
        title: 'Archivo muy grande',
        text: 'La imagen no debe superar los 5MB.',
        confirmButtonColor: '#d33'
      });
      this.value = '';
      return;
    }
    
    // Mostrar preview
    const reader = new FileReader();
    reader.onload = function(e) {
      document.getElementById('img-preview-nueva').src = e.target.result;
      document.getElementById('preview-nueva-imagen').style.display = 'block';
      document.getElementById('info-nueva-imagen').textContent = `${file.name} (${(file.size/1024).toFixed(1)} KB)`;
      document.getElementById('guardar-nueva-imagen').disabled = false;
      
      // Guardar datos para envío
      nuevaImagenData = {
        tipo: 'archivo',
        data: e.target.result,
        nombre: file.name
      };
      
      // Ocultar cámara si estaba activa
      document.getElementById('camara-container-modal').style.display = 'none';
      if (streamCamara) {
        streamCamara.getTracks().forEach(track => track.stop());
        streamCamara = null;
      }
    };
    reader.readAsDataURL(file);
  }
});

// Usar cámara
document.getElementById('usar-camara-modal').addEventListener('click', function() {
  document.getElementById('camara-container-modal').style.display = 'block';
  document.getElementById('preview-nueva-imagen').style.display = 'none';
  document.getElementById('nueva-imagen-file').value = '';
  
  navigator.mediaDevices.getUserMedia({ video: true })
    .then(stream => {
      document.getElementById('video-modal').srcObject = stream;
      streamCamara = stream;
    })
    .catch(err => {
      Swal.fire({
        icon: 'error',
        title: 'Error de cámara',
        text: 'No se pudo acceder a la cámara: ' + err.message,
        confirmButtonColor: '#d33'
      });
    });
});

// Capturar foto
document.getElementById('capturar-modal').addEventListener('click', function() {
  const video = document.getElementById('video-modal');
  const canvas = document.getElementById('canvas-modal');
  
  canvas.width = video.videoWidth;
  canvas.height = video.videoHeight;
  const ctx = canvas.getContext('2d');
  ctx.drawImage(video, 0, 0);
  
  const imagenCapturada = canvas.toDataURL('image/jpeg');
  
  // Mostrar preview
  document.getElementById('img-preview-nueva').src = imagenCapturada;
  document.getElementById('preview-nueva-imagen').style.display = 'block';
  document.getElementById('info-nueva-imagen').textContent = 'Imagen capturada con cámara';
  document.getElementById('guardar-nueva-imagen').disabled = false;
  
  // Guardar datos
  nuevaImagenData = {
    tipo: 'camara',
    data: imagenCapturada,
    nombre: 'captura_camara.jpg'
  };
  
  // Ocultar cámara
  document.getElementById('camara-container-modal').style.display = 'none';
  if (streamCamara) {
    streamCamara.getTracks().forEach(track => track.stop());
    streamCamara = null;
  }
});

// Cancelar cámara
document.getElementById('cancelar-camara-modal').addEventListener('click', function() {
  document.getElementById('camara-container-modal').style.display = 'none';
  if (streamCamara) {
    streamCamara.getTracks().forEach(track => track.stop());
    streamCamara = null;
  }
});

// Guardar nueva imagen
document.getElementById('guardar-nueva-imagen').addEventListener('click', function() {
  if (!nuevaImagenData || !personaIdActual) {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'No hay imagen seleccionada o persona identificada.',
      confirmButtonColor: '#d33'
    });
    return;
  }
  
  // Mostrar loading
  Swal.fire({
    title: 'Guardando imagen...',
    text: 'Por favor espera mientras se actualiza la imagen.',
    allowOutsideClick: false,
    didOpen: () => {
      Swal.showLoading();
    }
  });
  
  // Preparar datos para envío
  const formData = new FormData();
  formData.append('accion', 'actualizar_imagen');
  formData.append('persona_id', personaIdActual);
  formData.append('imagen_tipo', nuevaImagenData.tipo);
  formData.append('imagen_data', nuevaImagenData.data);
  formData.append('imagen_nombre', nuevaImagenData.nombre);
  
  // Enviar al servidor
  fetch('actualizar_imagen.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      // Actualizar imagen en el modal
      const imagenContainer = document.getElementById('detalle-imagen-container');
      imagenContainer.innerHTML = `<img src="${data.nueva_ruta}?t=${Date.now()}" alt="Imagen actualizada" class="detail-image img-thumbnail">`;
      
      // Limpiar formulario
      cancelarCambioImagen();
      
      Swal.fire({
        icon: 'success',
        title: '¡Imagen actualizada!',
        text: 'La imagen se ha cambiado correctamente.',
        confirmButtonColor: '#28a745'
      });
    } else {
      Swal.fire({
        icon: 'error',
        title: 'Error al guardar',
        text: data.mensaje || 'No se pudo actualizar la imagen.',
        confirmButtonColor: '#d33'
      });
    }
  })
  .catch(error => {
    console.error('Error:', error);
    Swal.fire({
      icon: 'error',
      title: 'Error de conexión',
      text: 'No se pudo conectar con el servidor.',
      confirmButtonColor: '#d33'
    });
  });
});

// Modificar la función verDetalles existente para guardar el ID
function verDetalles(persona) {
  // Guardar ID para posible exportación Y cambio de imagen
  personaActualId = persona.id_persona;
  personaIdActual = persona.id_persona; // Para el cambio de imagen
  
  // Llenar los campos del modal
  document.getElementById('detalle-id').textContent = persona.id_persona;
  document.getElementById('detalle-nombre-completo').textContent = `${persona.nombre_persona} ${persona.apellido_persona}`;
  document.getElementById('detalle-dni').textContent = persona.dni_persona;
  document.getElementById('detalle-fecha').textContent = persona.fechanac_persona;
  
  // Formatear género
  let genero = '';
  switch(persona.genero_persona) {
    case 'M': genero = 'Masculino'; break;
    case 'F': genero = 'Femenino'; break;
    case 'Otros': genero = 'Otro'; break;
    default: genero = persona.genero_persona;
  }
  document.getElementById('detalle-genero').textContent = genero;
  
  // Datos de ubicación
  document.getElementById('detalle-provincia').textContent = persona.provincia_persona || 'No especificado';
  document.getElementById('detalle-departamento').textContent = persona.departamento_persona || 'No especificado';
  document.getElementById('detalle-municipio').textContent = persona.municipio_persona || 'No especificado';
  document.getElementById('detalle-localidad').textContent = persona.localidad_persona || 'No especificado';
  document.getElementById('detalle-barrio').textContent = persona.barrio_persona || 'No especificado';
  document.getElementById('detalle-calle').textContent = persona.calle_persona || 'No especificado';
  document.getElementById('detalle-altura').textContent = persona.altura_persona || 'No especificado';
  
  // Coordenadas
  document.getElementById('detalle-latitud').textContent = persona.latitud || 'No especificado';
  document.getElementById('detalle-longitud').textContent = persona.longitud || 'No especificado';
  
  // Imagen
  const imagenContainer = document.getElementById('detalle-imagen-container');
  if (persona.imagen_persona && persona.imagen_persona.trim() !== '') {
    imagenContainer.innerHTML = `<img src="${persona.imagen_persona}" alt="Foto de ${persona.nombre_persona}" class="detail-image img-thumbnail">`;
  } else {
    imagenContainer.innerHTML = `
      <div class="text-muted p-4 border rounded">
        <i class="bi bi-person-circle" style="font-size: 4rem;"></i>
        <br>
        <small>Sin imagen</small>
      </div>
    `;
  }
  
  // Limpiar formulario de cambio de imagen al abrir modal
  cancelarCambioImagen();
  
  // Mostrar el modal
  const modal = new bootstrap.Modal(document.getElementById('detallesModal'));
  modal.show();
}

function exportarDesdeDetalle() {
  if (personaActualId) {
    // Cerrar modal de detalles
    const detallesModal = bootstrap.Modal.getInstance(document.getElementById('detallesModal'));
    detallesModal.hide();
    
    // Abrir modal de exportación
    setTimeout(() => {
      abrirModalExportar(personaActualId);
    }, 300);
  }
}

function abrirModalExportar(idPersona) {
  document.getElementById("personaIdSeleccionada").value = idPersona;
  const modal = new bootstrap.Modal(document.getElementById("exportModal"));
  modal.show();
}

document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("exportForm");
  const checkboxes = form.querySelectorAll("input[type='checkbox'][name='mostrar[]']");
  const btnExportar = form.querySelector("button[type='submit']");

  function validarCampos() {
    const seleccionados = Array.from(checkboxes).filter(cb => cb.checked).length;
    btnExportar.disabled = seleccionados < 2;
  }

  // Escuchar cambios en los checkboxes
  checkboxes.forEach(cb => cb.addEventListener("change", validarCampos));

  // Validar también al intentar enviar el formulario
  form.addEventListener("submit", function (e) {
    const seleccionados = Array.from(checkboxes).filter(cb => cb.checked).length;
    if (seleccionados < 2) {
      e.preventDefault(); // Bloquear el envío
      Swal.fire({
        icon: 'warning',
        title: 'Seleccioná más campos',
        text: 'Debes seleccionar al menos 2 campos para poder exportar.',
        confirmButtonText: 'Entendido'
      });
    }
  });

  // Ejecutar al inicio por si ya hay seleccionados
  validarCampos();
});

// Variables para el modal de edición
let editarStreamCamara = null;
let editarPersonaId = null;
let editarNuevaImagenData = null;

function editarImagen(persona) {
  editarPersonaId = persona.id_persona;
  
  // Llenar información de la persona
  document.getElementById('editar-nombre-persona').textContent = `${persona.nombre_persona} ${persona.apellido_persona}`;
  document.getElementById('editar-dni-persona').textContent = persona.dni_persona;
  
  // Mostrar imagen actual
  const imagenActualContainer = document.getElementById('editar-imagen-actual-container');
  if (persona.imagen_persona && persona.imagen_persona.trim() !== '') {
    imagenActualContainer.innerHTML = `<img src="${persona.imagen_persona}" alt="Imagen actual" style="max-width: 200px; max-height: 200px; border-radius: 8px;" class="img-thumbnail">`;
  } else {
    imagenActualContainer.innerHTML = `
      <div class="text-muted p-3 border rounded">
        <i class="bi bi-person-circle" style="font-size: 3rem;"></i>
        <br>
        <small>Sin imagen actual</small>
      </div>
    `;
  }
  
  // Limpiar formulario
  limpiarFormularioEdicion();
  
  // Mostrar modal
  const modal = new bootstrap.Modal(document.getElementById('editarImagenModal'));
  modal.show();
}

function limpiarFormularioEdicion() {
  document.getElementById('editar-nueva-imagen-file').value = '';
  document.getElementById('editar-preview-nueva-imagen').style.display = 'none';
  document.getElementById('editar-camara-container').style.display = 'none';
  document.getElementById('editar-guardar-imagen').disabled = true;
  
  if (editarStreamCamara) {
    editarStreamCamara.getTracks().forEach(track => track.stop());
    editarStreamCamara = null;
  }
  
  editarNuevaImagenData = null;
}

// Preview de archivo en modal de edición
document.getElementById('editar-nueva-imagen-file').addEventListener('change', function(e) {
  const file = e.target.files[0];
  
  if (file) {
    // Validar tipo
    const tiposValidos = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
    if (!tiposValidos.includes(file.type)) {
      Swal.fire({
        icon: 'error',
        title: 'Tipo de archivo no permitido',
        text: 'Solo se permiten imágenes JPG, JPEG, PNG o GIF.',
        confirmButtonColor: '#d33'
      });
      this.value = '';
      return;
    }
    
    // Validar tamaño (5MB)
    if (file.size > 5 * 1024 * 1024) {
      Swal.fire({
        icon: 'error',
        title: 'Archivo muy grande',
        text: 'La imagen no debe superar los 5MB.',
        confirmButtonColor: '#d33'
      });
      this.value = '';
      return;
    }
    
    // Mostrar preview
    const reader = new FileReader();
    reader.onload = function(e) {
      document.getElementById('editar-img-preview-nueva').src = e.target.result;
      document.getElementById('editar-preview-nueva-imagen').style.display = 'block';
      document.getElementById('editar-info-nueva-imagen').textContent = `${file.name} (${(file.size/1024).toFixed(1)} KB)`;
      document.getElementById('editar-guardar-imagen').disabled = false;
      
      editarNuevaImagenData = {
        tipo: 'archivo',
        data: e.target.result,
        nombre: file.name
      };
      
      // Ocultar cámara si estaba activa
      document.getElementById('editar-camara-container').style.display = 'none';
      if (editarStreamCamara) {
        editarStreamCamara.getTracks().forEach(track => track.stop());
        editarStreamCamara = null;
      }
    };
    reader.readAsDataURL(file);
  }
});

// Usar cámara en modal de edición
document.getElementById('editar-usar-camara').addEventListener('click', function() {
  document.getElementById('editar-camara-container').style.display = 'block';
  document.getElementById('editar-preview-nueva-imagen').style.display = 'none';
  document.getElementById('editar-nueva-imagen-file').value = '';
  
  navigator.mediaDevices.getUserMedia({ video: true })
    .then(stream => {
      document.getElementById('editar-video').srcObject = stream;
      editarStreamCamara = stream;
    })
    .catch(err => {
      Swal.fire({
        icon: 'error',
        title: 'Error de cámara',
        text: 'No se pudo acceder a la cámara: ' + err.message,
        confirmButtonColor: '#d33'
      });
    });
});

// Capturar foto en modal de edición
document.getElementById('editar-capturar').addEventListener('click', function() {
  const video = document.getElementById('editar-video');
  const canvas = document.getElementById('editar-canvas');
  
  canvas.width = video.videoWidth;
  canvas.height = video.videoHeight;
  const ctx = canvas.getContext('2d');
  ctx.drawImage(video, 0, 0);
  
  const imagenCapturada = canvas.toDataURL('image/jpeg');
  
  // Mostrar preview
  document.getElementById('editar-img-preview-nueva').src = imagenCapturada;
  document.getElementById('editar-preview-nueva-imagen').style.display = 'block';
  document.getElementById('editar-info-nueva-imagen').textContent = 'Imagen capturada con cámara';
  document.getElementById('editar-guardar-imagen').disabled = false;
  
  editarNuevaImagenData = {
    tipo: 'camara',
    data: imagenCapturada,
    nombre: 'captura_camara.jpg'
  };
  
  // Ocultar cámara
  document.getElementById('editar-camara-container').style.display = 'none';
  if (editarStreamCamara) {
    editarStreamCamara.getTracks().forEach(track => track.stop());
    editarStreamCamara = null;
  }
});

// Cancelar cámara en modal de edición
document.getElementById('editar-cancelar-camara').addEventListener('click', function() {
  document.getElementById('editar-camara-container').style.display = 'none';
  if (editarStreamCamara) {
    editarStreamCamara.getTracks().forEach(track => track.stop());
    editarStreamCamara = null;
  }
});

// Guardar imagen desde modal de edición
document.getElementById('editar-guardar-imagen').addEventListener('click', function() {
  if (!editarNuevaImagenData || !editarPersonaId) {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'No hay imagen seleccionada o persona identificada.',
      confirmButtonColor: '#d33'
    });
    return;
  }
  
  // Mostrar loading
  Swal.fire({
    title: 'Guardando imagen...',
    text: 'Por favor espera mientras se actualiza la imagen.',
    allowOutsideClick: false,
    didOpen: () => {
      Swal.showLoading();
    }
  });
  
  // Preparar datos para envío
  const formData = new FormData();
  formData.append('accion', 'actualizar_imagen');
  formData.append('persona_id', editarPersonaId);
  formData.append('imagen_tipo', editarNuevaImagenData.tipo);
  formData.append('imagen_data', editarNuevaImagenData.data);
  formData.append('imagen_nombre', editarNuevaImagenData.nombre);
  
  // Enviar al servidor
  fetch('actualizar_imagen.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      // Cerrar modal
      const modal = bootstrap.Modal.getInstance(document.getElementById('editarImagenModal'));
      modal.hide();
      
      // Mostrar éxito y recargar página para ver cambios
      Swal.fire({
        icon: 'success',
        title: '¡Imagen actualizada!',
        text: 'La imagen se ha cambiado correctamente.',
        confirmButtonColor: '#28a745'
      }).then(() => {
        // Recargar la página para mostrar la nueva imagen en la tabla
        location.reload();
      });
    } else {
      Swal.fire({
        icon: 'error',
        title: 'Error al guardar',
        text: data.mensaje || 'No se pudo actualizar la imagen.',
        confirmButtonColor: '#d33'
      });
    }
  })
  .catch(error => {
    console.error('Error:', error);
    Swal.fire({
      icon: 'error',
      title: 'Error de conexión',
      text: 'No se pudo conectar con el servidor.',
      confirmButtonColor: '#d33'
    });
  });
});

// Limpiar formulario al cerrar modal de edición
document.getElementById('editarImagenModal').addEventListener('hidden.bs.modal', function() {
  limpiarFormularioEdicion();
});
</script>

</body>
</html>

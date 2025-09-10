<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prácticas Tech - Encuentra Tu Práctica Tecnológica Ideal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        .header {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
        }

        .logo {
            display: flex;
            align-items: center;
            font-weight: bold;
            font-size: 1.2rem;
            color: #333;
        }

        .logo-icon {
            width: 30px;
            height: 30px;
            background: #4f46e5;
            border-radius: 6px;
            margin-right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: #666;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #4f46e5;
        }

        .about-btn {
            border: 2px solid #333;
            padding: 8px 16px;
            border-radius: 6px;
            color: #333 !important;
            transition: all 0.3s;
        }

        .about-btn:hover {
            background: #333;
            color: white !important;
        }

        .login-btn-nav {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            color: white !important;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .login-btn-nav:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%) !important;
        }

        /* Hero Section */
        .hero {
            text-align: center;
            padding: 4rem 0;
            position: relative;
        }

        .hero h1 {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 2rem;
            font-weight: 700;
        }

        .hero-graphics {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .graphic-element {
            position: absolute;
            opacity: 0.6;
        }

        .laptop-chart {
            top: 20%;
            left: 5%;
            width: 80px;
            height: 60px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            transform: rotate(-15deg);
        }

        .hexagon {
            top: 15%;
            right: 8%;
            width: 60px;
            height: 60px;
            background: white;
            clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        /* Search Section */
        .search-section {
            margin: 2rem 0;
        }

        .search-container {
            display: flex;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-radius: 12px;
            overflow: hidden;
        }

        .search-input {
            flex: 1;
            padding: 1rem 1.5rem;
            border: none;
            font-size: 1rem;
            outline: none;
            background: white;
        }

        .search-btn {
            background: #333;
            color: white;
            border: none;
            padding: 1rem 1.5rem;
            cursor: pointer;
            font-size: 1.2rem;
            transition: background 0.3s;
        }

        .search-btn:hover {
            background: #555;
        }

        .location-filters {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            background: white;
            border: 2px solid #e5e7eb;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
        }

        .filter-btn:hover, .filter-btn.active {
            border-color: #4f46e5;
            background: #4f46e5;
            color: white;
        }

        /* Internships Grid */
        .internships-section {
            padding: 3rem 0;
        }

        .internships-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .internship-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .internship-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .card-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .card-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .card-company {
            color: #666;
            margin-bottom: 1rem;
            font-weight: 500;
        }

        .card-description {
            color: #888;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .view-details-btn {
            background: #333;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            width: 100%;
        }

        .view-details-btn:hover {
            background: #555;
            transform: translateY(-2px);
        }

        /* Footer */
        .footer {
            background: #333;
            color: white;
            padding: 3rem 0 2rem;
            margin-top: 4rem;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 2rem;
        }

        .footer-links {
            display: flex;
            gap: 2rem;
        }

        .footer-links a {
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: white;
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-btn {
            width: 40px;
            height: 40px;
            background: #555;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s;
        }

        .social-btn:hover {
            background: #4f46e5;
            transform: translateY(-2px);
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background: white;
            margin: 5% auto;
            padding: 2rem;
            border-radius: 16px;
            width: 90%;
            max-width: 600px;
            position: relative;
            animation: modalSlideIn 0.3s ease;
        }

        @keyframes modalSlideIn {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .close-btn {
            position: absolute;
            right: 20px;
            top: 20px;
            font-size: 1.5rem;
            cursor: pointer;
            color: #666;
        }

        .close-btn:hover {
            color: #333;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav {
                padding: 1rem;
                flex-direction: column;
                gap: 1rem;
            }

            .nav-links {
                gap: 1rem;
                flex-wrap: wrap;
                justify-content: center;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .internships-grid {
                grid-template-columns: 1fr;
            }

            .footer-content {
                flex-direction: column;
                text-align: center;
            }

            .login-btn-nav {
                margin-top: 10px;
            }
        }

        .fade-in {
            animation: fadeIn 0.6s ease forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="nav">
            <div class="logo">
                <div class="logo-icon">PT</div>
                PRÁCTICAS TECH
            </div>
            <ul class="nav-links">
                <li><a href="#" onclick="filterInternships('all')">Explorar Prácticas</a></li>
                <li><a href="#" onclick="showSection('companies')">Empresas</a></li>
                <li><a href="#" onclick="showSection('resources')">Recursos Estudiantes</a></li>
                <li><a href="#" class="about-btn">Sobre Nosotros</a></li>
                <li><a href="#" class="login-btn-nav" onclick="goToLogin()">Perfil</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-graphics">
                <div class="graphic-element laptop-chart"></div>
                <div class="graphic-element hexagon"></div>
            </div>
            <h1>Encuentra Tu Práctica Tecnológica Ideal</h1>
            
            <!-- Search -->
            <div class="search-section">
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Buscar Prácticas Profesionales" id="searchInput">
                    <button class="search-btn" onclick="searchInternships()">🔍</button>
                </div>
                <div class="location-filters">
                    <button class="filter-btn active" onclick="filterByLocation('all')">Todas</button>
                    <button class="filter-btn" onclick="filterByLocation('remote')">Remoto</button>
                    <button class="filter-btn" onclick="filterByLocation('san-francisco')">San Francisco</button>
                    <button class="filter-btn" onclick="filterByLocation('new-york')">Nueva York</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Internships Section -->
    <section class="internships-section">
        <div class="container">
            <div class="internships-grid" id="internshipsGrid">
                <!-- Internship cards will be populated by JavaScript -->
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-links">
                    <a href="#" onclick="showModal('Política de Privacidad')">Política de Privacidad</a>
                    <a href="#" onclick="showModal('Términos de Servicio')">Términos de Servicio</a>
                </div>
                <div class="social-links">
                    <a href="#" class="social-btn">f</a>
                    <a href="#" class="social-btn">t</a>
                    <a href="#" class="social-btn">in</a>
                    <a href="#" class="social-btn">ig</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modal -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <div id="modalContent">
                <!-- Modal content will be populated by JavaScript -->
            </div>
        </div>
    </div>

    <script>
        // Internships data
        const internships = [
            {
                id: 1,
                title: "Practicante Desarrollador Python Junior",
                company: "TechCorp",
                location: "remote",
                description: "Únete a nuestro equipo dinámico como practicante desarrollador Python. Trabaja en proyectos emocionantes usando frameworks Django y Flask.",
                icon: "🐍",
                requirements: "Python, Django, Conocimientos básicos de SQL",
                duration: "3-6 meses",
                type: "Tiempo completo"
            },
            {
                id: 2,
                title: "Practicante Desarrollador Python Junior",
                company: "DataFlow Solutions",
                location: "san-francisco",
                description: "Desarrolla aplicaciones de procesamiento de datos y contribuye a nuestro pipeline de machine learning usando Python y pandas.",
                icon: "🔧",
                requirements: "Python, Análisis de Datos, Git",
                duration: "4 meses",
                type: "Medio tiempo"
            },
            {
                id: 3,
                title: "Practicante Desarrollo Web Frontend",
                company: "WebDesign Pro",
                location: "new-york",
                description: "Crea interfaces web responsivas e interactivas usando frameworks modernos de JavaScript como React y Vue.js.",
                icon: "🎨",
                requirements: "JavaScript, React, CSS, HTML",
                duration: "3 meses",
                type: "Tiempo completo"
            },
            {
                id: 4,
                title: "Practicante DevOps",
                company: "CloudTech Inc",
                location: "remote",
                description: "Aprende gestión de infraestructura en la nube con AWS y Docker. Automatiza procesos de despliegue.",
                icon: "☁️",
                requirements: "Linux, Docker, Conocimientos básicos de AWS",
                duration: "6 meses",
                type: "Tiempo completo"
            },
            {
                id: 5,
                title: "Practicante Desarrollo Web Frontend",
                company: "StartupVibe",
                location: "san-francisco",
                description: "Trabaja en un ambiente de startup dinámico creando interfaces de usuario para aplicaciones móviles y web.",
                icon: "📱",
                requirements: "JavaScript, React Native, UI/UX",
                duration: "3-4 meses",
                type: "Tiempo completo"
            },
            {
                id: 6,
                title: "Practicante Desarrollador Full-Stack",
                company: "Golden Lony",
                location: "new-york",
                description: "Desarrolla aplicaciones web completas desde APIs backend hasta interfaces frontend usando tecnologías modernas.",
                icon: "⚡",
                requirements: "JavaScript, Node.js, React, MongoDB",
                duration: "6 meses",
                type: "Tiempo completo"
            }
        ];

        let currentFilter = 'all';
        let currentLocationFilter = 'all';

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            displayInternships(internships);
            addScrollAnimations();
        });

        // Display internships
        function displayInternships(internshipsToShow) {
            const grid = document.getElementById('internshipsGrid');
            grid.innerHTML = '';

            internshipsToShow.forEach((internship, index) => {
                const card = createInternshipCard(internship, index);
                grid.appendChild(card);
            });

            // Add staggered animation
            const cards = grid.querySelectorAll('.internship-card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('fade-in');
                }, index * 100);
            });
        }

        // Create internship card
        function createInternshipCard(internship, index) {
            const card = document.createElement('div');
            card.className = 'internship-card';
            card.innerHTML = `
                <div class="card-icon">${internship.icon}</div>
                <h3 class="card-title">${internship.title}</h3>
                <p class="card-company">${internship.company}</p>
                <p class="card-description">${internship.description}</p>
                <button class="view-details-btn" onclick="showInternshipDetails(${internship.id})">
                    Ver Detalles
                </button>
            `;
            return card;
        }

        // Search functionality
        function searchInternships() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const filtered = internships.filter(internship => 
                internship.title.toLowerCase().includes(searchTerm) ||
                internship.company.toLowerCase().includes(searchTerm) ||
                internship.description.toLowerCase().includes(searchTerm)
            );
            displayInternships(filtered);
        }

        // Filter by location
        function filterByLocation(location) {
            currentLocationFilter = location;
            
            // Update button states
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            let filtered = internships;
            if (location !== 'all') {
                filtered = internships.filter(internship => 
                    internship.location === location
                );
            }
            displayInternships(filtered);
        }

        // Get location name in Spanish
        function getLocationName(location) {
            const locationNames = {
                'remote': 'Remoto',
                'san-francisco': 'San Francisco',
                'new-york': 'Nueva York'
            };
            return locationNames[location] || location;
        }
        // Show internship details
        function showInternshipDetails(internshipId) {
            const internship = internships.find(i => i.id === internshipId);
            if (internship) {
                const content = `
                    <h2>${internship.title}</h2>
                    <h3>${internship.company}</h3>
                    <p><strong>Ubicación:</strong> ${getLocationName(internship.location)}</p>
                    <p><strong>Duración:</strong> ${internship.duration}</p>
                    <p><strong>Modalidad:</strong> ${internship.type}</p>
                    <p><strong>Requisitos:</strong> ${internship.requirements}</p>
                    <br>
                    <p><strong>Descripción:</strong></p>
                    <p>${internship.description}</p>
                    <br>
                    <button class="view-details-btn" onclick="applyToInternship(${internshipId})">
                        Aplicar Ahora
                    </button>
                `;
                showModal(content);
            }
        }

        // Apply to internship
        function applyToInternship(internshipId) {
            alert('¡Aplicación enviada! Te contactaremos pronto.');
            closeModal();
        }

        // Show modal
        function showModal(content) {
            document.getElementById('modalContent').innerHTML = content;
            document.getElementById('modal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        // Close modal
        function closeModal() {
            document.getElementById('modal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Show different sections
        function showSection(section) {
            let content = '';
            switch(section) {
                case 'companies':
                    content = `
                        <h2>Nuestras Empresas Colaboradoras</h2>
                        <p>Trabajamos con empresas tecnológicas líderes para brindar las mejores oportunidades de prácticas:</p>
                        <ul style="margin: 20px 0; padding-left: 20px;">
                            <li>TechCorp - Soluciones de Computación en la Nube</li>
                            <li>DataFlow Solutions - Analítica de Big Data</li>
                            <li>WebDesign Pro - Agencia de Diseño Digital</li>
                            <li>CloudTech Inc - Infraestructura como Servicio</li>
                            <li>StartupVibe - Desarrollo de Aplicaciones Móviles</li>
                            <li>Golden Lony - Software Empresarial</li>
                        </ul>
                    `;
                    break;
                case 'resources':
                    content = `
                        <h2>Recursos para Estudiantes</h2>
                        <p>Accede a recursos valiosos para impulsar tu carrera tecnológica:</p>
                        <ul style="margin: 20px 0; padding-left: 20px;">
                            <li>📚 Bootcamps y Tutoriales de Programación</li>
                            <li>💼 Herramientas para Crear CV</li>
                            <li>🎯 Guías de Preparación para Entrevistas</li>
                            <li>🌟 Pruebas de Evaluación de Habilidades</li>
                            <li>👥 Programas de Mentoría</li>
                            <li>📈 Talleres de Desarrollo Profesional</li>
                        </ul>
                    `;
                    break;
                default:
                    content = `<h2>${section}</h2><p>Content for ${section} section.</p>`;
            }
            showModal(content);
        }

        // Add scroll animations
        function addScrollAnimations() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('fade-in');
                    }
                });
            });

            document.querySelectorAll('.internship-card').forEach(card => {
                observer.observe(card);
            });
        }

        // Handle Enter key in search
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchInternships();
            }
        });

        // Close modal when clicking outside
        window.addEventListener('click', function(e) {
            const modal = document.getElementById('modal');
            if (e.target === modal) {
                closeModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // Navigation functions
        function goToLogin() {
            // Crear un efecto de transición suave
            document.body.style.opacity = '0.7';
            document.body.style.transition = 'opacity 0.3s ease';
            
            setTimeout(() => {
                // En un proyecto real, esto sería: window.location.href = 'login.html';
                // Para la demostración, mostraremos un modal
                showLoginPreview();
            }, 300);
        }

        function showLoginPreview() {
            const loginPreview = `
                <div style="text-align: center;">
                    <h2>🚀 ¡Funcionalidad de Login Lista!</h2>
                    <p style="margin: 20px 0; line-height: 1.6;">
                        El botón de <strong>"Iniciar Sesión"</strong> está funcionando correctamente.<br>
                        En tu proyecto real, esto redirigirá a <code>login.html</code>
                    </p>
                    <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin: 20px 0; text-align: left;">
                        <strong>Para implementar:</strong><br>
                        1. Guarda la interfaz de login como <code>login.html</code><br>
                        2. El botón automáticamente redirigirá a esa página<br>
                        3. La navegación entre páginas funcionará perfectamente
                    </div>
                    <p style="color: #667eea; font-weight: 600;">
                        ✨ ¡Tu interfaz está lista para producción!
                    </p>
                </div>
            `;
            
            showModal(loginPreview);
            
            // Restaurar opacidad
            document.body.style.opacity = '1';
        }
        // Add hover effects to cards
        document.addEventListener('mouseover', function(e) {
            if (e.target.closest('.internship-card')) {
                e.target.closest('.internship-card').style.transform = 'translateY(-8px) scale(1.02)';
            }
        });

        document.addEventListener('mouseout', function(e) {
            if (e.target.closest('.internship-card')) {
                e.target.closest('.internship-card').style.transform = 'translateY(0) scale(1)';
            }
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Prácticas Tech</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Background Animation */
        .background-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            overflow: hidden;
        }

        .wave {
            position: absolute;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, 
                rgba(102, 126, 234, 0.1) 0%,
                rgba(118, 75, 162, 0.2) 25%,
                rgba(255, 64, 129, 0.15) 50%,
                rgba(64, 196, 255, 0.1) 75%,
                rgba(102, 126, 234, 0.1) 100%);
            animation: waveFlow 20s ease-in-out infinite;
            border-radius: 50%;
        }

        .wave:nth-child(2) {
            animation-delay: -5s;
            animation-duration: 25s;
            opacity: 0.7;
        }

        .wave:nth-child(3) {
            animation-delay: -10s;
            animation-duration: 30s;
            opacity: 0.5;
        }

        @keyframes waveFlow {
            0%, 100% {
                transform: translateX(-50%) translateY(-50%) rotate(0deg) scale(1);
            }
            25% {
                transform: translateX(-45%) translateY(-55%) rotate(90deg) scale(1.1);
            }
            50% {
                transform: translateX(-50%) translateY(-50%) rotate(180deg) scale(0.9);
            }
            75% {
                transform: translateX(-55%) translateY(-45%) rotate(270deg) scale(1.05);
            }
        }

        /* Main Container */
        .login-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            padding: 0;
            width: 90%;
            max-width: 900px;
            min-height: 500px;
            display: flex;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 10;
            overflow: hidden;
        }

        /* Left Panel - Form */
        .login-panel {
            flex: 1;
            padding: 3rem;
            background: rgba(30, 41, 59, 0.95);
            backdrop-filter: blur(10px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.3s;
        }

        .back-btn:hover {
            color: white;
        }

        .login-header h1 {
            color: white;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 2rem;
        }

        .login-header p a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .login-header p a:hover {
            text-decoration: underline;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-input {
            width: 100%;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            transition: all 0.3s;
            backdrop-filter: blur(10px);
        }

        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .form-input:focus {
            outline: none;
            border-color: #667eea;
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 20px rgba(102, 126, 234, 0.3);
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .checkbox-group input[type="checkbox"] {
            accent-color: #667eea;
        }

        .checkbox-group label {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
            margin: 0;
        }

        .forgot-link {
            color: #667eea;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .login-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s;
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        /* Right Panel - Visual */
        .visual-panel {
            flex: 1;
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .visual-content {
            position: relative;
            z-index: 5;
            text-align: center;
            color: white;
        }

        .visual-content h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: linear-gradient(45deg, #667eea, #764ba2, #ff4081);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .visual-content p {
            font-size: 1.1rem;
            opacity: 0.8;
            line-height: 1.6;
        }

        /* Floating Elements */
        .floating-element {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(45deg, #667eea, #764ba2);
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .floating-element:nth-child(1) {
            width: 60px;
            height: 60px;
            top: 20%;
            right: 20%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            width: 80px;
            height: 80px;
            bottom: 30%;
            left: 15%;
            animation-delay: 2s;
        }

        .floating-element:nth-child(3) {
            width: 40px;
            height: 40px;
            top: 60%;
            right: 30%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        /* Glowing Effect */
        .glow-effect {
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(102, 126, 234, 0.3) 0%, transparent 70%);
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: translate(-50%, -50%) scale(1);
                opacity: 0.3;
            }
            50% {
                transform: translate(-50%, -50%) scale(1.2);
                opacity: 0.1;
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                width: 95%;
                max-width: 400px;
                min-height: auto;
            }

            .visual-panel {
                display: none;
            }

            .login-panel {
                padding: 2rem;
            }

            .login-header h1 {
                font-size: 1.5rem;
            }
        }

        /* Loading Animation */
        .loading {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 10px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Success Message */
        .success-message {
            display: none;
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            z-index: 1000;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <!-- Background Animation -->
    <div class="background-animation">
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>

    <!-- Main Login Container -->
    <div class="login-container">
        <!-- Left Panel - Login Form -->
        <div class="login-panel">
            <button class="back-btn" onclick="goBack()">&larr;</button>
            
            <div class="login-header">
                <h1>Iniciar Sesión</h1>
                <p>Por favor ingresa tu información de acceso<br>
                o <a href="registrarse.php" onclick="showRegister()">haz clic aquí para registrarte</a></p>
            </div>

            <form id="loginForm" onsubmit="handleLogin(event)">
                <div class="form-group">
                    <label for="username">Usuario</label>
                    <input 
                        type="text" 
                        id="username" 
                        class="form-input" 
                        placeholder="Ingresa tu usuario"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input 
                        type="password" 
                        id="password" 
                        class="form-input" 
                        placeholder="Ingresa tu contraseña"
                        required
                    >
                </div>

                <div class="remember-forgot">
                    <div class="checkbox-group">
                        <input type="checkbox" id="remember">
                        <label for="remember">Recordarme</label>
                    </div>
                    <a href="#" class="forgot-link" onclick="showForgotPassword()">¿Olvidaste tu contraseña?</a>
                </div>

                <button type="submit" class="login-btn" id="loginBtn">
                    <div class="loading" id="loading"></div>
                    <span id="btnText">Iniciar Sesión</span>
                </button>
            </form>
        </div>

        <!-- Right Panel - Visual Content -->
        <div class="visual-panel">
            <div class="glow-effect"></div>
            <div class="floating-element"></div>
            <div class="floating-element"></div>
            <div class="floating-element"></div>
            
            <div class="visual-content">
                <h2>Prácticas Tech</h2>
                <p>Conecta con las mejores oportunidades<br>
                tecnológicas y acelera tu carrera profesional</p>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    <div class="success-message" id="successMessage">
        ¡Inicio de sesión exitoso! Redirigiendo...
    </div>

    <script>
        // Handle Login Form
        async function handleLogin(event) {
            event.preventDefault();
            
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const loginBtn = document.getElementById('loginBtn');
            const loading = document.getElementById('loading');
            const btnText = document.getElementById('btnText');
            
            // Show loading state
            loading.style.display = 'inline-block';
            btnText.textContent = 'Iniciando sesión...';
            loginBtn.disabled = true;
            
            // Simulate login process
            try {
                await new Promise(resolve => setTimeout(resolve, 2000));
                
                // Simulate successful login
                if (username && password) {
                    showSuccess();
                    setTimeout(() => {
                        // Redirect to main page
                        window.location.href = 'index.php';
                    }, 2000);
                } else {
                    throw new Error('Credenciales inválidas');
                }
            } catch (error) {
                alert('Error: ' + error.message);
            } finally {
                // Reset button state
                loading.style.display = 'none';
                btnText.textContent = 'Iniciar Sesión';
                loginBtn.disabled = false;
            }
        }

        // Show success message
        function showSuccess() {
            const successMessage = document.getElementById('successMessage');
            successMessage.style.display = 'block';
            
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 3000);
        }

        // Navigation functions
        function goBack() {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = 'index.php';
            }
        }


        function showForgotPassword() {
            const email = prompt('Ingresa tu email para recuperar la contraseña:');
            if (email) {
                alert('Se ha enviado un enlace de recuperación a: ' + email);
            }
        }

        // Add input focus effects
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
                this.parentElement.style.transition = 'transform 0.2s ease';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Escape to go back
            if (e.key === 'Escape') {
                goBack();
            }
            
            // Ctrl/Cmd + Enter to submit form
            if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
                document.getElementById('loginForm').dispatchEvent(new Event('submit'));
            }
        });

        // Auto-focus first input
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('username').focus();
        });

        // Add ripple effect to login button
        document.getElementById('loginBtn').addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.style.position = 'absolute';
            ripple.style.borderRadius = '50%';
            ripple.style.background = 'rgba(255, 255, 255, 0.3)';
            ripple.style.animation = 'ripple 0.6s ease-out';
            ripple.style.pointerEvents = 'none';
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });

        // Add ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                from {
                    transform: scale(0);
                    opacity: 1;
                }
                to {
                    transform: scale(2);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
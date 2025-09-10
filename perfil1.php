<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRACTICAS TECH - Crear Perfil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .category-card {
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .category-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .category-card.selected {
            border-color: #8b5cf6;
            background-color: #f3f4f6;
        }
        .logo-text {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200 px-6 py-4">
        <div class="flex items-center justify-between max-w-7xl mx-auto">
            <div class="flex items-center space-x-2">
                <a href="index.php" class="flex items-center space-x-2">
                    <span class="w-4 h-4 rounded-full bg-purple-400 inline-block"></span>
                    <span class="font-bold text-xl text-black">Prácticas</span>
                    <span class="font-bold text-xl text-purple-500">Tech</span>
                </a>
            </div>
            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-6 py-12">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-semibold text-gray-800 mb-3">¡Comencemos a crear tu perfil!</h1>
            <p class="text-gray-600 text-lg">Elige el área en la que te especializas.</p>
        </div>

        <!-- Category Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-12">
            <!-- Programación y Tecnología -->
            <div class="category-card bg-white border-2 border-gray-200 rounded-lg p-6 text-center" data-category="programacion">
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                    </svg>
                </div>
                <h3 class="font-medium text-gray-800 text-sm leading-tight">Programación<br>y Tecnología</h3>
            </div>

            <!-- Diseño y Multimedia -->
            <div class="category-card bg-white border-2 border-gray-200 rounded-lg p-6 text-center" data-category="diseno">
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                    </svg>
                </div>
                <h3 class="font-medium text-gray-800 text-sm leading-tight">Diseño y<br>Multimedia</h3>
            </div>

            <!-- Redacción y Traducción -->
            <div class="category-card bg-white border-2 border-gray-200 rounded-lg p-6 text-center" data-category="redaccion">
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <h3 class="font-medium text-gray-800 text-sm leading-tight">Redacción y<br>Traducción</h3>
            </div>

            <!-- Marketing Digital y Ventas -->
            <div class="category-card bg-white border-2 border-gray-200 rounded-lg p-6 text-center" data-category="marketing">
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                </div>
                <h3 class="font-medium text-gray-800 text-sm leading-tight">Marketing<br>Digital y<br>Ventas</h3>
            </div>

            <!-- Soporte Administrativo -->
            <div class="category-card bg-white border-2 border-gray-200 rounded-lg p-6 text-center" data-category="soporte">
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="font-medium text-gray-800 text-sm leading-tight">Soporte<br>Administrativo</h3>
            </div>

            <!-- Legal -->
            <div class="category-card bg-white border-2 border-gray-200 rounded-lg p-6 text-center" data-category="legal">
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="font-medium text-gray-800 text-sm">Legal</h3>
            </div>

            <!-- Finanzas y Negocios -->
            <div class="category-card bg-white border-2 border-gray-200 rounded-lg p-6 text-center" data-category="finanzas">
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="font-medium text-gray-800 text-sm leading-tight">Finanzas y<br>Negocios</h3>
            </div>

            <!-- Ingeniería y Arquitectura -->
            <div class="category-card bg-white border-2 border-gray-200 rounded-lg p-6 text-center" data-category="ingenieria">
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                </div>
                <h3 class="font-medium text-gray-800 text-sm leading-tight">Ingeniería y<br>Arquitectura</h3>
            </div>
        </div>

        <!-- Continue Button -->
        <div class="text-center">
            <button id="continueBtn" class="bg-purple-600 hover:bg-purple-700 text-white font-medium px-8 py-3 rounded-full transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                Continuar
            </button>
        </div>
    </main>

    <script>
        // Category selection functionality
        const categoryCards = document.querySelectorAll('.category-card');
        const continueBtn = document.getElementById('continueBtn');
        let selectedCategory = null;

        categoryCards.forEach(card => {
            card.addEventListener('click', function() {
                // Remove selection from all cards
                categoryCards.forEach(c => c.classList.remove('selected'));
                
                // Add selection to clicked card
                this.classList.add('selected');
                
                // Store selected category
                selectedCategory = this.dataset.category;
                
                // Enable continue button
                continueBtn.disabled = false;
                
                console.log('Selected category:', selectedCategory);
            });
        });

        // Continue button functionality
        continueBtn.addEventListener('click', function() {
            if (selectedCategory) {
                alert(`Has seleccionado: ${selectedCategory}`);
                // Here you would typically navigate to the next step
                console.log('Continuing with category:', selectedCategory);
            }
        });

        // Add hover effects
        categoryCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                if (!this.classList.contains('selected')) {
                    this.style.borderColor = '#d1d5db';
                }
            });
            
            card.addEventListener('mouseleave', function() {
                if (!this.classList.contains('selected')) {
                    this.style.borderColor = '#e5e7eb';
                }
            });
        });
    </script>
</body>
</html>
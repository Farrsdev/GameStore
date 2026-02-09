<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Farr'sStore - @yield('title', 'Game Store')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #6d28d9;
            --primary-dark: #5b21b6;
            --secondary: #0f172a;
            --accent: #10b981;
        }
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
        }
        
        .btn-primary {
            background-color: var(--primary);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(109, 40, 217, 0.3);
        }
        
        .input-dark {
            background-color: #1e293b;
            border: 1px solid #334155;
            color: #e2e8f0;
            transition: all 0.3s ease;
        }
        
        .input-dark:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(109, 40, 217, 0.2);
        }
        
        .card-dark {
            background-color: rgba(30, 41, 59, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid #334155;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }
        
        .game-pattern {
            background-image: radial-gradient(circle at 25% 25%, rgba(109, 40, 217, 0.15) 0%, transparent 55%), 
                            radial-gradient(circle at 75% 75%, rgba(16, 185, 129, 0.1) 0%, transparent 55%);
        }
    </style>
    
    @stack('styles')
</head>
<body class="text-gray-100 min-h-screen game-pattern">
    <!-- Header -->
    <header class="py-4 px-6 border-b border-gray-800">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-purple-600 to-emerald-500 flex items-center justify-center">
                    <i class="fas fa-gamepad text-white"></i>
                </div>
                <span class="text-2xl font-bold bg-gradient-to-r from-purple-400 to-emerald-400 bg-clip-text text-transparent">Farr'sStore</span>
            </a>
            
            <div class="flex items-center space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-gray-300 hover:text-white font-medium">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white font-medium">
                            <i class="fas fa-sign-in-alt mr-1"></i> Login
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ url('/register') }}" class="btn-primary px-4 py-2 rounded-lg font-medium">
                                <i class="fas fa-user-plus mr-1"></i> Daftar
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </header>
    
    <!-- Main Content -->
    <main class="py-8">
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer class="mt-12 py-6 border-t border-gray-800">
        <div class="container mx-auto text-center">
            <p class="text-gray-400">
                &copy; {{ date('Y') }} Farr'sStore. All rights reserved. 
                <span class="text-emerald-400">Your Ultimate Game Store</span>
            </p>
            <div class="mt-4 flex justify-center space-x-6">
                <a href="#" class="text-gray-400 hover:text-purple-400">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-purple-400">
                    <i class="fab fa-discord"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-purple-400">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-purple-400">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>
    </footer>
    
    <!-- JavaScript -->
    <script>
        // Toggle password visibility
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.querySelector(`[data-toggle="${inputId}"] i`);
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
        
        // Form validation feedback
        document.addEventListener('DOMContentLoaded', function() {
            // Check for form errors
            const errorElements = document.querySelectorAll('.text-red-400');
            if (errorElements.length > 0) {
                errorElements.forEach(error => {
                    const input = error.previousElementSibling;
                    if (input && input.classList.contains('input-dark')) {
                        input.classList.add('border-red-500');
                    }
                });
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>
<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar - Farr'sStore</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #0a0a0f 0%, #0f1629 100%);
            font-family: system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        /* Custom animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        
        /* Focus styles */
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15),
                        0 0 15px rgba(59, 130, 246, 0.1);
            background: #0a0d14;
        }
    </style>
</head>
<body class="text-gray-100">
    <div class="w-full max-w-lg p-6 fade-in">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 bg-clip-text text-transparent mb-2">
                Farr'sStore
            </h1>
            <p class="text-gray-400 text-sm">Tugas Sekolah - Platform Game Store</p>
        </div>

        <!-- Form Register -->
        <div class="bg-gray-900/90 backdrop-blur-sm rounded-2xl p-8 shadow-2xl border border-gray-800 fade-in">
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-900/20 border border-red-700/50 rounded-xl text-sm">
                    @foreach ($errors->all() as $error)
                        <p class="text-red-300">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="mb-8">
                <h2 class="text-2xl font-bold text-white mb-2">Daftar Akun Baru</h2>
                <p class="text-gray-400 text-sm">Isi data berikut untuk membuat akun</p>
            </div>

            <form method="POST" action="{{ url('/register') }}" id="registerForm">
                @csrf
                
                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="block text-gray-300 mb-3 text-sm font-medium">Nama Lengkap</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}"
                        class="w-full p-4 bg-gray-800/70 border border-gray-700 rounded-xl focus:outline-none input-focus text-gray-100 placeholder-gray-500"
                        placeholder="Masukkan nama lengkap"
                        required
                        autofocus
                    >
                </div>
                
                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-gray-300 mb-3 text-sm font-medium">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        class="w-full p-4 bg-gray-800/70 border border-gray-700 rounded-xl focus:outline-none input-focus text-gray-100 placeholder-gray-500"
                        placeholder="email@example.com"
                        required
                    >
                </div>
                
                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-gray-300 mb-3 text-sm font-medium">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="w-full p-4 bg-gray-800/70 border border-gray-700 rounded-xl focus:outline-none input-focus text-gray-100 placeholder-gray-500"
                        placeholder="Buat password"
                        required
                    >
                </div>
                
                <!-- Confirm Password -->
                <div class="mb-8">
                    <label for="password_confirmation" class="block text-gray-300 mb-3 text-sm font-medium">Konfirmasi Password</label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        class="w-full p-4 bg-gray-800/70 border border-gray-700 rounded-xl focus:outline-none input-focus text-gray-100 placeholder-gray-500"
                        placeholder="Ulangi password"
                        required
                    >
                </div>
                
                <!-- Submit Button -->
                <button type="submit" id="submitBtn" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white p-4 rounded-xl font-bold text-lg transition-all duration-300 shadow-lg shadow-blue-900/30">
                    Daftar
                </button>
            </form>
            
            <!-- Link Login -->
            <div class="mt-8 pt-6 border-t border-gray-800 text-center">
                <p class="text-gray-400 text-sm">
                    Sudah punya akun? 
                    <a href="{{ url('/login') }}" class="text-blue-400 hover:text-blue-300 font-medium ml-1">
                        Login disini
                    </a>
                </p>
            </div>
        </div>
        
        <!-- Back to Home -->
        <div class="mt-8 text-center">
            <a href="/" class="text-gray-400 hover:text-gray-300 text-sm inline-flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                Kembali ke beranda
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registerForm');
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('password_confirmation');
            const submitBtn = document.getElementById('submitBtn');
            
            // Simple form validation
            form.addEventListener('submit', function(e) {
                // Check password match
                if (password.value !== confirmPassword.value) {
                    e.preventDefault();
                    alert('Password dan konfirmasi password tidak cocok!');
                    confirmPassword.focus();
                    return;
                }
                
                // Show loading state
                submitBtn.innerHTML = 'Mendaftarkan...';
                submitBtn.disabled = true;
            });
        });
    </script>
</body>
</html>
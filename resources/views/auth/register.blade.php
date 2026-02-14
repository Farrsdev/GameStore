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
            background: #0a0a0f; /* Fallback */
            background: 
                radial-gradient(ellipse at bottom, #0f1629 0%, #0a0a0f 50%),
                url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%23121826" fill-opacity="0.7"%3E%3Cpath d="M12 0L0 12L12 24L24 12L12 0Z M36 0L24 12L36 24L48 12L36 0Z M12 36L0 48L12 60L24 48L12 36Z M36 36L24 48L36 60L48 48L36 36Z" fill-rule="evenodd"/%3E%3C/g%3E%3C/svg%3E');
            background-attachment: fixed;
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
            outline: none;
            border-color: #4a90e2; /* Brighter blue on focus */
            box-shadow: 
                0 0 0 4px rgba(74, 144, 226, 0.2), /* Larger, softer glow */
                0 0 20px rgba(74, 144, 226, 0.2); /* More intense focus glow */
            background: #0d1117; /* Keep background dark on focus */
        }
    </style>
</head>
<body class="text-gray-100">
    <div class="w-full max-w-lg p-6 fade-in">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 bg-clip-text text-transparent mb-2" style="letter-spacing: 1.5px; text-shadow: 0 0 15px rgba(59, 130, 246, 0.6);">
                Farr'sStore
            </h1>
            <p class="text-gray-400 text-sm" style="letter-spacing: 0.8px;">Tugas Sekolah - Platform Game Store</p>
        </div>

        <!-- Form Register -->
        <div class="bg-[#121826] rounded-2xl p-8 shadow-2xl border border-[#2e3a52] fade-in" style="box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6), inset 0 1px 0 rgba(255, 255, 255, 0.08), 0 0 30px rgba(59, 130, 246, 0.2);">
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-900/20 border border-red-700/50 rounded-xl text-sm" style="box-shadow: 0 0 15px rgba(220, 38, 38, 0.2);">
                    @foreach ($errors->all() as $error)
                        <p class="text-red-300">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="mb-8">
                <h2 class="text-3xl font-bold text-white mb-2">Daftar Akun Baru</h2>
                <p class="text-gray-400 text-sm" style="letter-spacing: 0.3px;">Isi data berikut untuk membuat akun</p>
            </div>

            <form method="POST" action="{{ url('/register') }}" id="registerForm">
                @csrf
                
                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="block text-gray-300 mb-3 text-sm font-medium">Nama Lengkap</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">
                            <i class="fas fa-user"></i>
                        </span>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name') }}"
                            class="w-full p-4 pl-12 bg-[#0d1117] border border-[#2d3748] rounded-xl focus:outline-none input-focus text-gray-100 placeholder-gray-500"
                            placeholder="Masukkan nama lengkap"
                            required
                            autofocus
                        >
                    </div>
                </div>
                
                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-gray-300 mb-3 text-sm font-medium">Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            class="w-full p-4 pl-12 bg-[#0d1117] border border-[#2d3748] rounded-xl focus:outline-none input-focus text-gray-100 placeholder-gray-500"
                            placeholder="email@example.com"
                            required
                        >
                    </div>
                </div>
                
                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-gray-300 mb-3 text-sm font-medium">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="w-full p-4 pl-12 bg-[#0d1117] border border-[#2d3748] rounded-xl focus:outline-none input-focus text-gray-100 placeholder-gray-500"
                            placeholder="Buat password"
                            required
                        >
                    </div>
                </div>
                
                <!-- Confirm Password -->
                <div class="mb-8">
                    <label for="password_confirmation" class="block text-gray-300 mb-3 text-sm font-medium">Konfirmasi Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            class="w-full p-4 pl-12 bg-[#0d1117] border border-[#2d3748] rounded-xl focus:outline-none input-focus text-gray-100 placeholder-gray-500"
                            placeholder="Ulangi password"
                            required
                        >
                    </div>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" id="submitBtn" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white p-4 rounded-xl font-bold text-lg transition-all duration-300 shadow-lg shadow-blue-900/30 hover:shadow-blue-900/50 hover:scale-105">
                    Daftar
                </button>
            </form>
            
            <!-- Link Login -->
            <div class="mt-8 pt-6 border-t border-[#2f3a4e] text-center">
                <p class="text-gray-400 text-sm">
                    Sudah punya akun? 
                    <a href="{{ url('/login') }}" class="text-blue-400 hover:text-blue-300 font-medium ml-1 hover:underline">
                        Login disini
                    </a>
                </p>
            </div>
        </div>
        
        <!-- Back to Home -->
        <div class="mt-8 text-center">
            <a href="/" class="text-gray-400 hover:text-gray-300 text-sm inline-flex items-center gap-2 hover:scale-105">
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
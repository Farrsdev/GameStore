<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar | Farr'sStore</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'glass-bg': 'rgba(15, 23, 42, 0.6)',
                        'glass-border': 'rgba(56, 189, 248, 0.3)',
                        'primary-blue': '#0ea5e9',
                        'deep-blue': '#0284c7',
                        'sky-blue': '#38bdf8',
                    },
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-out',
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(20px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            },
                        },
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0px)'
                            },
                            '50%': {
                                transform: 'translateY(-10px)'
                            },
                        },
                    },
                },
            },
        }
    </script>

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(180deg, #0c1929 0%, #0f172a 50%, #1e293b 100%);
            min-height: 100vh;
        }

        /* Animated Background */
        .grid-bg {
            background-image:
                linear-gradient(rgba(56, 189, 248, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(56, 189, 248, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        .hero-bg {
            background:
                radial-gradient(ellipse at 20% 80%, rgba(14, 165, 233, 0.15) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 20%, rgba(56, 189, 248, 0.1) 0%, transparent 50%),
                radial-gradient(ellipse at 50% 50%, rgba(2, 132, 199, 0.08) 0%, transparent 70%);
        }

        /* Glassmorphism Card */
        .glass-card {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(56, 189, 248, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            border-color: rgba(56, 189, 248, 0.4);
        }

        /* Input Styles */
        .input-glass {
            background: rgba(13, 17, 23, 0.8);
            border: 1px solid rgba(56, 189, 248, 0.2);
            transition: all 0.3s ease;
        }

        .input-glass:focus {
            border-color: rgba(56, 189, 248, 0.6);
            box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.15),
                0 0 20px rgba(56, 189, 248, 0.2);
            background: rgba(13, 17, 23, 0.9);
            outline: none;
        }

        /* Button Styles */
        .btn-blue-glow {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
            box-shadow: 0 4px 15px rgba(14, 165, 233, 0.4);
            transition: all 0.3s ease;
        }

        .btn-blue-glow:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(14, 165, 233, 0.6);
        }

        /* Text Gradient */
        .text-gradient {
            background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 50%, #0284c7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Floating Animation */
        .floating {
            animation: float 6s ease-in-out infinite;
        }

        .floating:nth-child(2) {
            animation-delay: -2s;
        }

        .floating:nth-child(3) {
            animation-delay: -4s;
        }
    </style>
</head>

<body class="text-gray-100 min-h-screen font-inter">
    <!-- Animated Background -->
    <div class="fixed inset-0 grid-bg hero-bg -z-10"></div>

    <!-- Floating Decorative Elements -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden">
        <div class="floating absolute top-20 right-10 w-32 h-32 bg-sky-500/10 rounded-full blur-3xl"></div>
        <div class="floating absolute bottom-20 left-10 w-40 h-40 bg-blue-500/10 rounded-full blur-3xl"
            style="animation-delay: -2s;"></div>
        <div class="floating absolute top-1/2 right-1/4 w-24 h-24 bg-cyan-500/10 rounded-full blur-2xl"
            style="animation-delay: -4s;"></div>
    </div>

    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md">
            <!-- Logo -->
            <div class="text-center mb-8 animate-fade-in">
                <a href="/" class="inline-flex items-center space-x-3 group">
                    <div
                        class="w-14 h-14 rounded-2xl bg-gradient-to-br from-sky-400 to-blue-600 flex items-center justify-center shadow-lg group-hover:animate-pulse">
                        <i class="fas fa-gamepad text-white text-2xl"></i>
                    </div>
                </a>
                <h1 class="text-4xl font-extrabold mt-6 mb-2 text-gradient"
                    style="letter-spacing: 1.5px; text-shadow: 0 0 30px rgba(56, 189, 248, 0.5);">
                    Farr'sStore
                </h1>
                <p class="text-gray-400 text-sm">Your Ultimate Game Store</p>
            </div>

            <!-- Register Card -->
            <div class="glass-card rounded-3xl p-8 animate-fade-in" style="animation-delay: 0.1s;">
                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-500/10 border border-red-500/30 rounded-xl text-sm">
                        @foreach ($errors->all() as $error)
                            <p class="text-red-300 flex items-center gap-2">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $error }}
                            </p>
                        @endforeach
                    </div>
                @endif

                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-white mb-2">Buat Akun Baru</h2>
                    <p class="text-gray-400 text-sm">Daftar untuk memulai pengalaman gaming</p>
                </div>

                <form method="POST" action="{{ url('/register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-5">
                        <label for="name" class="block text-gray-300 mb-3 text-sm font-medium">Nama Lengkap</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                class="w-full p-4 pl-12 input-glass rounded-xl text-gray-100 placeholder-gray-500"
                                placeholder="Masukkan nama lengkap" required autofocus>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="mb-5">
                        <label for="email" class="block text-gray-300 mb-3 text-sm font-medium">Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="w-full p-4 pl-12 input-glass rounded-xl text-gray-100 placeholder-gray-500"
                                placeholder="Masukkan email kamu" required>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-5">
                        <label for="password" class="block text-gray-300 mb-3 text-sm font-medium">Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" id="password" name="password"
                                class="w-full p-4 pl-12 input-glass rounded-xl text-gray-100 placeholder-gray-500"
                                placeholder="Masukkan password" required>
                            <button type="button" onclick="togglePassword('password')"
                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-500 hover:text-sky-400">
                                <i class="fas fa-eye" id="password-toggle"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <label for="password_confirmation"
                            class="block text-gray-300 mb-3 text-sm font-medium">Konfirmasi Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="w-full p-4 pl-12 input-glass rounded-xl text-gray-100 placeholder-gray-500"
                                placeholder="Masukkan ulang password" required>
                            <button type="button" onclick="togglePassword('password_confirmation')"
                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-500 hover:text-sky-400">
                                <i class="fas fa-eye" id="password_confirmation-toggle"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full btn-blue-glow py-4 rounded-xl font-bold text-white text-lg">
                        <i class="fas fa-user-plus mr-2"></i>
                        Daftar Sekarang
                    </button>
                </form>

                <!-- Login Link -->
                <div class="mt-8 pt-6 border-t border-sky-500/20 text-center">
                    <p class="text-gray-400 text-sm">
                        Sudah punya akun?
                        <a href="{{ url('/login') }}"
                            class="text-sky-400 font-semibold hover:text-sky-300 transition-colors ml-1">
                            Login di sini
                        </a>
                    </p>
                </div>
            </div>

            <!-- Back to Home -->
            <div class="text-center mt-8 animate-fade-in" style="animation-delay: 0.2s;">
                <a href="/"
                    class="inline-flex items-center gap-2 text-gray-400 hover:text-sky-400 transition-colors">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Home
                </a>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(inputId + '-toggle');

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
    </script>
</body>

</html>

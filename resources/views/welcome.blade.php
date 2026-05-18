<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Farr'sStore - Your Ultimate Game Store">
    <title>Farr'sStore - Game Store</title>
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
                        'glass-hover': 'rgba(30, 41, 59, 0.8)',
                        'primary-blue': '#0ea5e9',
                        'deep-blue': '#0284c7',
                        'sky-blue': '#38bdf8',
                    },
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                    backdropBlur: {
                        'glass': '12px',
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                        'slide-up': 'slideUp 0.5s ease-out',
                        'fade-in': 'fadeIn 0.8s ease-out',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0px)'
                            },
                            '50%': {
                                transform: 'translateY(-20px)'
                            },
                        },
                        glow: {
                            '0%': {
                                boxShadow: '0 0 20px rgba(56, 189, 248, 0.3)'
                            },
                            '100%': {
                                boxShadow: '0 0 40px rgba(56, 189, 248, 0.6)'
                            },
                        },
                        slideUp: {
                            '0%': {
                                transform: 'translateY(30px)',
                                opacity: '0'
                            },
                            '100%': {
                                transform: 'translateY(0)',
                                opacity: '1'
                            },
                        },
                        fadeIn: {
                            '0%': {
                                opacity: '0'
                            },
                            '100%': {
                                opacity: '1'
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

        /* Glassmorphism Card */
        .glass-card {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(56, 189, 248, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            background: rgba(30, 41, 59, 0.8);
            border-color: rgba(56, 189, 248, 0.5);
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5),
                0 0 30px rgba(56, 189, 248, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }

        /* Hero Background Pattern */
        .hero-bg {
            background:
                radial-gradient(ellipse at 20% 80%, rgba(14, 165, 233, 0.15) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 20%, rgba(56, 189, 248, 0.1) 0%, transparent 50%),
                radial-gradient(ellipse at 50% 50%, rgba(2, 132, 199, 0.08) 0%, transparent 70%);
        }

        /* Animated Grid */
        .grid-bg {
            background-image:
                linear-gradient(rgba(56, 189, 248, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(56, 189, 248, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
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

        .btn-outline-glass {
            background: transparent;
            border: 1px solid rgba(56, 189, 248, 0.4);
            backdrop-filter: blur(4px);
            transition: all 0.3s ease;
        }

        .btn-outline-glass:hover {
            background: rgba(56, 189, 248, 0.1);
            border-color: rgba(56, 189, 248, 0.7);
        }

        /* Text Gradient */
        .text-gradient {
            background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 50%, #0284c7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Game Card Overlay */
        .game-card-overlay {
            background: linear-gradient(to top, rgba(15, 23, 42, 0.95) 0%, transparent 60%);
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #0f172a;
        }

        ::-webkit-scrollbar-thumb {
            background: #38bdf8;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #0ea5e9;
        }

        /* Floating Animation for Hero Elements */
        .floating-game {
            animation: float 6s ease-in-out infinite;
        }

        .floating-game:nth-child(2) {
            animation-delay: -2s;
        }

        .floating-game:nth-child(3) {
            animation-delay: -4s;
        }
    </style>
</head>

<body class="text-gray-100 min-h-screen font-inter">
    <!-- Animated Background -->
    <div class="fixed inset-0 grid-bg hero-bg -z-10"></div>

    <!-- Header / Navigation -->
    <header class="glass-card fixed top-0 left-0 right-0 z-50 border-t-0 border-x-0 rounded-none">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="/" class="flex items-center space-x-3 group">
                    <div
                        class="w-10 h-10 rounded-xl bg-linear-to-br from-sky-400 to-blue-600 flex items-center justify-center shadow-lg group-hover:animate-pulse">
                        <i class="fas fa-gamepad text-white text-lg"></i>
                    </div>
                    <span class="text-2xl font-bold text-gradient">Farr'sStore</span>
                </a>

                <!-- Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-gray-300 hover:text-sky-400 transition-colors font-medium">Home</a>
                    <a href="#games" class="text-gray-300 hover:text-sky-400 transition-colors font-medium">Games</a>
                    <a href="#features"
                        class="text-gray-300 hover:text-sky-400 transition-colors font-medium">Features</a>
                    <a href="#contact"
                        class="text-gray-300 hover:text-sky-400 transition-colors font-medium">Contact</a>
                </nav>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="btn-blue-glow px-5 py-2.5 rounded-lg font-semibold text-white flex items-center gap-2">
                                <i class="fas fa-gamepad"></i>
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-gray-300 hover:text-white font-medium transition-colors">
                                <i class="fas fa-sign-in-alt mr-1"></i> Login
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ url('/register') }}"
                                    class="btn-blue-glow px-5 py-2.5 rounded-lg font-semibold text-white">
                                    <i class="fas fa-user-plus mr-1"></i> Daftar
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="pt-28 pb-20 px-6">
        <div class="container mx-auto">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Hero Content -->
                <div class="text-center lg:text-left animate-slide-up">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full glass-card mb-6">
                        <span class="w-2 h-2 rounded-full bg-sky-400 animate-pulse"></span>
                        <span class="text-sm text-sky-300">🎮 Best Games Collection</span>
                    </div>

                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6 leading-tight">
                        Temukan Dunia <br>
                        <span class="text-gradient">Game Impianmu</span>
                    </h1>

                    <p class="text-gray-400 text-lg md:text-xl mb-8 max-w-xl mx-auto lg:mx-0">
                        Ribuan game terbaik dari berbagai genre tersedia di Farr'sStore.
                        Beli, main, dan nikmati pengalaman gaming tanpa batas!
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="#games"
                            class="btn-blue-glow px-8 py-4 rounded-xl font-bold text-white text-lg flex items-center justify-center gap-3">
                            <i class="fas fa-compass"></i>
                            Jelajahi Games
                        </a>
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="btn-outline-glass px-8 py-4 rounded-xl font-bold text-white text-lg flex items-center justify-center gap-3">
                                <i class="fas fa-user"></i>
                                My Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}"
                                class="btn-outline-glass px-8 py-4 rounded-xl font-bold text-white text-lg flex items-center justify-center gap-3">
                                <i class="fas fa-user-plus"></i>
                                Daftar Gratis
                            </a>
                        @endauth
                    </div>

                    <!-- Stats -->
                    <div class="flex flex-wrap gap-8 mt-12 justify-center lg:justify-start">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-sky-400">1000+</div>
                            <div class="text-gray-500 text-sm">Games</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-sky-400">50K+</div>
                            <div class="text-gray-500 text-sm">Players</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-sky-400">24/7</div>
                            <div class="text-gray-500 text-sm">Support</div>
                        </div>
                    </div>
                </div>

                <!-- Hero Visual / Floating Games -->
                <div class="relative h-100 lg:h-125 hidden lg:block">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <!-- Floating Game Cards -->
                        <div
                            class="floating-game glass-card w-48 h-64 rounded-2xl overflow-hidden absolute top-10 left-10">
                            <img src="https://picsum.photos/seed/game1/400/500" alt="Game"
                                class="w-full h-full object-cover">
                            <div class="game-card-overlay absolute bottom-0 left-0 right-0 p-4">
                                <h3 class="font-bold text-white">Cyber Quest</h3>
                                <p class="text-sky-400 text-sm">RPG Adventure</p>
                            </div>
                        </div>

                        <div
                            class="floating-game glass-card w-48 h-64 rounded-2xl overflow-hidden absolute top-20 right-10">
                            <img src="https://picsum.photos/seed/game2/400/500" alt="Game"
                                class="w-full h-full object-cover">
                            <div class="game-card-overlay absolute bottom-0 left-0 right-0 p-4">
                                <h3 class="font-bold text-white">Star Warriors</h3>
                                <p class="text-sky-400 text-sm">Action FPS</p>
                            </div>
                        </div>

                        <div
                            class="floating-game glass-card w-48 h-64 rounded-2xl overflow-hidden absolute bottom-10 left-1/4">
                            <img src="https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/3494920/e1a404cabdcfacb9a36dfccf01169d39a9c61f79/capsule_616x353.jpg?t=1768314888" alt="Game"
                                class="w-full h-full object-cover">
                            <div class="game-card-overlay absolute bottom-0 left-0 right-0 p-4">
                                <h3 class="font-bold text-white">Dragon Realm</h3>
                                <p class="text-sky-400 text-sm">Fantasy RPG</p>
                            </div>
                        </div>
                    </div>

                    <!-- Decorative Elements -->
                    <div class="absolute top-0 right-0 w-20 h-20 border border-sky-500/30 rounded-full animate-pulse">
                    </div>
                    <div class="absolute bottom-10 left-0 w-16 h-16 border border-blue-500/30 rounded-full animate-pulse"
                        style="animation-delay: 1s;"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Games Section -->
    <section id="games" class="py-20 px-6">
        <div class="container mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full glass-card mb-4">
                    <span class="text-sky-400"><i class="fas fa-fire"></i></span>
                    <span class="text-sm text-sky-300">Trending Now</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    <span class="text-gradient">Game Terbaru</span> & Terpopuler
                </h2>
                <p class="text-gray-400 max-w-2xl mx-auto">
                    Temukan koleksi game terbaru dan terhot dari berbagai genre kesukaanmu
                </p>
            </div>

            <!-- Games Grid -->
            @if ($games && $games->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                    @foreach ($games as $game)
                        <div class="glass-card rounded-2xl overflow-hidden group cursor-pointer">
                            <!-- Game Cover -->
                            <div class="relative h-64 overflow-hidden">
                                @if ($game->cover)
                                    <img src="{{ asset('covers/' . $game->cover) }}" alt="{{ $game->title }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div
                                        class="w-full h-full bg-linear-to-br from-blue-900 to-slate-900 flex items-center justify-center">
                                        <i class="fas fa-gamepad text-6xl text-sky-700"></i>
                                    </div>
                                @endif

                                <!-- Overlay -->
                                <div
                                    class="absolute inset-0 bg-linear-to-t from-slate-900 via-transparent to-transparent">
                                </div>

                                <!-- Rating Badge -->
                                @if ($game->rating)
                                    <div
                                        class="absolute top-3 right-3 glass-card px-2 py-1 rounded-lg flex items-center gap-1">
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <span
                                            class="text-white text-sm font-semibold">{{ number_format($game->rating, 1) }}</span>
                                    </div>
                                @endif

                                <!-- Price Badge -->
                                <div class="absolute top-3 left-3">
                                    @if ($game->price > 0)
                                        <span class="glass-card px-3 py-1 rounded-lg text-sky-400 font-bold">
                                            ${{ number_format($game->price, 2) }}
                                        </span>
                                    @else
                                        <span
                                            class="glass-card px-3 py-1 rounded-lg bg-emerald-500/20 text-emerald-400 font-bold">
                                            FREE
                                        </span>
                                    @endif
                                </div>

                                <!-- Play Button (Show on Hover) -->
                                <div
                                    class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    @auth
                                        <a href="{{ route('user.game.show', $game->id) }}"
                                            class="btn-blue-glow px-6 py-3 rounded-xl font-bold text-white">
                                            <i class="fas fa-play mr-2"></i>Lihat Detail
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="btn-blue-glow px-6 py-3 rounded-xl font-bold text-white">
                                            <i class="fas fa-sign-in-alt mr-2"></i>Login untuk Beli
                                        </a>
                                    @endauth
                                </div>
                            </div>

                            <!-- Game Info -->
                            <div class="p-5">
                                <h3
                                    class="text-xl font-bold text-white mb-2 group-hover:text-sky-400 transition-colors">
                                    {{ $game->title }}
                                </h3>
                                <p class="text-gray-400 text-sm mb-3 line-clamp-2">
                                    {{ $game->description }}
                                </p>
                                <div class="flex flex-wrap gap-2">
                                    @if ($game->genres && $game->genres->count() > 0)
                                        @foreach ($game->genres->take(3) as $genre)
                                            <span
                                                class="px-2 py-1 bg-sky-500/10 border border-sky-500/30 rounded-md text-sky-300 text-xs">
                                                {{ $genre->name }}
                                            </span>
                                        @endforeach
                                    @elseif($game->genre)
                                        <span
                                            class="px-2 py-1 bg-sky-500/10 border border-sky-500/30 rounded-md text-sky-300 text-xs">
                                            {{ $game->genre }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="glass-card rounded-2xl p-12 text-center">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-sky-500/10 flex items-center justify-center">
                        <i class="fas fa-gamepad text-4xl text-sky-400"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Belum Ada Game</h3>
                    <p class="text-gray-400 mb-6">Game akan segera tersedia! Silakan cek kembali nanti.</p>
                    @auth
                        @if (Auth::user()->is_admin ?? false)
                            <a href="{{ route('admin.games.create') }}"
                                class="btn-blue-glow px-6 py-3 rounded-xl font-bold text-white inline-flex items-center gap-2">
                                <i class="fas fa-plus"></i>
                                Tambah Game (Admin)
                            </a>
                        @endif
                    @endauth
                </div>
            @endif

            <!-- View More Button -->
            @auth
                <div class="text-center">
                    <a href="{{ url('/dashboard') }}"
                        class="btn-outline-glass px-8 py-4 rounded-xl font-bold text-white text-lg inline-flex items-center gap-3">
                        <i class="fas fa-arrow-right"></i>
                        Lihat Semua Game
                    </a>
                </div>
            @else
                <div class="text-center">
                    <a href="{{ route('register') }}"
                        class="btn-outline-glass px-8 py-4 rounded-xl font-bold text-white text-lg inline-flex items-center gap-3">
                        <i class="fas fa-user-plus"></i>
                        Daftar untuk Melihat Semua Game
                    </a>
                </div>
            @endauth
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 px-6">
        <div class="container mx-auto">
            <div class="text-center mb-16">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full glass-card mb-4">
                    <span class="text-sky-400"><i class="fas fa-shield-alt"></i></span>
                    <span class="text-sm text-sky-300">Why Choose Us</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Keunggulan <span class="text-gradient">Farr'sStore</span>
                </h2>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Feature 1 -->
                <div class="glass-card rounded-2xl p-6 text-center hover:animate-glow">
                    <div
                        class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-linear-to-br from-sky-500 to-blue-600 flex items-center justify-center">
                        <i class="fas fa-gift text-2xl text-white"></i>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Bonus & Promo</h3>
                    <p class="text-gray-400 text-sm">Dapatkan bonus menarik dan promo eksklusif setiap minggu</p>
                </div>

                <!-- Feature 2 -->
                <div class="glass-card rounded-2xl p-6 text-center">
                    <div
                        class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-linear-to-br from-emerald-500 to-teal-600 flex items-center justify-center">
                        <i class="fas fa-shield-alt text-2xl text-white"></i>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Transaksi Aman</h3>
                    <p class="text-gray-400 text-sm">Sistem pembayaran aman dan terpercaya dengan enkripsi</p>
                </div>

                <!-- Feature 3 -->
                <div class="glass-card rounded-2xl p-6 text-center">
                    <div
                        class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-linear-to-br from-purple-500 to-pink-600 flex items-center justify-center">
                        <i class="fas fa-headset text-2xl text-white"></i>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Support 24/7</h3>
                    <p class="text-gray-400 text-sm">Tim support siap membantu kapan saja Anda butuhkan</p>
                </div>

                <!-- Feature 4 -->
                <div class="glass-card rounded-2xl p-6 text-center">
                    <div
                        class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-linear-to-br from-amber-500 to-orange-600 flex items-center justify-center">
                        <i class="fas fa-bolt text-2xl text-white"></i>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Instant Delivery</h3>
                    <p class="text-gray-400 text-sm">Game langsung dikirimkan setelah pembayaran dikonfirmasi</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-6">
        <div class="container mx-auto">
            <div class="glass-card rounded-3xl p-8 md:p-12 text-center relative overflow-hidden">
                <!-- Background Effects -->
                <div class="absolute inset-0 bg-linear-to-r from-sky-500/10 to-blue-500/10"></div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-sky-500/20 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl"></div>

                <div class="relative z-10">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                        Siap Memulai Petualangan?
                    </h2>
                    <p class="text-gray-400 text-lg mb-8 max-w-2xl mx-auto">
                        Bergabunglah dengan ribuan gamer lain dan temukan ribuan game menarik di Farr'sStore
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="btn-blue-glow px-8 py-4 rounded-xl font-bold text-white text-lg">
                                <i class="fas fa-gamepad mr-2"></i>
                                Mulai Belanja
                            </a>
                        @else
                            <a href="{{ route('register') }}"
                                class="btn-blue-glow px-8 py-4 rounded-xl font-bold text-white text-lg">
                                <i class="fas fa-user-plus mr-2"></i>
                                Daftar Sekarang
                            </a>
                            <a href="{{ route('login') }}"
                                class="btn-outline-glass px-8 py-4 rounded-xl font-bold text-white text-lg">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Login
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="border-t border-sky-500/20 py-12 px-6">
        <div class="container mx-auto">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <!-- Brand -->
                <div class="md:col-span-2">
                    <a href="/" class="flex items-center space-x-3 mb-4">
                        <div
                            class="w-10 h-10 rounded-xl bg-linear-to-br from-sky-400 to-blue-600 flex items-center justify-center">
                            <i class="fas fa-gamepad text-white text-lg"></i>
                        </div>
                        <span class="text-2xl font-bold text-gradient">Farr'sStore</span>
                    </a>
                    <p class="text-gray-400 max-w-md">
                        Your ultimate destination for the best games. Buy, play, and enjoy unlimited gaming experience!
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#home" class="text-gray-400 hover:text-sky-400 transition-colors">Home</a></li>
                        <li><a href="#games" class="text-gray-400 hover:text-sky-400 transition-colors">Games</a>
                        </li>
                        <li><a href="#features"
                                class="text-gray-400 hover:text-sky-400 transition-colors">Features</a></li>
                        @auth
                            <li><a href="{{ url('/dashboard') }}"
                                    class="text-gray-400 hover:text-sky-400 transition-colors">Dashboard</a></li>
                            <li><a href="{{ url('/library') }}"
                                    class="text-gray-400 hover:text-sky-400 transition-colors">My Library</a></li>
                        @endauth
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-white font-bold mb-4">Connect</h4>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="w-10 h-10 rounded-lg glass-card flex items-center justify-center text-sky-400 hover:text-white hover:border-sky-400 transition-all">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-lg glass-card flex items-center justify-center text-sky-400 hover:text-white hover:border-sky-400 transition-all">
                            <i class="fab fa-discord"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-lg glass-card flex items-center justify-center text-sky-400 hover:text-white hover:border-sky-400 transition-all">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-lg glass-card flex items-center justify-center text-sky-400 hover:text-white hover:border-sky-400 transition-all">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-sky-500/20 pt-8 text-center">
                <p class="text-gray-500">
                    &copy; {{ date('Y') }} Farr'sStore. All rights reserved.
                    <span class="text-sky-400">Built with <i class="fas fa-heart"></i> for Gamers</span>
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Navbar background on scroll
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.classList.add('shadow-lg');
            } else {
                header.classList.remove('shadow-lg');
            }
        });
    </script>
</body>

</html>

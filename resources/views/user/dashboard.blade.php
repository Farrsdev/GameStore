<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>User Dashboard | Farr'sStore</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #0a0a0f;
            background:
                radial-gradient(ellipse at bottom, #0f1629 0%, #0a0a0f 50%),
                url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%23121826" fill-opacity="0.7"%3E%3Cpath d="M12 0L0 12L12 24L24 12L12 0Z M36 0L24 12L36 24L48 12L36 0Z M12 36L0 48L12 60L24 48L12 36Z M36 36L24 48L36 60L48 48L36 36Z" fill-rule="evenodd"/%3E%3C/g%3E%3C/svg%3E');
            background-attachment: fixed;
            color: #f8fafc;
            margin: 0;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background: #1a202c;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #2d3748;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .logo {
            font-size: 24px;
            font-weight: 800;
            background: linear-gradient(90deg, #60a5fa, #2563eb);
            -webkit-background-clip: text;
            color: transparent;
            letter-spacing: 1.2px;
            text-shadow: 0 0 10px rgba(59, 130, 246, 0.4);
        }

        .nav-right {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .nav-link {
            color: #94a3b8;
            text-decoration: none;
            font-weight: 500;
            padding: 10px 16px;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .nav-link:hover {
            background: #2d3748;
            color: #60a5fa;
        }

        .nav-link.active {
            background: #2d3748;
            color: #60a5fa;
        }

        .logout-btn {
            background: #ef4444;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            color: white;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3);
        }

        .logout-btn:hover {
            background: #dc2626;
            box-shadow: 0 6px 15px rgba(239, 68, 68, 0.4);
            transform: translateY(-2px);
        }

        /* Notification */
        .notification {
            position: fixed;
            top: 100px;
            right: 20px;
            background: #1a202c;
            border-left: 4px solid #10b981;
            border-radius: 8px;
            padding: 16px 24px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5), 0 0 20px rgba(16, 185, 129, 0.3);
            z-index: 1000;
            transform: translateX(400px);
            transition: transform 0.3s ease;
            max-width: 350px;
            border: 1px solid #2d3748;
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification-content {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .notification-icon {
            width: 40px;
            height: 40px;
            background: rgba(16, 185, 129, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #10b981;
            font-size: 20px;
        }

        .notification-text {
            flex: 1;
        }

        .notification-title {
            font-weight: 700;
            color: #f8fafc;
            margin-bottom: 4px;
        }

        .notification-message {
            font-size: 13px;
            color: #94a3b8;
        }

        .notification-close {
            color: #64748b;
            cursor: pointer;
            font-size: 18px;
            transition: color 0.3s;
        }

        .notification-close:hover {
            color: #f8fafc;
        }

        /* Content */
        .container {
            padding: 40px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .welcome-section {
            margin-bottom: 30px;
        }

        .welcome-title {
            font-size: 28px;
            color: #f8fafc;
            margin-bottom: 8px;
        }

        .welcome-subtitle {
            color: #94a3b8;
            margin: 0;
            font-size: 16px;
        }

        .section-title {
            color: #cbd5e1;
            font-size: 22px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-title i {
            color: #a855f7;
        }

        .games-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 24px;
            margin-top: 20px;
        }

        .game-card {
            background: #1a202c;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #2d3748;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
        }

        .game-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.5), 0 0 20px rgba(168, 85, 247, 0.2);
            border-color: #a855f7;
        }

        .game-cover {
            width: 100%;
            height: 220px;
            object-fit: cover;
            background: #2d3748;
            display: block;
        }

        .game-cover-placeholder {
            width: 100%;
            height: 220px;
            background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 64px;
            font-weight: 700;
            color: #3b82f6;
        }

        .game-info {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .game-title {
            font-size: 16px;
            font-weight: 700;
            color: #f8fafc;
            margin-bottom: 6px;
            line-height: 1.3;
        }

        .game-developer {
            font-size: 13px;
            color: #94a3b8;
            margin-bottom: 12px;
        }

        .game-details {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 12px;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-platform {
            background: rgba(59, 130, 246, 0.2);
            color: #60a5fa;
        }

        .badge-genre {
            background: rgba(168, 85, 247, 0.2);
            color: #a855f7;
        }

        .game-price {
            font-size: 18px;
            font-weight: 700;
            color: #10b981;
            margin-bottom: 10px;
        }

        .game-stock {
            font-size: 13px;
            margin-bottom: 10px;
        }

        .stock-available {
            color: #10b981;
        }

        .stock-out {
            color: #ef4444;
        }

        .btn {
            width: 100%;
            padding: 11px;
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-sizing: border-box;
            gap: 6px;
        }

        .btn-buy {
            background: linear-gradient(90deg, #10b981, #059669);
            box-shadow: 0 4px 10px rgba(16, 185, 129, 0.3);
        }

        .btn-detail {
            background: linear-gradient(90deg, #3b82f6, #2563eb);
            box-shadow: 0 4px 10px rgba(59, 130, 246, 0.3);
        }

        .btn-play {
            background: linear-gradient(90deg, #a855f7, #9333ea);
            box-shadow: 0 4px 10px rgba(168, 85, 247, 0.3);
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-buy:hover {
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }

        .btn-detail:hover {
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        }

        .btn-play:hover {
            box-shadow: 0 6px 20px rgba(168, 85, 247, 0.4);
        }

        .btn:disabled {
            background: #4b5563;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
            color: #94a3b8;
        }

        .action-buttons {
            display: grid;
            gap: 8px;
            margin-top: auto;
        }

        .empty-games {
            background: #1a202c;
            border-radius: 12px;
            border: 1px solid #2d3748;
            padding: 60px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .empty-games i {
            font-size: 48px;
            color: #3b82f6;
            margin-bottom: 20px;
            display: block;
        }

        .empty-games h3 {
            font-size: 24px;
            font-weight: 700;
            color: #cbd5e1;
            margin-bottom: 10px;
        }

        .empty-games p {
            color: #94a3b8;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 18px 20px;
                flex-direction: column;
                gap: 15px;
            }
            
            .nav-right {
                width: 100%;
                justify-content: center;
                flex-wrap: wrap;
            }
            
            .container {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="logo">Farr'sStore</div>

        <div class="nav-right">
            <a href="{{ route('user.dashboard') }}" class="nav-link active">
                <i class="fas fa-store"></i> Browse
            </a>
            <a href="{{ route('user.library') }}" class="nav-link">
                <i class="fas fa-library"></i> My Library
            </a>
            <a href="{{ route('cart.view') }}" class="nav-link">
                <i class="fas fa-shopping-cart"></i> Cart
            </a>
            <form method="POST" action="/logout" style="display: inline;">
                @csrf
                <button class="logout-btn">Logout</button>
            </form>
        </div>
    </div>

    <!-- Notification -->
    <div id="cartNotification" class="notification">
        <div class="notification-content">
            <div class="notification-icon">
                <i class="fas fa-check"></i>
            </div>
            <div class="notification-text">
                <div class="notification-title" id="notificationTitle">Berhasil!</div>
                <div class="notification-message" id="notificationMessage">Game berhasil ditambahkan ke keranjang</div>
            </div>
            <div class="notification-close" onclick="hideNotification()">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="welcome-section">
            <h2 class="welcome-title">
                <i class="fas fa-user-circle" style="color: #60a5fa;"></i> 
                Halo, {{ Auth::user()->name }} 👋
            </h2>
            <p class="welcome-subtitle">Selamat datang di Farr'sStore. Jelajahi koleksi game terbaru kami!</p>
        </div>

        <div>
            <h3 class="section-title">
                <i class="fas fa-gamepad"></i> Koleksi Game
            </h3>

            @if (isset($games) && $games->count() > 0)
                <div class="games-grid">
                    @foreach ($games as $game)
                        <div class="game-card">
                            @if ($game->cover)
                                <img src="/covers/{{ $game->cover }}" alt="{{ $game->title }}" class="game-cover">
                            @else
                                <div class="game-cover-placeholder">
                                    {{ strtoupper(substr($game->title, 0, 1)) }}
                                </div>
                            @endif

                            <div class="game-info">
                                <h4 class="game-title">{{ $game->title }}</h4>
                                <p class="game-developer">{{ $game->developer }}</p>

                                <div class="game-details">
                                    <span class="badge badge-platform">{{ $game->platform }}</span>
                                    @forelse($game->genres as $genre)
                                        <span class="badge badge-genre">{{ $genre->name }}</span>
                                    @empty
                                        <span class="badge badge-genre">-</span>
                                    @endforelse
                                </div>

                                <div class="game-price">Rp {{ number_format($game->price, 0, ',', '.') }}</div>

                                <div class="game-stock">
                                    @if ($game->stock > 0)
                                        <span class="stock-available">
                                            <i class="fas fa-check-circle"></i> Stok: {{ $game->stock }}
                                        </span>
                                    @else
                                        <span class="stock-out">
                                            <i class="fas fa-times-circle"></i> Stok Habis
                                        </span>
                                    @endif
                                </div>

                                <div class="action-buttons">
                                    <a href="{{ route('user.game.show', $game->id) }}" class="btn btn-detail">
                                        <i class="fas fa-eye"></i>
                                        View Detail
                                    </a>

                                    @php
                                        $isOwned = auth()->user()->games()->where('game_id', $game->id)->exists();
                                    @endphp

                                    @if ($isOwned)
                                        <a href="{{ route('play.game', $game->id) }}" class="btn btn-play">
                                            <i class="fas fa-play"></i>
                                            Play Game
                                        </a>
                                    @else
                                        <form action="{{ route('cart.add', $game->id) }}" method="POST" style="width: 100%;" onsubmit="return showAddToCartNotification('{{ $game->title }}')">
                                            @csrf
                                            <button type="submit" class="btn btn-buy" {{ $game->stock <= 0 ? 'disabled' : '' }}>
                                                <i class="fas fa-cart-plus"></i>
                                                {{ $game->stock > 0 ? 'Tambah ke Cart' : 'Stok Habis' }}
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-games">
                    <i class="fas fa-gamepad"></i>
                    <h3>Belum ada game</h3>
                    <p>Game akan segera tersedia. Silakan tunggu!</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Fungsi untuk menampilkan notifikasi
        function showNotification(title, message, isSuccess = true) {
            const notification = document.getElementById('cartNotification');
            const titleEl = document.getElementById('notificationTitle');
            const messageEl = document.getElementById('notificationMessage');
            const iconEl = document.querySelector('.notification-icon');
            
            // Update konten notifikasi
            titleEl.textContent = title;
            messageEl.textContent = message;
            
            // Update warna berdasarkan status
            if (isSuccess) {
                notification.style.borderLeftColor = '#10b981';
                iconEl.style.background = 'rgba(16, 185, 129, 0.2)';
                iconEl.style.color = '#10b981';
                iconEl.innerHTML = '<i class="fas fa-check"></i>';
            } else {
                notification.style.borderLeftColor = '#ef4444';
                iconEl.style.background = 'rgba(239, 68, 68, 0.2)';
                iconEl.style.color = '#ef4444';
                iconEl.innerHTML = '<i class="fas fa-exclamation"></i>';
            }
            
            // Tampilkan notifikasi
            notification.classList.add('show');
            
            // Auto hide setelah 3 detik
            setTimeout(hideNotification, 3000);
        }
        
        // Fungsi untuk menyembunyikan notifikasi
        function hideNotification() {
            const notification = document.getElementById('cartNotification');
            notification.classList.remove('show');
        }
        
        // Fungsi untuk show notifikasi add to cart (dipanggil sebelum form submit)
        function showAddToCartNotification(gameTitle) {
            // Tampilkan notifikasi sukses
            showNotification('Berhasil! 🎮', `"${gameTitle}" berhasil ditambahkan ke keranjang`, true);
            
            // Izinkan form untuk submit (kembalikan true)
            return true;
        }
        
        // Cek apakah ada session flash message dari server
        @if(session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                showNotification('Berhasil!', '{{ session('success') }}', true);
            });
        @endif
        
        @if(session('error'))
            document.addEventListener('DOMContentLoaded', function() {
                showNotification('Gagal!', '{{ session('error') }}', false);
            });
        @endif
    </script>

</body>

</html>
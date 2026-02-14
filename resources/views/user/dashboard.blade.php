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

        /* Content */
        .container {
            padding: 40px;
            max-width: 1400px;
            margin: 0 auto;
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

            /* TAMBAHAN */
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
            color: #64748b;
            font-size: 48px;
        }

        .game-info {
            padding: 20px;

            /* TAMBAHAN */
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

        .game-rating {
            color: #f59e0b;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .btn-buy {
            width: 100%;
            padding: 11px;
            background: linear-gradient(90deg, #10b981, #059669);
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;

            /* TAMBAHAN PENTING */
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-sizing: border-box;
        }

        .btn-detail {
            background: linear-gradient(90deg, #3b82f6, #2563eb);
        }



        .btn-buy:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }

        .btn-buy:disabled {
            background: #4b5563;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
            color: #94a3b8;
        }

        .action-buttons {
            display: grid;
            gap: 8px;

            /* INI SPACERNYA */
            margin-top: auto;
        }


        .empty-games {
            text-align: center;
            padding: 60px 20px;
            color: #64748b;
        }

        .empty-games i {
            font-size: 48px;
            margin-bottom: 16px;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <div class="logo">Farr'sStore</div>

        <form method="POST" action="/logout">
            @csrf
            <button class="logout-btn">Logout</button>
        </form>

    </div>

    <div class="container">

        <div style="margin-bottom: 30px;">
            <h2><i class="fas fa-user-circle" style="color: #60a5fa;"></i> Halo, {{ Auth::user()->name }} 👋</h2>
            <p style="color: #94a3b8; margin: 0;">Selamat datang di Farr'sStore. Jelajahi koleksi game terbaru kami!</p>
        </div>

        <div>
            <h3 style="color: #cbd5e1; font-size: 22px; margin-bottom: 20px;">
                <i class="fas fa-gamepad" style="color: #a855f7;"></i> Koleksi Game
            </h3>

            @if (isset($games) && $games->count() > 0)
                <div class="games-grid">
                    @foreach ($games as $game)
                        <div class="game-card">
                            @if ($game->cover)
                                <img src="/covers/{{ $game->cover }}" alt="{{ $game->title }}" class="game-cover">
                            @else
                                <div class="game-cover-placeholder"
                                    style="display: flex; align-items: center; justify-content: center; font-size: 64px; font-weight: 700; color: #3b82f6; background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);">
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

                                <div class="game-stock" style="margin-bottom: 12px;">
                                    @if ($game->stock > 0)
                                        <span class="stock-available"><i class="fas fa-check-circle"></i> Stok:
                                            {{ $game->stock }}</span>
                                    @else
                                        <span class="stock-out"><i class="fas fa-times-circle"></i> Stok Habis</span>
                                    @endif
                                </div>

                                <div class="action-buttons">
                                    <a href="{{ route('user.game.show', $game->id) }}" class="btn-buy btn-detail">
                                        <i class="fas fa-eye" style="margin-right: 6px;"></i>
                                        View Detail
                                    </a>

                                    <button class="btn-buy" {{ $game->stock <= 0 ? 'disabled' : '' }}>
                                        {{ $game->stock > 0 ? '🛒 Beli Sekarang' : 'Stok Habis' }}
                                    </button>
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

</body>

</html>

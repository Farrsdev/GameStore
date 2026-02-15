<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $game->title }} | Farr'sStore</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #0a0a0f;
            background:
                radial-gradient(ellipse at bottom, #0f1629 0%, #0a0a0f 50%),
                url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%23121826" fill-opacity="0.7"%3E%3Cpath d="M12 0L0 12L12 24L24 12L12 0Z M36 0L24 12L36 24L48 12L36 0Z M12 36L0 48L12 60L24 48L12 36Z M36 36L24 48L36 60L48 48L36 36Z" fill-rule="evenodd"/%3E%3C/g%3E%3C/svg%3E');
            background-attachment: fixed;
            color: #f8fafc;
        }

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
        }

        .nav-right {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .back-link {
            color: #94a3b8;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .back-link:hover {
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
        }

        .logout-btn:hover {
            background: #dc2626;
            transform: translateY(-2px);
        }

        .container {
            padding: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .game-header {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        .game-cover {
            width: 100%;
            aspect-ratio: 2/3;
            border-radius: 12px;
            object-fit: cover;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5), 0 0 30px rgba(168, 85, 247, 0.2);
        }

        .game-cover-placeholder {
            width: 100%;
            aspect-ratio: 2/3;
            background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 80px;
            color: #3b82f6;
        }

        .game-details {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .game-title {
            font-size: 36px;
            font-weight: 700;
            color: #f8fafc;
            margin-bottom: 12px;
            line-height: 1.2;
        }

        .game-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 24px;
        }

        .meta-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .meta-label {
            font-size: 12px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .meta-value {
            font-size: 16px;
            color: #e2e8f0;
        }

        .game-rating {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 16px;
        }

        .game-rating i {
            color: #f59e0b;
        }

        .badges {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 24px;
        }

        .badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
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

        .price-section {
            margin-bottom: 24px;
        }

        .price {
            font-size: 40px;
            font-weight: 700;
            color: #10b981;
            margin-bottom: 8px;
        }

        .stock-status {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
        }

        .stock-available {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
        }

        .stock-out {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }

        .buttons {
            display: grid;
            gap: 12px;
        }

        .btn {
            padding: 16px 24px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-buy {
            background: linear-gradient(90deg, #10b981, #059669);
            color: white;
        }

        .btn-buy:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
        }

        .btn-buy:disabled {
            background: #4b5563;
            color: #94a3b8;
            cursor: not-allowed;
            transform: none;
        }

        .btn-wishlist {
            background: transparent;
            color: #ef4444;
            border: 2px solid #ef4444;
        }

        .btn-wishlist:hover {
            background: rgba(239, 68, 68, 0.1);
        }

        .description-section {
            background: #121826;
            padding: 30px;
            border-radius: 12px;
            border: 1px solid #2d3748;
            margin-bottom: 40px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #cbd5e1;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-title i {
            color: #a855f7;
        }

        .description-text {
            font-size: 15px;
            line-height: 1.8;
            color: #cbd5e1;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            background: #121826;
            padding: 30px;
            border-radius: 12px;
            border: 1px solid #2d3748;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .info-label {
            font-size: 12px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .info-value {
            font-size: 16px;
            color: #e2e8f0;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .game-header {
                grid-template-columns: 1fr;
            }

            .game-title {
                font-size: 24px;
            }

            .price {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>

    <div class="navbar">
        <div class="logo">Farr'sStore</div>

        <div class="nav-right">
            <a href="{{ route('user.dashboard') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <form method="POST" action="/logout" style="display: inline;">
                @csrf
                <button class="logout-btn">Logout</button>
            </form>
        </div>
    </div>

    <div class="container">

        <div class="game-header">
            <div>
                @if ($game->cover)
                    <img src="/covers/{{ $game->cover }}" alt="{{ $game->title }}" class="game-cover">
                @else
                    <div class="game-cover-placeholder">
                        {{ strtoupper(substr($game->title, 0, 1)) }}
                    </div>
                @endif
            </div>

            <div class="game-details">
                <div>
                    <h1 class="game-title">{{ $game->title }}</h1>

                    <div class="game-meta">
                        <div class="meta-item">
                            <div class="meta-label">Developer</div>
                            <div class="meta-value">{{ $game->developer }}</div>
                        </div>
                        @if ($game->release_date)
                            <div class="meta-item">
                                <div class="meta-label">Release Date</div>
                                <div class="meta-value">{{ \Carbon\Carbon::parse($game->release_date)->format('d M Y') }}</div>
                            </div>
                        @endif
                    </div>

                    <div class="badges">
                        <span class="badge badge-platform">
                            <i class="fas fa-desktop"></i> {{ $game->platform }}
                        </span>
                        @forelse($game->genres as $genre)
                            <span class="badge badge-genre">
                                <i class="fas fa-tag"></i> {{ $genre->name }}
                            </span>
                        @empty
                            <span class="badge badge-genre">
                                <i class="fas fa-tag"></i> -
                            </span>
                        @endforelse
                        @if ($game->rating)
                            <span style="display: inline-block; padding: 8px 16px; border-radius: 8px; background: rgba(245, 158, 11, 0.2); color: #f59e0b; font-size: 13px; font-weight: 600;">
                                <i class="fas fa-star"></i> {{ $game->rating }}/10
                            </span>
                        @endif
                    </div>
                </div>

                <div>
                    <div class="price-section">
                        <div class="price">Rp {{ number_format($game->price, 0, ',', '.') }}</div>
                        <span class="stock-status {{ $game->stock > 0 ? 'stock-available' : 'stock-out' }}">
                            @if ($game->stock > 0)
                                <i class="fas fa-check-circle"></i> Stok: {{ $game->stock }}
                            @else
                                <i class="fas fa-times-circle"></i> Stok Habis
                            @endif
                        </span>
                    </div>

                    <div class="buttons">
                        @php
                            $isOwned = auth()->check() && auth()->user()->games()->where('game_id', $game->id)->exists();
                        @endphp

                        @if ($isOwned)
                            <a href="{{ route('play.game', $game->id) }}" class="btn btn-buy">
                                <i class="fas fa-play"></i> Play Game
                            </a>
                        @else
                            <form action="{{ route('cart.add', $game->id) }}" method="POST" style="width: 100%;">
                                @csrf
                                <button type="submit" class="btn btn-buy" style="width: 100%;" {{ $game->stock <= 0 ? 'disabled' : '' }}>
                                    <i class="fas fa-shopping-cart"></i>
                                    {{ $game->stock > 0 ? 'Tambah ke Cart' : 'Stok Habis' }}
                                </button>
                            </form>
                        @endif
                        
                        <button class="btn btn-wishlist">
                            <i class="fas fa-heart"></i> Tambah ke Wishlist
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="description-section">
            <h2 class="section-title">
                <i class="fas fa-book"></i> Deskripsi Game
            </h2>
            <p class="description-text">{{ $game->description }}</p>
        </div>

        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Platform</div>
                <div class="info-value">{{ $game->platform }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Genre</div>
                <div class="info-value">
                    @forelse($game->genres as $genre)
                        {{ $genre->name }}{{ !$loop->last ? ', ' : '' }}
                    @empty
                        -
                    @endforelse
                </div>
            </div>
            <div class="info-item">
                <div class="info-label">Developer</div>
                <div class="info-value">{{ $game->developer }}</div>
            </div>
            @if ($game->release_date)
                <div class="info-item">
                    <div class="info-label">Release Date</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($game->release_date)->format('d M Y') }}</div>
                </div>
            @endif
            <div class="info-item">
                <div class="info-label">Stok Tersedia</div>
                <div class="info-value">{{ $game->stock }} Unit</div>
            </div>
            <div class="info-item">
                <div class="info-label">Harga</div>
                <div class="info-value" style="color: #10b981;">Rp {{ number_format($game->price, 0, ',', '.') }}</div>
            </div>
        </div>

    </div>

</body>

</html>

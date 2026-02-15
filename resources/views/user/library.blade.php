<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>My Game Library | Farr'sStore</title>
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

        /* Container */
        .container {
            padding: 40px;
            max-width: 1400px;
            margin: 0 auto;
        }

        h1 {
            font-size: 32px;
            color: #cbd5e1;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        h1 i {
            color: #a855f7;
        }

        /* Library Stats */
        .library-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 16px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: #1a202c;
            border: 1px solid #2d3748;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            border-color: #3b82f6;
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        }

        .stat-number {
            font-size: 28px;
            font-weight: 700;
            color: #3b82f6;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 13px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Games Grid */
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
            color: #3b82f6;
            font-size: 64px;
            font-weight: 700;
        }

        .game-info {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .game-title {
            font-size: 18px;
            font-weight: 700;
            color: #f8fafc;
            margin-bottom: 6px;
            line-height: 1.3;
        }

        .game-developer {
            font-size: 14px;
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

        .badge-type {
            background: rgba(168, 85, 247, 0.2);
            color: #a855f7;
        }

        .badge-browser {
            background: rgba(59, 130, 246, 0.2);
            color: #60a5fa;
        }

        .badge-download {
            background: rgba(34, 197, 94, 0.2);
            color: #22c55e;
        }

        .ownership-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            background: rgba(34, 197, 94, 0.2);
            color: #22c55e;
            margin: 8px 0 12px 0;
            width: fit-content;
        }

        .action-buttons {
            display: grid;
            gap: 8px;
            margin-top: auto;
        }

        .btn {
            width: 100%;
            padding: 12px;
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
            gap: 8px;
        }

        .btn-play {
            background: linear-gradient(90deg, #a855f7, #9333ea);
            box-shadow: 0 4px 10px rgba(168, 85, 247, 0.3);
        }

        .btn-play:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(168, 85, 247, 0.4);
        }

        .btn-download {
            background: linear-gradient(90deg, #22c55e, #16a34a);
            box-shadow: 0 4px 10px rgba(34, 197, 94, 0.3);
        }

        .btn-download:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(34, 197, 94, 0.4);
        }

        /* Empty Library */
        .empty-library {
            background: #1a202c;
            border-radius: 12px;
            border: 1px solid #2d3748;
            padding: 60px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .empty-library i {
            font-size: 48px;
            color: #3b82f6;
            margin-bottom: 20px;
            display: block;
        }

        .empty-library h2 {
            font-size: 24px;
            font-weight: 700;
            color: #cbd5e1;
            margin-bottom: 10px;
        }

        .empty-library p {
            color: #94a3b8;
            margin-bottom: 20px;
        }

        .btn-browse {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(90deg, #3b82f6, #2563eb);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-browse:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
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
            
            .library-stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="logo">Farr'sStore</div>

        <div class="nav-right">
            <a href="{{ route('user.dashboard') }}" class="nav-link">
                <i class="fas fa-store"></i> Browse
            </a>
            <a href="{{ route('user.library') }}" class="nav-link active">
                <i class="fas fa-gamepad"></i> My Library
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

    <div class="container">
        <h1>
            <i class="fas fa-library"></i> My Game Library
        </h1>

        @if($ownedGames && $ownedGames->count() > 0)
            <!-- Library Stats -->
            <div class="library-stats">
                <div class="stat-card">
                    <div class="stat-number">{{ $ownedGames->count() }}</div>
                    <div class="stat-label">Games Owned</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $ownedGames->where('type', 'browser')->count() }}</div>
                    <div class="stat-label">
                        <i class="fas fa-globe"></i> Browser Games
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $ownedGames->where('type', 'download')->count() }}</div>
                    <div class="stat-label">
                        <i class="fas fa-download"></i> Download Games
                    </div>
                </div>
            </div>

            <!-- Games Grid -->
            <div class="games-grid">
                @foreach ($ownedGames as $game)
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
                                <span class="badge {{ $game->type === 'browser' ? 'badge-browser' : 'badge-download' }}">
                                    @if($game->type === 'browser')
                                        <i class="fas fa-globe"></i> Browser
                                    @else
                                        <i class="fas fa-download"></i> Download
                                    @endif
                                </span>
                            </div>

                            <div class="ownership-badge">
                                <i class="fas fa-check-circle"></i> Owned & Ready
                            </div>

                            <div class="action-buttons">
                                <a href="{{ route('play.game', $game->id) }}" 
                                   class="btn {{ $game->type === 'browser' ? 'btn-play' : 'btn-download' }}">
                                    <i class="fas {{ $game->type === 'browser' ? 'fa-play' : 'fa-download' }}"></i>
                                    @if($game->type === 'browser')
                                        Play Now
                                    @else
                                        Download Game
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-library">
                <i class="fas fa-inbox"></i>
                <h2>Your library is empty</h2>
                <p>You haven't purchased any games yet. Start shopping!</p>
                <a href="{{ route('user.dashboard') }}" class="btn-browse">
                    <i class="fas fa-store"></i> Browse Games
                </a>
            </div>
        @endif
    </div>

</body>

</html>
<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | Farr'sStore</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #0a0a0f;
            /* Fallback */
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
            /* Slightly darker navbar background */
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #2d3748;
            /* Darker border */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            /* Subtle shadow for depth */
        }

        .logo {
            font-size: 24px;
            /* Slightly larger font */
            font-weight: 800;
            background: linear-gradient(90deg, #60a5fa, #3b82f6, #2563eb);
            /* Blue gradient for consistency */
            -webkit-background-clip: text;
            color: transparent;
            letter-spacing: 1.2px;
            /* Added letter spacing */
            text-shadow: 0 0 10px rgba(59, 130, 246, 0.4);
            /* Subtle blue glow */
        }

        .logout-btn {
            background: #ef4444;
            border: none;
            padding: 10px 20px;
            /* Slightly more padding */
            border-radius: 8px;
            color: white;
            cursor: pointer;
            font-weight: 600;
            /* Bolder text */
            transition: all 0.3s ease;
            /* Smooth transition */
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3);
            /* Red shadow */
        }

        .logout-btn:hover {
            background: #dc2626;
            /* Darker red on hover */
            box-shadow: 0 6px 15px rgba(239, 68, 68, 0.4);
            /* More pronounced shadow */
            transform: translateY(-2px);
            /* Lift effect */
        }

        /* Content */
        .container {
            padding: 40px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            /* Adjusted minmax for slightly larger cards */
            gap: 30px;
            /* Increased gap */
        }

        .card {
            background: #121826;
            padding: 30px;
            /* More padding */
            border-radius: 14px;
            border: 1px solid #2d3748;
            /* Darker, more defined border */
            box-shadow:
                0 10px 20px rgba(0, 0, 0, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.05);
            /* Enhanced shadow and inner highlight */
            transition: all 0.3s ease;
            /* Smooth transition for hover */
            display: flex;
            /* Flexbox for content alignment */
            flex-direction: column;
            justify-content: space-between;
        }

        .card:hover {
            transform: translateY(-5px);
            /* Lift effect on hover */
            box-shadow:
                0 15px 30px rgba(0, 0, 0, 0.5),
                0 0 20px rgba(59, 130, 246, 0.2);
            /* Subtle blue glow on hover */
        }

        .card h3 {
            margin-bottom: 12px;
            /* Adjusted margin */
            font-size: 20px;
            /* Slightly larger font */
            color: #cbd5e1;
            /* Lighter heading color */
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            /* Adjusted minmax for slightly larger cards */
            gap: 30px;
            /* Increased gap */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        thead {
            background: #1a202c;
        }

        th {
            padding: 16px;
            text-align: left;
            font-weight: 600;
            color: #cbd5e1;
            border-bottom: 2px solid #2d3748;
        }

        td {
            padding: 14px 16px;
            border-bottom: 1px solid #2d3748;
            color: #e2e8f0;
            font-size: 14px;
        }

        tbody tr:hover {
            background: #1a202c;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
            margin: 0 4px;
            display: inline-block;
            text-decoration: none;
            border-radius: 4px;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
        }

        .btn-edit {
            background: #3b82f6;
            color: white;
        }

        .btn-edit:hover {
            background: #2563eb;
        }

        .btn-delete {
            background: #ef4444;
            color: white;
        }

        .btn-delete:hover {
            background: #dc2626;
        }

        .btn-add {
            background: linear-gradient(90deg, #10b981, #059669);
            color: white;
            padding: 12px 24px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: linear-gradient(135deg, #1a202c 0%, #0f172a 100%);
            padding: 24px;
            border-radius: 12px;
            border: 1px solid #2d3748;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.4);
        }

        .stat-label {
            font-size: 13px;
            color: #94a3b8;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: #f8fafc;
            margin-bottom: 8px;
        }

        .stat-icon {
            font-size: 24px;
            margin-bottom: 12px;
        }

        .stat-icon.games {
            color: #a855f7;
        }

        .stat-icon.stock {
            color: #10b981;
        }

        .stat-icon.users {
            color: #3b82f6;
        }

        .section-title {
            color: #cbd5e1;
            font-size: 22px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: #a855f7;
        }

        .recent-games-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .recent-game-card {
            background: #1a202c;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #2d3748;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .recent-game-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5), 0 0 20px rgba(168, 85, 247, 0.1);
            border-color: #a855f7;
        }

        .game-cover-small {
            width: 100%;
            height: 150px;
            object-fit: cover;
            background: #2d3748;
        }

        .game-info-small {
            padding: 16px;
        }

        .game-title-small {
            font-size: 15px;
            font-weight: 700;
            color: #f8fafc;
            margin-bottom: 4px;
        }

        .game-developer-small {
            font-size: 12px;
            color: #94a3b8;
            margin-bottom: 12px;
        }

        .game-price-small {
            font-size: 16px;
            font-weight: 700;
            color: #10b981;
            margin-bottom: 10px;
        }

        .btn-view {
            width: 100%;
            padding: 9px;
            background: linear-gradient(90deg, #3b82f6, #2563eb);
            border: none;
            border-radius: 6px;
            color: white;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-view:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        </style>

</head>

<body>

    <div class="navbar">
        <div class="logo">Admin Panel</div>

        <div class="nav-links" style="display: flex; gap: 15px; align-items: center;">
            <a href="{{ route('admin.games.index') }}" style="color: #94a3b8; text-decoration: none; font-weight: 500; transition: color 0.3s; display: flex; align-items: center; gap: 6px;">
                <i class="fas fa-gamepad"></i> Games
            </a>
            <a href="{{ route('admin.genres.index') }}" style="color: #94a3b8; text-decoration: none; font-weight: 500; transition: color 0.3s; display: flex; align-items: center; gap: 6px;">
                <i class="fas fa-tag"></i> Genres
            </a>
            <form method="POST" action="/logout" style="display: inline;">
                @csrf
                <button class="logout-btn">Logout</button>
            </form>
        </div>

    </div>

    <div class="container">

        <div style="margin-bottom: 30px;">
            <h2 style="color: #cbd5e1; margin: 0 0 5px 0;">Halo Admin, {{ Auth::user()->name }} 👑</h2>
            <p style="color: #94a3b8; margin: 0;">Kelola seluruh sistem Farr'sStore dari sini.</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon games">
                    <i class="fas fa-gamepad"></i>
                </div>
                <div class="stat-label">Total Games</div>
                <div class="stat-number">{{ $totalGames }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon stock">
                    <i class="fas fa-boxes"></i>
                </div>
                <div class="stat-label">Total Stock</div>
                <div class="stat-number">{{ $totalStock }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon users">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-label">Total Users</div>
                <div class="stat-number">{{ $totalUsers }}</div>
            </div>
        </div>

        <div>
            <h3 class="section-title">
                <i class="fas fa-star"></i> Game Terbaru
            </h3>

            @if ($recentGames->count() > 0)
                <div class="recent-games-grid">
                    @foreach ($recentGames as $game)
                        <div class="recent-game-card">
                            @if ($game->cover)
                                <img src="/covers/{{ $game->cover }}" alt="{{ $game->title }}" class="game-cover-small">
                            @else
                                <div style="width: 100%; height: 150px; background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%); display: flex; align-items: center; justify-content: center; font-size: 48px; color: #3b82f6;">
                                    {{ strtoupper(substr($game->title, 0, 1)) }}
                                </div>
                            @endif
                            <div class="game-info-small">
                                <div class="game-title-small">{{ $game->title }}</div>
                                <div class="game-developer-small">{{ $game->developer }}</div>
                                <div class="game-price-small">Rp {{ number_format($game->price, 0, ',', '.') }}</div>
                                <a href="{{ route('admin.games.edit', $game->id) }}" class="btn-view">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="text-align: center; padding: 40px 20px; color: #94a3b8;">
                    <i class="fas fa-inbox" style="font-size: 32px; margin-bottom: 10px; display: block;"></i>
                    <p>Belum ada game. <a href="{{ route('admin.games.create') }}" style="color: #3b82f6; text-decoration: none;">Tambah game sekarang!</a></p>
                </div>
            @endif
        </div>

    </div>

</body>

</html>

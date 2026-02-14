<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Manage Games | Farr'sStore Admin</title>
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
            background: linear-gradient(90deg, #60a5fa, #3b82f6, #2563eb);
            -webkit-background-clip: text;
            color: transparent;
            letter-spacing: 1.2px;
        }

        .nav-links {
            display: flex;
            gap: 20px;
        }

        .nav-link {
            color: #94a3b8;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
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
            max-width: 1400px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            color: #cbd5e1;
            margin: 0;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(90deg, #3b82f6, #2563eb);
            color: white;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.5);
        }

        .btn-danger {
            background: #ef4444;
            color: white;
            padding: 8px 16px;
            font-size: 14px;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .btn-warning {
            background: #f59e0b;
            color: white;
            padding: 8px 16px;
            font-size: 14px;
        }

        .btn-warning:hover {
            background: #d97706;
        }

        .btn-info {
            background: #3b82f6;
            color: white;
            padding: 8px 16px;
            font-size: 14px;
        }

        .btn-info:hover {
            background: #2563eb;
        }

        .card {
            background: #121826;
            border-radius: 14px;
            border: 1px solid #2d3748;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 16px 20px;
            text-align: left;
        }

        .table th {
            background: #1a202c;
            color: #94a3b8;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table td {
            color: #e2e8f0;
            border-bottom: 1px solid #2d3748;
        }

        .table tr:hover td {
            background: #1a202c;
        }

        .game-cover {
            width: 60px;
            height: 80px;
            object-fit: cover;
            border-radius: 6px;
        }

        .game-cover-placeholder {
            width: 60px;
            height: 80px;
            background: #2d3748;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
        }

        .badge-warning {
            background: rgba(245, 158, 11, 0.2);
            color: #f59e0b;
        }

        .badge-danger {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .alert {
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.2);
            border: 1px solid #10b981;
            color: #10b981;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid #ef4444;
            color: #ef4444;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #94a3b8;
            text-decoration: none;
            margin-bottom: 20px;
            transition: color 0.3s;
        }

        .back-link:hover {
            color: #60a5fa;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            padding: 20px;
        }

        .pagination a {
            padding: 8px 16px;
            background: #1a202c;
            color: #94a3b8;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.3s;
        }

        .pagination a:hover,
        .pagination a.active {
            background: #3b82f6;
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #64748b;
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 16px;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="logo">Farr'sStore Admin</div>
        <div class="nav-links">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
            <a href="{{ route('admin.games.index') }}" class="nav-link active">Games</a>
            <a href="{{ route('admin.genres.index') }}" class="nav-link">Genres</a>
        </div>
        <form method="POST" action="/logout">
            @csrf
            <button class="logout-btn">Logout</button>
        </form>
    </div>

    <div class="container">
        <a href="{{ route('admin.dashboard') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        <div class="header">
            <h1><i class="fas fa-gamepad"></i> Manage Games</h1>
            <a href="{{ route('admin.games.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Game
            </a>
        </div>

        <div class="card">
            @if ($games->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>Cover</th>
                            <th>Title</th>
                            <th>Developer</th>
                            <th>Platform</th>
                            <th>Genre</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($games as $game)
                            <tr>
                                <td>
                                    @if ($game->cover)
                                        <img src="/covers/{{ $game->cover }}"
                                            alt="{{ $game->title }}" class="game-cover">
                                    @else
                                        <div class="game-cover-placeholder" style="display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: 700; color: #3b82f6;">
                                            {{ strtoupper(substr($game->title, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $game->title }}</strong>
                                    @if ($game->rating)
                                        <br><small style="color: #f59e0b;"><i class="fas fa-star"></i>
                                            {{ $game->rating }}</small>
                                    @endif
                                </td>
                                <td>{{ $game->developer }}</td>
                                <td>{{ $game->platform }}</td>
                                <td>
                                    @forelse($game->genres as $genre)
                                        <span class="badge badge-success" style="display: inline-block; margin: 2px;">{{ $genre->name }}</span>
                                    @empty
                                        <span style="color: #ef4444;">-</span>
                                    @endforelse
                                </td>
                                <td>
                                    @if ($game->stock > 0)
                                        <span class="badge badge-success">{{ $game->stock }}</span>
                                    @else
                                        <span class="badge badge-danger">Out of Stock</span>
                                    @endif
                                </td>
                                <td>Rp {{ number_format($game->price, 0, ',', '.') }}</td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('admin.games.show', $game->id) }}" class="btn btn-info"
                                            title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.games.edit', $game->id) }}" class="btn btn-warning"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.games.destroy', $game->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this game?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $games->links() }}
            @else
                <div class="empty-state">
                    <i class="fas fa-gamepad"></i>
                    <h3>No games found</h3>
                    <p>Start by adding your first game!</p>
                    <a href="{{ route('admin.games.create') }}" class="btn btn-primary" style="margin-top: 16px;">
                        <i class="fas fa-plus"></i> Add New Game
                    </a>
                </div>
            @endif
        </div>
    </div>
</body>

</html>

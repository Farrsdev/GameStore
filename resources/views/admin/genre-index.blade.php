<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manage Genres | Farr'sStore Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto; background: #0a0a0f; color: #f8fafc; margin: 0; background: radial-gradient(ellipse at bottom, #0f1629 0%, #0a0a0f 50%), url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%23121826" fill-opacity="0.7"%3E%3Cpath d="M12 0L0 12L12 24L24 12L12 0Z M36 0L24 12L36 24L48 12L36 0Z M12 36L0 48L12 60L24 48L12 36Z M36 36L24 48L36 60L48 48L36 36Z" fill-rule="evenodd"/%3E%3C/g%3E%3C/svg%3E'); background-attachment: fixed; }
        .navbar { background: #1a202c; padding: 18px 40px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #2d3748; box-shadow: 0 4px 15px rgba(0,0,0,0.3); }
        .logo { font-size: 24px; font-weight: 800; background: linear-gradient(90deg, #60a5fa, #3b82f6, #2563eb); -webkit-background-clip: text; color: transparent; }
        .nav-links { display: flex; gap: 20px; }
        .nav-link { color: #94a3b8; text-decoration: none; font-weight: 500; }
        .nav-link:hover { color: #60a5fa; }
        .logout-btn { background: #ef4444; border: none; padding: 10px 20px; border-radius: 8px; color: white; cursor: pointer; font-weight: 600; }
        .logout-btn:hover { background: #dc2626; }
        .container { padding: 40px; max-width: 1000px; margin: 0 auto; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        h1 { font-size: 28px; color: #cbd5e1; }
        .btn-primary { background: linear-gradient(90deg, #10b981, #059669); color: white; padding: 12px 24px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
        .btn-primary:hover { transform: translateY(-2px); }
        .alert { padding: 16px; border-radius: 8px; margin-bottom: 20px; }
        .alert-success { background: rgba(16,185,129,0.2); border: 1px solid #10b981; color: #10b981; }
        .back-link { color: #94a3b8; text-decoration: none; margin-bottom: 20px; display: inline-flex; align-items: center; gap: 6px; }
        .back-link:hover { color: #60a5fa; }
        table { width: 100%; border-collapse: collapse; background: #121826; border-radius: 12px; overflow: hidden; border: 1px solid #2d3748; box-shadow: 0 4px 12px rgba(0,0,0,0.3); }
        thead { background: #1a202c; }
        th { padding: 16px; text-align: left; font-weight: 600; color: #cbd5e1; border-bottom: 2px solid #2d3748; }
        td { padding: 14px 16px; border-bottom: 1px solid #2d3748; color: #e2e8f0; font-size: 14px; }
        tbody tr:hover { background: #1a202c; }
        .btn-sm { padding: 6px 12px; font-size: 13px; margin: 0 4px; display: inline-block; text-decoration: none; border-radius: 4px; border: none; cursor: pointer; }
        .btn-edit { background: #3b82f6; color: white; }
        .btn-edit:hover { background: #2563eb; }
        .btn-delete { background: #ef4444; color: white; }
        .btn-delete:hover { background: #dc2626; }
        .empty-state { text-align: center; padding: 60px 20px; color: #94a3b8; }
        .empty-state i { font-size: 48px; margin-bottom: 16px; display: block; }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo">Farr'sStore Admin</div>
        <div class="nav-links">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="{{ route('admin.games.index') }}" class="nav-link">
                <i class="fas fa-gamepad"></i> Games
            </a>
            <a href="{{ route('admin.genres.index') }}" class="nav-link active">
                <i class="fas fa-tag"></i> Genres
            </a>
            <form method="POST" action="/logout" style="display: inline;">
                @csrf
                <button class="logout-btn">Logout</button>
            </form>
        </div>
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

        <div class="header">
            <h1><i class="fas fa-tag"></i> Manage Genres</h1>
            <a href="{{ route('admin.genres.create') }}" class="btn-primary">
                <i class="fas fa-plus"></i> Add New Genre
            </a>
        </div>

        @if ($genres->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Genre Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($genres as $genre)
                        <tr>
                            <td><strong>{{ $genre->name }}</strong></td>
                            <td><code style="background: #2d3748; padding: 4px 8px; border-radius: 4px;">{{ $genre->slug }}</code></td>
                            <td>{{ Str::limit($genre->description ?? '-', 50, '...') }}</td>
                            <td>
                                <a href="{{ route('admin.genres.edit', $genre->id) }}" class="btn-sm btn-edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.genres.destroy', $genre->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-sm btn-delete">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="margin-top: 20px;">
                {{ $genres->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h3>No genres yet</h3>
                <p><a href="{{ route('admin.genres.create') }}" style="color: #3b82f6; text-decoration: none;">Create your first genre!</a></p>
            </div>
        @endif
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Add Genre | Farr'sStore Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto; background: #0a0a0f; color: #f8fafc; margin: 0; background: radial-gradient(ellipse at bottom, #0f1629 0%, #0a0a0f 50%), url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%23121826" fill-opacity="0.7"%3E%3Cpath d="M12 0L0 12L12 24L24 12L12 0Z M36 0L24 12L36 24L48 12L36 0Z M12 36L0 48L12 60L24 48L12 36Z M36 36L24 48L36 60L48 48L36 36Z" fill-rule="evenodd"/%3E%3C/g%3E%3C/svg%3E'); background-attachment: fixed; }
        .navbar { background: #1a202c; padding: 18px 40px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #2d3748; box-shadow: 0 4px 15px rgba(0,0,0,0.3); }
        .logo { font-size: 24px; font-weight: 800; background: linear-gradient(90deg, #60a5fa, #3b82f6, #2563eb); -webkit-background-clip: text; color: transparent; }
        .logout-btn { background: #ef4444; border: none; padding: 10px 20px; border-radius: 8px; color: white; cursor: pointer; font-weight: 600; }
        .logout-btn:hover { background: #dc2626; }
        .container { padding: 40px; max-width: 600px; margin: 0 auto; }
        h1 { font-size: 28px; color: #cbd5e1; margin-bottom: 30px; }
        .card { background: #121826; border-radius: 14px; border: 1px solid #2d3748; padding: 30px; box-shadow: 0 10px 20px rgba(0,0,0,0.4); }
        .form-group { margin-bottom: 24px; }
        label { display: block; margin-bottom: 8px; color: #94a3b8; font-weight: 600; font-size: 14px; }
        .form-control { width: 100%; padding: 14px 16px; background: #1a202c; border: 1px solid #2d3748; border-radius: 8px; color: #f8fafc; font-size: 15px; box-sizing: border-box; }
        .form-control:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,0.2); }
        textarea.form-control { min-height: 120px; resize: vertical; }
        .btn { padding: 14px 28px; border-radius: 8px; font-weight: 600; border: none; cursor: pointer; font-size: 15px; }
        .btn-primary { background: linear-gradient(90deg, #3b82f6, #2563eb); color: white; }
        .btn-primary:hover { transform: translateY(-2px); }
        .btn-secondary { background: #374151; color: #94a3b8; }
        .btn-secondary:hover { background: #4b5563; }
        .btn-group { display: flex; gap: 12px; margin-top: 30px; }
        .back-link { display: inline-flex; align-items: center; gap: 8px; color: #94a3b8; text-decoration: none; margin-bottom: 20px; }
        .back-link:hover { color: #60a5fa; }
        .error-message { color: #ef4444; font-size: 13px; margin-top: 6px; }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo">Farr'sStore Admin</div>
        <form method="POST" action="/logout">
            @csrf
            <button class="logout-btn">Logout</button>
        </form>
    </div>

    <div class="container">
        <a href="{{ route('admin.genres.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Genres
        </a>

        <h1><i class="fas fa-plus-circle"></i> Add New Genre</h1>

        <div class="card">
            <form action="{{ route('admin.genres.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Genre Name *</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="e.g., Action, RPG, Sports" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" placeholder="Brief description about this genre">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Genre
                    </button>
                    <a href="{{ route('admin.genres.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Game | Farr'sStore Admin</title>
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
            max-width: 800px;
            margin: 0 auto;
        }

        h1 {
            font-size: 28px;
            color: #cbd5e1;
            margin-bottom: 30px;
        }

        .card {
            background: #121826;
            border-radius: 14px;
            border: 1px solid #2d3748;
            padding: 30px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
        }

        .form-group {
            margin-bottom: 24px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #94a3b8;
            font-weight: 600;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px;
            background: #1a202c;
            border: 1px solid #2d3748;
            border-radius: 8px;
            color: #f8fafc;
            font-size: 15px;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .form-control::placeholder {
            color: #64748b;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .btn {
            display: inline-block;
            padding: 14px 28px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 15px;
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

        .btn-secondary {
            background: #374151;
            color: #94a3b8;
        }

        .btn-secondary:hover {
            background: #4b5563;
            color: #f8fafc;
        }

        .btn-group {
            display: flex;
            gap: 12px;
            margin-top: 30px;
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

        .error-message {
            color: #ef4444;
            font-size: 13px;
            margin-top: 6px;
        }

        .current-cover {
            margin-bottom: 16px;
        }

        .current-cover img {
            width: 120px;
            height: 160px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #2d3748;
        }

        .current-cover p {
            color: #64748b;
            font-size: 13px;
            margin-top: 8px;
        }

        .file-input-wrapper {
            position: relative;
        }

        .file-input-wrapper input[type="file"] {
            display: none;
        }

        .file-input-label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: #1a202c;
            border: 2px dashed #2d3748;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-input-label:hover {
            border-color: #3b82f6;
            background: rgba(59, 130, 246, 0.1);
        }

        .file-input-label i {
            font-size: 32px;
            color: #64748b;
            margin-bottom: 10px;
        }

        .file-input-label p {
            color: #64748b;
            margin: 0;
        }

        .image-preview {
            margin-top: 15px;
            text-align: center;
            display: none;
        }

        .image-preview img {
            max-width: 100%;
            height: 200px;
            border-radius: 8px;
            object-fit: cover;
        }
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
        <a href="{{ route('admin.games.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Games
        </a>

        <h1><i class="fas fa-edit"></i> Edit Game</h1>

        <div class="card">
            <form action="{{ route('admin.games.update', $game->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Game Title *</label>
                    <input type="text" name="title" id="title" class="form-control"
                        placeholder="Enter game title" value="{{ old('title', $game->title) }}" required>
                    @error('title')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description *</label>
                    <textarea name="description" id="description" class="form-control" placeholder="Enter game description" required>{{ old('description', $game->description) }}</textarea>
                    @error('description')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="developer">Developer *</label>
                        <input type="text" name="developer" id="developer" class="form-control"
                            placeholder="e.g., Rockstar Games" value="{{ old('developer', $game->developer) }}"
                            required>
                        @error('developer')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="platform">Platform *</label>
                        <input type="text" name="platform" id="platform" class="form-control"
                            placeholder="e.g., PC, PS5, Xbox" value="{{ old('platform', $game->platform) }}" required>
                        @error('platform')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="genre">Genre *</label>
                    <input type="text" name="genre" id="genre" class="form-control"
                        placeholder="e.g., Action, Adventure, RPG" value="{{ old('genre', $game->genre) }}" required>
                    @error('genre')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Genres * <small style="color: #64748b; font-weight: 400;">(Pilih minimal 1)</small></label>
                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; margin-top: 10px;">
                        @forelse($genres as $genre)
                            <div style="display: flex; align-items: center;">
                                <input type="checkbox" name="genres[]" id="genre_{{ $genre->id }}"
                                    value="{{ $genre->id }}"
                                    {{ in_array($genre->id, old('genres', $selectedGenres)) ? 'checked' : '' }}
                                    style="width: 18px; height: 18px; cursor: pointer; margin-right: 8px; accent-color: #3b82f6;">
                                <label for="genre_{{ $genre->id }}"
                                    style="margin: 0; cursor: pointer; font-weight: 400; font-size: 14px;">
                                    {{ $genre->name }}
                                </label>
                            </div>
                        @empty
                            <p style="color: #ef4444; grid-column: 1 / -1;">
                                No genres available. <a href="{{ route('admin.genres.create') }}"
                                    style="color: #3b82f6; text-decoration: none;">Create one first!</a>
                            </p>
                        @endforelse
                    </div>
                    @error('genres')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="release_date">Release Date</label>
                        <input type="date" name="release_date" id="release_date" class="form-control"
                            value="{{ old('release_date', $game->release_date) }}">
                        @error('release_date')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="stock">Stock *</label>
                        <input type="number" name="stock" id="stock" class="form-control"
                            placeholder="Available quantity" value="{{ old('stock', $game->stock) }}" min="0"
                            required>
                        @error('stock')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price">Price (Rp) *</label>
                        <input type="number" name="price" id="price" class="form-control"
                            placeholder="Price in Rupiah" value="{{ old('price', $game->price) }}" min="0"
                            step="0.01" required>
                        @error('price')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="rating">Rating (0-10)</label>
                    <input type="number" name="rating" id="rating" class="form-control"
                        placeholder="e.g., 8.5" value="{{ old('rating', $game->rating) }}" min="0"
                        max="10" step="0.1">
                    @error('rating')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- GAME TYPE SECTION (NEW) -->
                <div class="form-group">
                    <label for="type">Game Type *</label>
                    <select name="type" id="type" class="form-control" required onchange="toggleGameTypeFields()">
                        <option value="">-- Select Game Type --</option>
                        <option value="browser" {{ old('type', $game->type) == 'browser' ? 'selected' : '' }}>Browser Game (Iframe)</option>
                        <option value="download" {{ old('type', $game->type) == 'download' ? 'selected' : '' }}>Download Game (File)</option>
                    </select>
                    @error('type')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- EMBED URL (for browser games) -->
                <div class="form-group" id="embedUrlGroup" style="display: none;">
                    <label for="embed_url">Embed URL (Browser Game) *</label>
                    <input type="url" name="embed_url" id="embed_url" class="form-control"
                        placeholder="e.g., https://example.com/game" value="{{ old('embed_url', $game->embed_url) }}">
                    <small style="color: #64748b; margin-top: 6px; display: block;">URL of the iframe to embed. Required for browser games.</small>
                    @error('embed_url')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- FILE PATH (for download games) -->
                <div class="form-group" id="filePathGroup" style="display: none;">
                    <label for="file_path">File Path (Download Game) *</label>
                    <input type="text" name="file_path" id="file_path" class="form-control"
                        placeholder="e.g., /storage/games/game-name.zip" value="{{ old('file_path', $game->file_path) }}">
                    <small style="color: #64748b; margin-top: 6px; display: block;">Path to downloadable game file. Required for download games.</small>
                    @error('file_path')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="cover">Cover Image</label>
                    @if ($game->cover)
                        <div class="current-cover">
                            <img src="/covers/{{ $game->cover }}" alt="{{ $game->title }}">
                            <p>Current cover image</p>
                        </div>
                    @endif
                    <div class="file-input-wrapper">
                        <label for="cover" class="file-input-label" id="coverLabel">
                            <div style="text-align: center;">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p>Click to upload new cover image</p>
                                <p style="font-size: 12px; margin-top: 4px;">(JPEG, PNG, JPG, GIF, SVG - Max 2MB)</p>
                            </div>
                        </label>
                        <input type="file" name="cover" id="cover" accept="image/*">
                        <div class="image-preview" id="imagePreview">
                            <img id="previewImage" src="" alt="Preview">
                            <p style="color: #94a3b8; margin-top: 10px; font-size: 14px;" id="fileName"></p>
                        </div>
                    </div>
                    @error('cover')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Game
                    </button>
                    <a href="{{ route('admin.games.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Toggle game type fields
        function toggleGameTypeFields() {
            const type = document.getElementById('type').value;
            const embedUrlGroup = document.getElementById('embedUrlGroup');
            const filePathGroup = document.getElementById('filePathGroup');
            const embedUrlInput = document.getElementById('embed_url');
            const filePathInput = document.getElementById('file_path');

            if (type === 'browser') {
                embedUrlGroup.style.display = 'block';
                filePathGroup.style.display = 'none';
                embedUrlInput.required = true;
                filePathInput.required = false;
            } else if (type === 'download') {
                embedUrlGroup.style.display = 'none';
                filePathGroup.style.display = 'block';
                embedUrlInput.required = false;
                filePathInput.required = true;
            } else {
                embedUrlGroup.style.display = 'none';
                filePathGroup.style.display = 'none';
                embedUrlInput.required = false;
                filePathInput.required = false;
            }
        }

        // Initialize on page load
        window.addEventListener('load', function() {
            toggleGameTypeFields();
        });

        document.getElementById('cover').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('previewImage').src = event.target.result;
                    document.getElementById('fileName').textContent = file.name;
                    document.getElementById('imagePreview').style.display = 'block';
                    document.getElementById('coverLabel').style.display = 'none';
                };
                reader.readAsDataURL(file);
            }
        });

        // Form submission validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const checkedGenres = document.querySelectorAll('input[name="genres[]"]:checked');
            if (checkedGenres.length === 0) {
                e.preventDefault();
                alert('Please select at least one genre');
                return false;
            }

            const type = document.getElementById('type').value;
            if (!type) {
                e.preventDefault();
                alert('Please select a game type (Browser or Download)');
                return false;
            }

            if (type === 'browser' && !document.getElementById('embed_url').value) {
                e.preventDefault();
                alert('Please enter Embed URL for browser games');
                return false;
            }

            if (type === 'download' && !document.getElementById('file_path').value) {
                e.preventDefault();
                alert('Please enter File Path for download games');
                return false;
            }
        });
    </script>
</body>

</html>

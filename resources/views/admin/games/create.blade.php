<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Add New Game | Farr'sStore Admin</title>
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
            height: 300px;
            border-radius: 8px;
            object-fit: cover;
        }

        /* Style untuk genre combobox */
        .genre-container {
            position: relative;
        }

        .genre-input-wrapper {
            position: relative;
            cursor: pointer;
        }

        .genre-input-wrapper::after {
            content: '\f078';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            pointer-events: none;
            transition: transform 0.3s ease;
        }

        .genre-input-wrapper.active::after {
            transform: translateY(-50%) rotate(180deg);
        }

        .genre-input {
            width: 100%;
            padding: 14px 16px;
            background: #1a202c;
            border: 1px solid #2d3748;
            border-radius: 8px;
            color: #f8fafc;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-sizing: border-box;
            padding-right: 40px;
        }

        .genre-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .genre-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #1a202c;
            border: 1px solid #2d3748;
            border-radius: 8px;
            margin-top: 4px;
            max-height: 300px;
            overflow-y: auto;
            z-index: 1000;
            display: none;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
        }

        .genre-dropdown.show {
            display: block;
        }

        .genre-dropdown-item {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            border-bottom: 1px solid #2d3748;
            transition: background 0.2s ease;
        }

        .genre-dropdown-item:last-child {
            border-bottom: none;
        }

        .genre-dropdown-item:hover {
            background: #2d3748;
        }

        .genre-checkbox {
            width: 18px;
            height: 18px;
            margin-right: 12px;
            cursor: pointer;
            accent-color: #3b82f6;
        }

        .genre-dropdown-item label {
            margin: 0;
            cursor: pointer;
            font-weight: 400;
            font-size: 14px;
            flex: 1;
        }

        .selected-genres {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 12px;
            min-height: 32px;
        }

        .selected-genre-tag {
            background: #2d3748;
            border: 1px solid #3b82f6;
            border-radius: 6px;
            padding: 4px 12px;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #f8fafc;
        }

        .selected-genre-tag i {
            color: #ef4444;
            cursor: pointer;
            font-size: 12px;
            transition: color 0.2s ease;
        }

        .selected-genre-tag i:hover {
            color: #dc2626;
        }

        .no-genres-message {
            color: #ef4444;
            padding: 12px;
            text-align: center;
        }

        .no-genres-message a {
            color: #3b82f6;
            text-decoration: none;
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

        <h1><i class="fas fa-plus-circle"></i> Add New Game</h1>

        <div class="card">
            <form action="{{ route('admin.games.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="title">Game Title *</label>
                    <input type="text" name="title" id="title" class="form-control"
                        placeholder="Enter game title" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description *</label>
                    <textarea name="description" id="description" class="form-control" placeholder="Enter game description" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="developer">Developer *</label>
                        <input type="text" name="developer" id="developer" class="form-control"
                            placeholder="e.g., Rockstar Games" value="{{ old('developer') }}" required>
                        @error('developer')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="platform">Platform *</label>
                        <input type="text" name="platform" id="platform" class="form-control"
                            placeholder="e.g., PC, PS5, Xbox" value="{{ old('platform') }}" required>
                        @error('platform')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Genres * <small style="color: #64748b; font-weight: 400;">(Click to select
                            genres)</small></label>

                    <div class="genre-container">
                        <div class="genre-input-wrapper" id="genreInputWrapper">
                            <input type="text" class="genre-input" id="genreSearchInput"
                                placeholder="Click to select genres..." readonly>
                        </div>

                        <!-- Selected genres tags -->
                        <div class="selected-genres" id="selectedGenres">
                            @if (old('genres'))
                                @foreach ($genres->whereIn('id', old('genres')) as $selectedGenre)
                                    <span class="selected-genre-tag" data-id="{{ $selectedGenre->id }}">
                                        {{ $selectedGenre->name }}
                                        <i class="fas fa-times" onclick="removeGenre({{ $selectedGenre->id }})"></i>
                                    </span>
                                @endforeach
                            @endif
                        </div>

                        <!-- Genre dropdown -->
                        <div class="genre-dropdown" id="genreDropdown">
                            @forelse($genres as $genre)
                                <div class="genre-dropdown-item">
                                    <input type="checkbox" class="genre-checkbox" id="genre_{{ $genre->id }}"
                                        name="genres[]" value="{{ $genre->id }}"
                                        {{ in_array($genre->id, old('genres', [])) ? 'checked' : '' }}
                                        onchange="toggleGenre({{ $genre->id }}, '{{ $genre->name }}', this.checked)">

                                    <label for="genre_{{ $genre->id }}">{{ $genre->name }}</label>
                                </div>
                            @empty
                                <div class="no-genres-message">
                                    No genres available. <a href="{{ route('admin.genres.create') }}">Create one
                                        first!</a>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    @error('genres')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="release_date">Release Date</label>
                    <input type="date" name="release_date" id="release_date" class="form-control"
                        value="{{ old('release_date') }}">
                    @error('release_date')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="stock">Stock *</label>
                        <input type="number" name="stock" id="stock" class="form-control"
                            placeholder="Available quantity" value="{{ old('stock', 0) }}" min="0" required>
                        @error('stock')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price">Price (Rp) *</label>
                        <input type="number" name="price" id="price" class="form-control"
                            placeholder="Price in Rupiah" value="{{ old('price') }}" min="0" step="0.01"
                            required>
                        @error('price')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="rating">Rating (0-10)</label>
                    <input type="number" name="rating" id="rating" class="form-control"
                        placeholder="e.g., 8.5" value="{{ old('rating') }}" min="0" max="10"
                        step="0.1">
                    @error('rating')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="cover">Cover Image</label>
                    <div class="file-input-wrapper">
                        <label for="cover" class="file-input-label" id="coverLabel">
                            <div style="text-align: center;">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p>Click to upload cover image</p>
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
                        <i class="fas fa-save"></i> Save Game
                    </button>
                    <a href="{{ route('admin.games.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Genre selection functionality
        const genreInputWrapper = document.getElementById('genreInputWrapper');
        const genreDropdown = document.getElementById('genreDropdown');
        const selectedGenresContainer = document.getElementById('selectedGenres');
        const genreSearchInput = document.getElementById('genreSearchInput');

        let selectedGenres = [];

        function toggleGenre(genreId, genreName, isChecked) {
            genreId = parseInt(genreId);
            if (isChecked) {
                if (!selectedGenres.includes(genreId)) {
                    selectedGenres.push(genreId);

                    // Add tag
                    const tag = document.createElement('span');
                    tag.className = 'selected-genre-tag';
                    tag.setAttribute('data-id', genreId);
                    tag.innerHTML = `${genreName} <i class="fas fa-times" onclick="removeGenre(${genreId})"></i>`;
                    selectedGenresContainer.appendChild(tag);
                }
            } else {
                selectedGenres = selectedGenres.filter(id => id !== genreId);

                // Remove tag
                const tagToRemove = Array.from(selectedGenresContainer.children).find(
                    tag => parseInt(tag.getAttribute('data-id')) === genreId
                );
                if (tagToRemove) {
                    tagToRemove.remove();
                }
            }
        }

        function removeGenre(genreId) {
            genreId = parseInt(genreId);
            // Uncheck the checkbox
            const checkbox = document.getElementById('genre_' + genreId);
            if (checkbox) {
                checkbox.checked = false;
            }

            // Remove from selectedGenres array
            selectedGenres = selectedGenres.filter(id => id !== genreId);

            // Remove tag
            const tagToRemove = Array.from(selectedGenresContainer.children).find(
                tag => parseInt(tag.getAttribute('data-id')) === genreId
            );
            if (tagToRemove) {
                tagToRemove.remove();
            }
        }

        // Toggle dropdown
        genreInputWrapper.addEventListener('click', function(e) {
            e.stopPropagation();
            this.classList.toggle('active');
            genreDropdown.classList.toggle('show');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!genreInputWrapper.contains(e.target) && !genreDropdown.contains(e.target)) {
                genreInputWrapper.classList.remove('active');
                genreDropdown.classList.remove('show');
            }
        });

        // Prevent dropdown from closing when clicking inside it
        genreDropdown.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        // Update genre count display
        function updateGenreDisplay() {
            const checkedCount = document.querySelectorAll('.genre-checkbox:checked').length;
            if (checkedCount === 0) {
                genreSearchInput.value = '';
            } else if (checkedCount === 1) {
                genreSearchInput.value = '1 genre selected';
            } else {
                genreSearchInput.value = checkedCount + ' genres selected';
            }
        }

        // Initialize on page load
        updateGenreDisplay();

        // File upload preview
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
            const checkedGenres = document.querySelectorAll('.genre-checkbox:checked');
            if (checkedGenres.length === 0) {
                e.preventDefault();
                alert('Please select at least one genre');
            }
        });
    </script>
</body>

</html>

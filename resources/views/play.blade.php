<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Play Game | Farr'sStore</title>
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
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px;
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
            color: #3b82f6;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 3fr;
            gap: 30px;
        }

        /* Game Info Card */
        .game-info-card {
            background: #1a202c;
            border-radius: 12px;
            border: 1px solid #2d3748;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            height: fit-content;
            position: sticky;
            top: 20px;
        }

        .game-cover {
            width: 100%;
            height: 260px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 16px;
            background: #2d3748;
        }

        .game-title {
            font-size: 24px;
            font-weight: 700;
            color: #f8fafc;
            margin-bottom: 8px;
        }

        .game-developer {
            color: #94a3b8;
            margin-bottom: 8px;
            font-size: 15px;
        }

        .game-platform {
            color: #60a5fa;
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 16px;
        }

        .ownership-badge {
            background: rgba(34, 197, 94, 0.2);
            border: 1px solid #22c55e;
            color: #86efac;
            padding: 12px;
            border-radius: 8px;
            text-align: center;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .ownership-badge i {
            color: #22c55e;
        }

        .btn-back {
            width: 100%;
            padding: 12px;
            background: #374151;
            color: #f8fafc;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            text-align: center;

            box-sizing: border-box;
            /* 🔥 FIX */
        }

        .btn-back:hover {
            background: #4b5563;
        }

        /* Game Player Card */
        .game-player-card {
            background: #1a202c;
            border-radius: 12px;
            border: 1px solid #2d3748;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #cbd5e1;
            margin-bottom: 12px;
        }

        .section-desc {
            color: #94a3b8;
            margin-bottom: 20px;
            font-size: 14px;
        }

        /* Browser Game */
        .game-iframe {
            width: 100%;
            height: 500px;
            border: 2px solid #2d3748;
            border-radius: 8px;
            background: #0f172a;
        }

        /* Download Game */
        .download-container {
            background: rgba(59, 130, 246, 0.1);
            border: 2px solid #3b82f6;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
        }

        .download-icon {
            font-size: 48px;
            color: #3b82f6;
            margin-bottom: 20px;
        }

        .download-title {
            font-size: 20px;
            font-weight: 700;
            color: #f8fafc;
            margin-bottom: 8px;
        }

        .download-filename {
            background: #2d3748;
            padding: 8px 16px;
            border-radius: 6px;
            font-family: monospace;
            color: #60a5fa;
            margin: 15px 0;
            display: inline-block;
        }

        .btn-download {
            background: linear-gradient(90deg, #22c55e, #16a34a);
            color: white;
            border: none;
            padding: 14px 40px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 10px rgba(34, 197, 94, 0.3);
            margin: 20px 0;
        }

        .btn-download:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(34, 197, 94, 0.4);
        }

        .download-note {
            color: #94a3b8;
            font-size: 13px;
            margin-top: 15px;
        }

        /* Download Progress */
        .download-progress {
            margin-top: 25px;
            background: #2d3748;
            padding: 20px;
            border-radius: 8px;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: #cbd5e1;
            margin-bottom: 8px;
        }

        .progress-bar-container {
            width: 100%;
            background: #374151;
            border-radius: 10px;
            height: 10px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #22c55e, #16a34a);
            width: 0%;
            transition: width 0.3s ease;
            border-radius: 10px;
        }

        .progress-percent {
            text-align: right;
            font-size: 14px;
            color: #22c55e;
            font-weight: 600;
            margin-top: 5px;
        }

        /* Success Message */
        .success-download {
            background: rgba(34, 197, 94, 0.2);
            border: 1px solid #22c55e;
            color: #86efac;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .success-download i {
            font-size: 20px;
            color: #22c55e;
        }

        @media (max-width: 768px) {
            .grid {
                grid-template-columns: 1fr;
            }

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

            .game-info-card {
                position: static;
            }

            .game-iframe {
                height: 300px;
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

    <div class="container">
        <h1>
            <i class="fas fa-play-circle"></i> Play Game
        </h1>

        <div class="grid">
            <!-- Game Info -->
            <div class="game-info-card">
                @if ($game->cover)
                    <img src="{{ asset('covers/' . $game->cover) }}" alt="{{ $game->title }}" class="game-cover">
                @else
                    <div
                        style="width: 100%; height: 260px; background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%); border-radius: 8px; margin-bottom: 16px; display: flex; align-items: center; justify-content: center; font-size: 48px; color: #3b82f6;">
                        <i class="fas fa-gamepad"></i>
                    </div>
                @endif

                <h2 class="game-title">{{ $game->title }}</h2>
                <p class="game-developer">Developer: {{ $game->developer }}</p>
                <p class="game-platform">{{ $game->platform }}</p>

                <div class="ownership-badge">
                    <i class="fas fa-check-circle"></i>
                    <span>You own this game</span>
                </div>

                <a href="{{ route('user.library') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Back to Library
                </a>
            </div>

            <!-- Game Player -->
            <div class="game-player-card">
                @if ($game->type === 'browser')
                    <!-- Browser Game - Iframe -->
                    <div>
                        <h3 class="section-title">Browser Game</h3>
                        <p class="section-desc">Play directly in your browser</p>
                    </div>

                    <iframe src="{{ $game->embed_url }}" class="game-iframe" allowfullscreen
                        sandbox="allow-same-origin allow-scripts allow-forms allow-popups">
                    </iframe>
                @elseif($game->type === 'download')
                    <!-- Download Game -->
                    <div>
                        <h3 class="section-title">Download Game</h3>
                        <p class="section-desc">Download and install on your computer</p>
                    </div>

                    <div class="download-container">
                        <div class="download-icon">
                            <i class="fas fa-download"></i>
                        </div>

                        <h4 class="download-title">{{ $game->title }}</h4>

                        <div class="download-filename">
                            <i class="fas fa-file"></i> {{ basename($game->file_path) }}
                        </div>

                        <button onclick="startDownload('{{ $game->title }}')" class="btn-download" id="downloadBtn">
                            <i class="fas fa-download"></i> Download Game
                        </button>

                        <p class="download-note">
                            <i class="fas fa-info-circle"></i>
                            Click the button above to download. After downloading, extract and run the installer.
                        </p>

                        <!-- Download Progress Bar (Hidden initially) -->
                        <div id="downloadProgress" class="download-progress" style="display: none;">
                            <div class="progress-label">
                                <span><i class="fas fa-spinner fa-spin"></i> Downloading...</span>
                                <span id="fileName">{{ $game->title }}</span>
                            </div>
                            <div class="progress-bar-container">
                                <div id="progressBar" class="progress-bar" style="width: 0%;"></div>
                            </div>
                            <div class="progress-percent" id="progressPercent">0%</div>
                        </div>

                        <!-- Success Message (Hidden initially) -->
                        <div id="successMessage" class="success-download" style="display: none;">
                            <i class="fas fa-check-circle"></i>
                            <span>Download completed successfully! File ready to install.</span>
                        </div>
                    </div>

                    <script>
                        function startDownload(gameTitle) {
                            // Hide any previous success message
                            document.getElementById('successMessage').style.display = 'none';

                            // Disable download button
                            const downloadBtn = document.getElementById('downloadBtn');
                            downloadBtn.disabled = true;
                            downloadBtn.style.opacity = '0.5';
                            downloadBtn.style.cursor = 'not-allowed';

                            // Show progress bar
                            document.getElementById('downloadProgress').style.display = 'block';
                            document.getElementById('fileName').textContent = gameTitle;

                            // Simulate download progress
                            let progress = 0;
                            const interval = setInterval(() => {
                                // Random increment between 5-15%
                                progress += Math.random() * 15;
                                if (progress > 100) progress = 100;

                                // Update progress bar
                                document.getElementById('progressBar').style.width = progress + '%';
                                document.getElementById('progressPercent').textContent = Math.floor(progress) + '%';

                                // When download completes
                                if (progress >= 100) {
                                    clearInterval(interval);

                                    // Hide progress bar
                                    setTimeout(() => {
                                        document.getElementById('downloadProgress').style.display = 'none';

                                        // Show success message
                                        document.getElementById('successMessage').style.display = 'flex';

                                        // Re-enable download button
                                        downloadBtn.disabled = false;
                                        downloadBtn.style.opacity = '1';
                                        downloadBtn.style.cursor = 'pointer';

                                        // Reset progress bar for next download
                                        document.getElementById('progressBar').style.width = '0%';
                                        document.getElementById('progressPercent').textContent = '0%';
                                    }, 500);
                                }
                            }, 200);
                        }
                    </script>
                @endif
            </div>
        </div>
    </div>
</body>

</html>

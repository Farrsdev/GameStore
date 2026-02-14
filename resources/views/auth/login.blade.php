<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Farr'sStore</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #0a0a0f; /* Fallback */
            background: 
                radial-gradient(ellipse at bottom, #0f1629 0%, #0a0a0f 50%),
                url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%23121826" fill-opacity="0.7"%3E%3Cpath d="M12 0L0 12L12 24L24 12L12 0Z M36 0L24 12L36 24L48 12L36 0Z M12 36L0 48L12 60L24 48L12 36Z M36 36L24 48L36 60L48 48L36 36Z" fill-rule="evenodd"/%3E%3C/g%3E%3C/svg%3E');
            background-attachment: fixed;
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-container {
            width: 100%;
            max-width: 500px;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 50px;
        }
        
        .logo h1 {
            font-size: 38px;
            font-weight: 800;
            background: linear-gradient(90deg, #60a5fa, #3b82f6, #2563eb);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            letter-spacing: 1.5px; /* Increased letter spacing for impact */
            margin-bottom: 8px;
            text-shadow: 0 0 15px rgba(59, 130, 246, 0.6); /* Subtle glow */
        }
        
        .logo p {
            color: #94a3b8;
            font-size: 15px;
            letter-spacing: 0.8px; /* Added letter spacing */
        }
        
        .login-card {
            background: #121826;
            border-radius: 16px;
            padding: 55px 50px; /* Increased padding further */
            border: 1px solid #2e3a52; /* Slightly darker, more prominent border */
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.6), /* More pronounced shadow */
                inset 0 1px 0 rgba(255, 255, 255, 0.08), /* Brighter inner highlight */
                0 0 30px rgba(59, 130, 246, 0.2); /* Subtle blue glow */
        }
        
        .login-header {
            margin-bottom: 35px;
        }
        
        .login-header h2 {
            font-size: 28px;
            color: #fff;
            margin-bottom: 10px;
            font-weight: 700;
        }
        
        .login-header p {
            color: #a0aec0;
            font-size: 15px;
            letter-spacing: 0.3px;
        }
        
        .form-group {
            margin-bottom: 24px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 10px;
            color: #e2e8f0;
            font-size: 15px;
            font-weight: 600;
        }
        
        .input-field {
            width: 100%;
            padding: 15px 18px;
            background: #0d1117;
            border: 1px solid #2d3748;
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        .input-field:focus {
            outline: none;
            border-color: #4a90e2; /* Brighter blue on focus */
            box-shadow: 
                0 0 0 4px rgba(74, 144, 226, 0.2), /* Larger, softer glow */
                0 0 20px rgba(74, 144, 226, 0.2); /* More intense focus glow */
            background: #0d1117; /* Keep background dark on focus */
        }
        
        .input-field::placeholder {
            color: #6b7280; /* Slightly lighter placeholder */
        }
        
        .login-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(90deg, #4a90e2, #2563eb); /* Updated gradient for consistency */
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 17px; /* Slightly larger font */
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease; /* Smoother transition */
            margin-top: 20px; /* Increased margin */
            letter-spacing: 0.8px;
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.4); /* More spread out shadow */
        }
        
        .login-btn:hover {
            background: linear-gradient(90deg, #2563eb, #1d4ed8);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.5); /* Stronger shadow on hover */
            transform: translateY(-3px); /* More pronounced lift */
        }
        
        .login-btn:active {
            transform: translateY(0);
            box-shadow: 0 3px 10px rgba(37, 99, 235, 0.4);
        }
        
        .register-link {
            text-align: center;
            margin-top: 35px;
            padding-top: 30px;
            border-top: 1px solid #2f3a4e; /* Slightly darker border */
            color: #94a3b8;
            font-size: 15px;
        }
        
        .register-link a {
            color: #4a90e2; /* Updated link color */
            text-decoration: none;
            font-weight: 700;
            margin-left: 5px;
            position: relative;
            padding-bottom: 2px;
        }
        
        .register-link a::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: 0;
            left: 0;
            background: #4a90e2; /* Match link color */
            transform: scaleX(0);
            transition: transform 0.3s ease; /* Smoother transition */
        }
        
        .register-link a:hover::after {
            transform: scaleX(1);
        }
        
        .error-message {
            background: rgba(220, 38, 38, 0.2); /* Slightly more opaque background */
            border: 1px solid rgba(252, 165, 165, 0.4); /* Lighter, more visible border */
            padding: 15px 20px; /* Increased padding */
            border-radius: 10px;
            margin-bottom: 28px; /* Increased margin */
            color: #fca5a5;
            font-size: 15px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px; /* Increased gap */
            box-shadow: 0 0 15px rgba(220, 38, 38, 0.2); /* Red glow for error */
        }
        
        .error-message::before {
            content: "🚨"; /* More impactful icon */
            font-size: 20px; /* Larger icon */
        }
        
        .back-home {
            text-align: center;
            margin-top: 40px;
        }
        
        .back-home a {
            color: #94a3b8;
            text-decoration: none;
            font-size: 15px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .back-home a:hover {
            color: #cbd5e1;
            background: rgba(148, 163, 184, 0.1);
        }
        
        /* Animation for the form */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .login-card {
            animation: fadeIn 0.6s ease-out;
        }
        
        /* Responsive adjustments */
        @media (max-width: 600px) {
            .login-container {
                max-width: 100%;
            }
            
            .login-card {
                padding: 40px 30px;
            }
            
            .logo h1 {
                font-size: 32px;
            }
        }
        
        @media (max-width: 480px) {
            .login-card {
                padding: 35px 25px;
            }
            
            .logo h1 {
                font-size: 28px;
            }
            
            body {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <h1>Farr'sStore</h1>
            <p>Game Store Platform</p>
        </div>
        
        <div class="login-card">
            @if ($errors->any())
                <div class="error-message">
                    Email atau password salah
                </div>
            @endif
            
            <div class="login-header">
                <h2>Login</h2>
                <p>Masuk ke akun Anda</p>
            </div>
            
            <form method="POST" action="{{ url('/login') }}">
                @csrf
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="input-field"
                        placeholder="you@example.com"
                        value="{{ old('email') }}"
                        required
                    >
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="input-field"
                        placeholder="••••••••"
                        required
                    >
                </div>
                
                <button type="submit" class="login-btn">Login</button>
                
                <div class="register-link">
                    Belum punya akun?
                    <a href="{{ url('/register') }}">Daftar disini</a>
                </div>
            </form>
        </div>
        
        <div class="back-home">
            <a href="/">
                ← Kembali ke halaman utama
            </a>
        </div>
    </div>
</body>
</html>
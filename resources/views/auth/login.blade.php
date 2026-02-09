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
            background: linear-gradient(135deg, #0a0a0f 0%, #0f1629 100%);
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-container {
            width: 100%;
            max-width: 500px; /* Increased from 400px */
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
            letter-spacing: 1.2px;
            margin-bottom: 8px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        .logo p {
            color: #94a3b8;
            font-size: 15px;
            letter-spacing: 0.5px;
        }
        
        .login-card {
            background: #121826;
            border-radius: 16px;
            padding: 50px 45px; /* Increased padding */
            border: 1px solid #222938;
            box-shadow: 
                0 15px 35px rgba(0, 0, 0, 0.5),
                inset 0 1px 0 rgba(255, 255, 255, 0.05);
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
            border-color: #3b82f6;
            box-shadow: 
                0 0 0 3px rgba(59, 130, 246, 0.15),
                0 0 15px rgba(59, 130, 246, 0.1);
            background: #0a0d14;
        }
        
        .input-field::placeholder {
            color: #4a5568;
        }
        
        .login-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(90deg, #3b82f6, #2563eb);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 15px;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }
        
        .login-btn:hover {
            background: linear-gradient(90deg, #2563eb, #1d4ed8);
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.4);
            transform: translateY(-2px);
        }
        
        .login-btn:active {
            transform: translateY(0);
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.4);
        }
        
        .register-link {
            text-align: center;
            margin-top: 35px;
            padding-top: 30px;
            border-top: 1px solid #252f3f;
            color: #94a3b8;
            font-size: 15px;
        }
        
        .register-link a {
            color: #60a5fa;
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
            background: #60a5fa;
            transform: scaleX(0);
            transition: transform 0.3s;
        }
        
        .register-link a:hover::after {
            transform: scaleX(1);
        }
        
        .error-message {
            background: rgba(220, 38, 38, 0.15);
            border: 1px solid rgba(220, 38, 38, 0.3);
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 25px;
            color: #fca5a5;
            font-size: 15px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .error-message::before {
            content: "⚠";
            font-size: 18px;
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
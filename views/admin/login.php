<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - SPK Handphone</title>
    <link rel="icon" type="image/svg+xml" href="<?= asset('images/favicon.svg') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: #050b14;
            background-image: 
                radial-gradient(circle at 15% 30%, rgba(0,212,255,0.22) 0%, transparent 45%),
                radial-gradient(circle at 85% 75%, rgba(30,64,175,0.3) 0%, transparent 55%),
                linear-gradient(135deg, rgba(0,212,255,0.1) 0%, rgba(5,11,20,0.95) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: #e5e7eb;
        }
        
        .login-wrapper {
            width: 100%;
            max-width: 440px;
        }

        .login-container {
            background: rgba(13, 27, 42, 0.9);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            padding: 45px 40px;
            border-radius: 20px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.95), 0 0 60px rgba(0,212,255,0.3);
            border: 1px solid rgba(0,212,255,0.45);
            position: relative;
            overflow: hidden;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #00d4ff, #1e40af, #38bdf8);
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .login-icon-badge {
            width: 75px;
            height: 75px;
            background: rgba(0,212,255,0.12);
            border: 2px solid rgba(0,212,255,0.6);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 30px;
            color: #00d4ff;
            box-shadow: 0 0 30px rgba(0,212,255,0.5);
        }
        
        .login-header h1 {
            font-size: 28px;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 2px;
            background: linear-gradient(135deg, #00d4ff 0%, #60a5fa 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            filter: drop-shadow(0 0 12px rgba(0,212,255,0.6));
        }
        
        .login-header p {
            color: #94a3b8;
            font-size: 13px;
            letter-spacing: 0.5px;
        }
        
        .form-group {
            margin-bottom: 22px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #cbd5e1;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-group-icon {
            position: relative;
        }

        .input-group-icon i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #00d4ff;
            font-size: 16px;
        }
        
        .form-group input {
            width: 100%;
            padding: 14px 16px 14px 46px;
            border: 1px solid rgba(0,212,255,0.3);
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: rgba(5, 11, 20, 0.85);
            color: #ffffff;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #00d4ff;
            box-shadow: 0 0 20px #00d4ff, 0 0 40px rgba(0,212,255,0.5);
            background: rgba(13, 27, 42, 0.95);
        }

        .form-group input::placeholder {
            color: #475569;
        }
        
        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #00d4ff 0%, #1e40af 100%);
            color: #ffffff;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 0 30px rgba(0,212,255,0.45);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-top: 10px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 40px #00d4ff, 0 0 70px rgba(0,212,255,0.75);
            background: linear-gradient(135deg, #38bdf8 0%, #2563eb 100%);
        }
        
        .alert {
            padding: 14px 16px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 14px;
            border: 1px solid;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .alert-error {
            background: rgba(239, 68, 68, 0.12);
            color: #ef4444;
            border-color: rgba(239, 68, 68, 0.4);
            box-shadow: 0 0 15px rgba(239,68,68,0.2);
        }
        
        .alert-success {
            background: rgba(16, 185, 129, 0.12);
            color: #10b981;
            border-color: rgba(16, 185, 129, 0.4);
            box-shadow: 0 0 15px rgba(16,185,129,0.2);
        }
        
        .back-link {
            text-align: center;
            margin-top: 25px;
        }
        
        .back-link a {
            color: #00d4ff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .back-link a:hover {
            color: #60a5fa;
            text-shadow: 0 0 12px #00d4ff;
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-container">
            <div class="login-header">
                <div class="login-icon-badge">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h1>Admin Login</h1>
                <p>Sistem Pendukung Keputusan Pemilihan Handphone</p>
            </div>
            
            <?php
            $flash = getFlash();
            if ($flash):
            ?>
            <div class="alert alert-<?= $flash['type'] ?>">
                <i class="fas fa-<?= $flash['type'] === 'success' ? 'check-circle' : 'exclamation-circle' ?>"></i>
                <span><?= $flash['message'] ?></span>
            </div>
            <?php endif; ?>
            
            <form method="POST" action="<?= url('admin/login') ?>">
                <?= csrfField() ?>
                
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-group-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" id="username" name="username" placeholder="Masukkan username admin" required autofocus>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                    </div>
                </div>
                
                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Masuk Dashboard
                </button>
            </form>
            
            <div class="back-link">
                <a href="<?= url() ?>">
                    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</body>
</html>

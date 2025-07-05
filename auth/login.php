<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Manajemen</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #4776E6;
            --primary-dark: #3a68d1;
            --secondary: #8E54E9;
            --accent: #FF6B6B;
            --light: #f8f9ff;
            --dark: #2d3748;
            --gray: #718096;
            --success: #48bb78;
            --border-radius: 16px;
            --box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', 'Roboto', 'Helvetica Neue', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            line-height: 1.6;
        }

        .container {
            display: flex;
            width: 100%;
            max-width: 1100px;
            height: auto;
            min-height: 600px;
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            position: relative;
        }

        .left-panel {
            flex: 1;
            background: linear-gradient(to bottom right, var(--primary), var(--secondary));
            color: white;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .left-panel::before {
            content: "";
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            z-index: -1;
        }

        .left-panel::after {
            content: "";
            position: absolute;
            bottom: -80px;
            left: -30px;
            width: 250px;
            height: 250px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            z-index: -1;
        }

        .logo {
            position: absolute;
            top: 30px;
            left: 30px;
            font-size: 24px;
            font-weight: 700;
            display: flex;
            align-items: center;
        }

        .logo i {
            margin-right: 10px;
            color: rgba(255, 255, 255, 0.9);
        }

        .welcome-text {
            font-size: 2.8rem;
            font-weight: 800;
            margin-bottom: 20px;
            line-height: 1.2;
            position: relative;
            z-index: 2;
        }

        .left-panel p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
            max-width: 90%;
        }

        .highlight {
            background: rgba(255, 255, 255, 0.2);
            padding: 2px 8px;
            border-radius: 6px;
            font-weight: 600;
        }

        .features {
            margin-top: 30px;
            position: relative;
            z-index: 2;
        }

        .feature {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .feature i {
            margin-right: 12px;
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
            background: rgba(255, 255, 255, 0.15);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .right-panel {
            flex: 1;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: var(--light);
            position: relative;
        }

        .right-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .right-header h2 {
            color: var(--dark);
            font-size: 2.2rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .right-header p {
            color: var(--gray);
            font-size: 1rem;
        }

        .form-container {
            max-width: 400px;
            margin: 0 auto;
            width: 100%;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--dark);
            font-weight: 500;
            font-size: 0.95rem;
        }

        .icon-input {
            position: relative;
        }

        .icon-input i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 1rem;
        }

        .form-group input {
            width: 100%;
            padding: 16px 16px 16px 50px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            transition: var(--transition);
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.03);
        }

        .form-group input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(71, 118, 230, 0.2);
            outline: none;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0;
            font-size: 0.9rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 8px;
            accent-color: var(--primary);
        }

        .forgot-password {
            color: var(--primary);
            text-decoration: none;
            transition: var(--transition);
            font-weight: 500;
        }

        .forgot-password:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            padding: 16px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 10px;
            box-shadow: 0 4px 10px rgba(71, 118, 230, 0.3);
            letter-spacing: 0.5px;
        }

        .btn-login:hover {
            background: linear-gradient(to right, var(--primary-dark), #7d4cd9);
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(71, 118, 230, 0.4);
        }

        .btn-login:active {
            transform: translateY(-1px);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 30px 0;
            color: var(--gray);
            font-size: 0.9rem;
        }

        .divider .line {
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        .divider .text {
            padding: 0 15px;
        }

        .btn-register {
            width: 100%;
            padding: 16px;
            background: white;
            color: var(--primary);
            border: 2px solid var(--primary);
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 10px rgba(71, 118, 230, 0.1);
            letter-spacing: 0.5px;
        }

        .btn-register:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(71, 118, 230, 0.2);
        }

        .additional-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
            font-size: 0.9rem;
        }

        .additional-links a {
            color: var(--gray);
            text-decoration: none;
            transition: var(--transition);
            display: flex;
            align-items: center;
        }

        .additional-links a i {
            margin-right: 6px;
        }

        .additional-links a:hover {
            color: var(--primary);
        }

        .footer {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            text-align: center;
            color: var(--gray);
            font-size: 0.85rem;
        }

        /* Responsiveness */
        @media (max-width: 992px) {
            .container {
                flex-direction: column;
                max-width: 600px;
            }
            
            .left-panel {
                padding: 40px 30px;
            }
            
            .right-panel {
                padding: 50px 40px;
            }
            
            .welcome-text {
                font-size: 2.2rem;
            }
        }

        @media (max-width: 576px) {
            .container {
                border-radius: 12px;
            }
            
            .left-panel, .right-panel {
                padding: 30px 20px;
            }
            
            .welcome-text {
                font-size: 2rem;
            }
            
            .form-options {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .additional-links {
                flex-wrap: wrap;
                gap: 15px;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animated {
            animation: fadeIn 0.6s ease-out forwards;
        }

        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }
        .delay-5 { animation-delay: 0.5s; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Panel Kiri (Gambar dan Deskripsi) -->
        <div class="left-panel">
            <div class="logo animated">
                <i class="fas fa-cube"></i>
                <span>SystemManager</span>
            </div>
            
            <h2 class="welcome-text animated delay-1">Selamat Datang Kembali</h2>
            <p class="animated delay-2">Masuk ke akun Anda untuk mengakses dashboard dan fitur-fitur eksklusif sistem kami. Kelola data dengan mudah dan aman.</p>
            <p class="animated delay-2">Belum memiliki akun? <span class="highlight">Daftar sekarang</span> untuk memulai perjalanan Anda bersama kami.</p>
            
            <div class="features animated delay-3">
                <div class="feature">
                    <i class="fas fa-shield-alt"></i>
                    <span>Keamanan data terjamin dengan enkripsi tingkat tinggi</span>
                </div>
                <div class="feature">
                    <i class="fas fa-bolt"></i>
                    <span>Proses cepat dan antarmuka responsif</span>
                </div>
                <div class="feature">
                    <i class="fas fa-sync"></i>
                    <span>Update real-time untuk semua perubahan</span>
                </div>
            </div>
        </div>
        
        <!-- Panel Kanan (Form Login) -->
        <div class="right-panel">
            <div class="right-header animated delay-1">
                <h2>Masuk ke Akun</h2>
                <p>Silakan masukkan detail akun Anda untuk melanjutkan</p>
            </div>
            
            <div class="form-container">
                <form action="../auth/cek_login.php" method="POST">
                    <div class="form-group animated delay-2">
                        <label for="username">Username atau Email</label>
                        <div class="icon-input">
                            <i class="fas fa-user"></i>
                            <input type="text" id="username" name="username" placeholder="Masukkan username atau email" required>
                        </div>
                    </div>
                    
                    <div class="form-group animated delay-3">
                        <label for="password">Password</label>
                        <div class="icon-input">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                        </div>
                    </div>
                    
                    <div class="form-options animated delay-4">
                        <div class="remember-me">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Ingat saya</label>
                        </div>
                        <a href="#" class="forgot-password">Lupa password?</a>
                    </div>
                    
                    <button type="submit" class="btn-login animated delay-4">Masuk</button>
                </form>
                
                <div class="divider animated delay-5">
                    <div class="line"></div>
                    <div class="text">ATAU</div>
                    <div class="line"></div>
                </div>
                
                <button class="btn-register animated delay-5" onclick="window.location.href='register.php'">
                    Buat Akun Baru
                </button>
                
                <div class="additional-links animated delay-5">
                    <a href="#"><i class="fas fa-info-circle"></i> Bantuan</a>
                    <a href="#"><i class="fas fa-shield-alt"></i> Privasi</a>
                    <a href="#"><i class="fas fa-file-alt"></i> Ketentuan</a>
                </div>
            </div>
            
            <div class="footer animated delay-5">
                &copy; 2023 Sistem Manajemen. Hak cipta dilindungi.
            </div>
        </div>
    </div>

    <script>
        // Animasi untuk elemen
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.container');
            container.style.opacity = '0';
            container.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                container.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                container.style.opacity = '1';
                container.style.transform = 'translateY(0)';
            }, 100);
            
            // Efek hover untuk input
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.parentElement.style.transform = 'scale(1.02)';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.parentElement.style.transform = 'scale(1)';
                });
            });
        });
    </script>
</body>
</html>
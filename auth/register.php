<?php
session_start();
require_once("../koneksi.php"); // Pastikan path koneksi.php benar

// Jika user sudah login, mungkin sebaiknya diarahkan pulang atau ke beranda admin
if (isset($_SESSION['username'])) {
    header('Location: ../admin/beranda_admin.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Akun Baru - Sistem Manajemen</title>
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

        .password-strength {
            height: 5px;
            background: #e2e8f0;
            border-radius: 5px;
            margin-top: 8px;
            overflow: hidden;
            position: relative;
        }
        
        .password-strength-fill {
            height: 100%;
            width: 0;
            background: var(--success);
            transition: width 0.3s ease;
        }
        
        .password-requirements {
            margin-top: 10px;
            font-size: 0.8rem;
            color: var(--gray);
        }
        
        .requirement {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }
        
        .requirement i {
            margin-right: 5px;
            font-size: 0.7rem;
        }
        
        .requirement.valid {
            color: var(--success);
        }
        
        .requirement.valid i {
            color: var(--success);
        }

        .btn-register {
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

        .btn-register:hover {
            background: linear-gradient(to right, var(--primary-dark), #7d4cd9);
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(71, 118, 230, 0.4);
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

        .btn-login {
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

        .btn-login:hover {
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
            
            <h2 class="welcome-text animated delay-1">Bergabunglah Dengan Kami</h2>
            <p class="animated delay-2">Daftarkan akun baru untuk mengakses seluruh fitur sistem kami. Mulai perjalanan Anda sekarang dengan layanan terbaik.</p>
            <p class="animated delay-2">Sudah memiliki akun? <span class="highlight">Masuk sekarang</span> untuk melanjutkan pengalaman Anda.</p>
            
            <div class="features animated delay-3">
                <div class="feature">
                    <i class="fas fa-user-shield"></i>
                    <span>Akun pribadi dengan perlindungan keamanan terbaik</span>
                </div>
                <div class="feature">
                    <i class="fas fa-rocket"></i>
                    <span>Akses penuh ke semua fitur premium</span>
                </div>
                <div class="feature">
                    <i class="fas fa-headset"></i>
                    <span>Dukungan pelanggan 24/7</span>
                </div>
            </div>
        </div>
        
        <!-- Panel Kanan (Form Registrasi) -->
        <div class="right-panel">
            <div class="right-header animated delay-1">
                <h2>Buat Akun Baru</h2>
                <p>Silakan isi formulir di bawah ini untuk mendaftar</p>
            </div>
            
            <div class="form-container">
                <form action="proses_register.php" method="post">
                    <div class="form-group animated delay-2">
                        <label for="username">Username</label>
                        <div class="icon-input">
                            <i class="fas fa-user-circle"></i>
                            <input type="text" id="username" name="username" placeholder="Buat username unik" required autocomplete="new-username">
                        </div>
                    </div>
                    
                    <div class="form-group animated delay-3">
                        <label for="password">Password</label>
                        <div class="icon-input">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" name="password" placeholder="Buat password yang kuat" required autocomplete="new-password">
                        </div>
                        <div class="password-strength">
                            <div class="password-strength-fill" id="password-strength-fill"></div>
                        </div>
                        <div class="password-requirements">
                            <div class="requirement" id="req-length"><i class="fas fa-circle"></i> Minimal 8 karakter</div>
                            <div class="requirement" id="req-upper"><i class="fas fa-circle"></i> Mengandung huruf besar</div>
                            <div class="requirement" id="req-number"><i class="fas fa-circle"></i> Mengandung angka</div>
                        </div>
                    </div>
                    
                    <div class="form-group animated delay-4">
                        <label for="confirm_password">Konfirmasi Password</label>
                        <div class="icon-input">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="confirm_password" name="confirm_password" placeholder="Ulangi password" required autocomplete="new-password">
                        </div>
                        <div id="password-match" class="text-sm mt-2" style="display:none; color: var(--success);">
                            <i class="fas fa-check-circle"></i> Password cocok
                        </div>
                        <div id="password-mismatch" class="text-sm mt-2" style="display:none; color: var(--accent);">
                            <i class="fas fa-exclamation-circle"></i> Password tidak cocok
                        </div>
                    </div>
                    
                    <button type="submit" name="register" class="btn-register animated delay-5">Daftar Sekarang</button>
                </form>
                
                <div class="divider animated delay-5">
                    <div class="line"></div>
                    <div class="text">ATAU</div>
                    <div class="line"></div>
                </div>
                
                <button class="btn-login animated delay-5" onclick="window.location.href='login.php'">
                    Kembali ke Login
                </button>
                
                <div class="additional-links animated delay-5">
                    <a href="#"><i class="fas fa-info-circle"></i> Bantuan</a>
                    <a href="#"><i class="fas fa-shield-alt"></i> Privasi</a>
                    <a href="#"><i class="fas fa-file-alt"></i> Ketentuan</a>
                </div>
            </div>
            
            <div class="footer animated delay-5">
                &copy; <?php echo date('Y'); ?> Sistem Manajemen. Hak cipta dilindungi.
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
            
            // Validator password
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirm_password');
            const strengthFill = document.getElementById('password-strength-fill');
            const requirements = {
                length: document.getElementById('req-length'),
                upper: document.getElementById('req-upper'),
                number: document.getElementById('req-number')
            };
            
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                let strength = 0;
                
                // Validasi panjang
                if (password.length >= 8) {
                    requirements.length.classList.add('valid');
                    strength += 33;
                } else {
                    requirements.length.classList.remove('valid');
                }
                
                // Validasi huruf besar
                if (/[A-Z]/.test(password)) {
                    requirements.upper.classList.add('valid');
                    strength += 33;
                } else {
                    requirements.upper.classList.remove('valid');
                }
                
                // Validasi angka
                if (/\d/.test(password)) {
                    requirements.number.classList.add('valid');
                    strength += 34;
                } else {
                    requirements.number.classList.remove('valid');
                }
                
                strengthFill.style.width = strength + '%';
                
                // Warna indikator kekuatan password
                if (strength < 33) {
                    strengthFill.style.background = '#e53e3e';
                } else if (strength < 66) {
                    strengthFill.style.background = '#ed8936';
                } else {
                    strengthFill.style.background = 'var(--success)';
                }
                
                // Validasi konfirmasi password
                validatePasswordMatch();
            });
            
            confirmPasswordInput.addEventListener('input', validatePasswordMatch);
            
            function validatePasswordMatch() {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;
                const matchElement = document.getElementById('password-match');
                const mismatchElement = document.getElementById('password-mismatch');
                
                if (confirmPassword === '') {
                    matchElement.style.display = 'none';
                    mismatchElement.style.display = 'none';
                    return;
                }
                
                if (password === confirmPassword) {
                    matchElement.style.display = 'block';
                    mismatchElement.style.display = 'none';
                } else {
                    matchElement.style.display = 'none';
                    mismatchElement.style.display = 'block';
                }
            }
            
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
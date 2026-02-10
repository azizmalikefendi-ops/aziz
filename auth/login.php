<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KASIR AZIZ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Poppins', sans-serif;
        }

        html, body {
            width: 100%;
            height: 100%;
            overflow-x: hidden;
        }

        body {
            background: linear-gradient(135deg, #1e3a8a 0%, #475569 50%, #1f2937 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
            z-index: 1;
            pointer-events: none;
        }

        /* Animated Background Circles */
        .circle {
            position: fixed;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            animation: float 25s infinite ease-in-out;
            z-index: 0;
        }

        .circle-1 {
            width: 400px;
            height: 400px;
            top: -150px;
            left: -100px;
            animation-delay: 0s;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }

        .circle-2 {
            width: 250px;
            height: 250px;
            bottom: -80px;
            right: -50px;
            animation-delay: 2.5s;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }

        .circle-3 {
            width: 180px;
            height: 180px;
            top: 40%;
            right: 5%;
            animation-delay: 5s;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) translateX(0); }
            50% { transform: translateY(-40px) translateX(20px); }
        }

        /* Login Container */
        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 20px;
            z-index: 10;
            position: relative;
            animation: slideInUp 0.9s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(60px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Modern Glass Login Card */
        .login-card-3d {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.75);
            border-radius: 20px;
            padding: 45px 35px;
            box-shadow: 
                0 8px 32px 0 rgba(31, 38, 135, 0.37),
                inset 0 1px 2px rgba(255, 255, 255, 0.8);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .login-card-3d:hover {
            box-shadow: 
                0 16px 48px 0 rgba(31, 38, 135, 0.45),
                inset 0 1px 2px rgba(255, 255, 255, 0.8);
            border-color: rgba(255, 255, 255, 0.9);
            transform: translateY(-4px);
        }

        /* Logo */
        .logo-3d {
            width: 75px;
            height: 75px;
            margin: 0 auto 25px;
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            color: white;
            box-shadow: 
                0 8px 24px rgba(30, 58, 138, 0.25),
                inset 0 2px 4px rgba(255, 255, 255, 0.3);
            animation: floatIcon 3.5s ease-in-out infinite;
            position: relative;
        }

        @keyframes floatIcon {
            0%, 100% { 
                transform: translateY(0);
                box-shadow: 0 8px 24px rgba(30, 58, 138, 0.25), inset 0 2px 4px rgba(255, 255, 255, 0.3);
            }
            50% { 
                transform: translateY(-12px);
                box-shadow: 0 14px 35px rgba(30, 58, 138, 0.35), inset 0 2px 4px rgba(255, 255, 255, 0.3);
            }
        }

        .logo-3d:hover {
            animation: pulse-scale 0.5s ease;
        }

        @keyframes pulse-scale {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.12); }
        }

        /* Title */
        .title-3d {
            text-align: center;
            margin-bottom: 30px;
        }

        .title-3d h2 {
            font-size: 1.85rem;
            font-weight: 800;
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .title-3d p {
            color: #64748b;
            font-size: 0.95rem;
            font-weight: 500;
        }

        /* Alert */
        .alert-3d {
            background: linear-gradient(135deg, rgba(248, 113, 113, 0.12), rgba(251, 146, 60, 0.12));
            border: 1px solid rgba(239, 68, 68, 0.35);
            border-radius: 12px;
            color: #dc2626;
            padding: 13px 15px;
            margin-bottom: 22px;
            font-weight: 600;
            font-size: 0.9rem;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            animation: slideDown 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Form Group */
        .form-group-3d {
            margin-bottom: 20px;
        }

        .form-label-3d {
            font-weight: 700;
            font-size: 0.8rem;
            color: #334155;
            margin-bottom: 7px;
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.7px;
        }

        /* Input Container */
        .input-container-3d {
            position: relative;
        }

        .input-3d {
            width: 100%;
            background: rgba(255, 255, 255, 0.98);
            border: 2px solid #e2e8f0;
            border-radius: 11px;
            padding: 13px 16px 13px 44px;
            font-weight: 600;
            font-size: 0.95rem;
            color: #1e293b;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .input-3d::placeholder {
            color: #cbd5e1;
            font-weight: 500;
        }

        .input-3d:focus {
            outline: none;
            border-color: #1e3a8a;
            background: white;
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1), inset 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .input-icon-3d {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1rem;
            color: #1e3a8a;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .input-3d:focus ~ .input-icon-3d {
            color: #1e40af;
            transform: translateY(-50%) scale(1.1);
        }

        .toggle-password-3d {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #94a3b8;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .toggle-password-3d:hover {
            color: #1e3a8a;
            transform: translateY(-50%) scale(1.15);
        }

        /* Button */
        .btn-3d {
            width: 100%;
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            border: none;
            border-radius: 11px;
            padding: 13px 20px;
            font-weight: 800;
            font-size: 0.9rem;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1.1px;
            margin-top: 12px;
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(30, 58, 138, 0.25);
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-3d::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.25);
            transform: translate(-50%, -50%);
            transition: width 0.5s ease, height 0.5s ease;
        }

        .btn-3d:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-3d:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(30, 58, 138, 0.35);
        }

        .btn-3d:active {
            transform: translateY(0);
            box-shadow: 0 4px 12px rgba(30, 58, 138, 0.2);
        }

        .btn-3d span {
            position: relative;
            z-index: 1;
        }

        /* Footer */
        .footer-3d {
            text-align: center;
            margin-top: 22px;
            color: rgba(30, 58, 138, 0.6);
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .login-container {
                padding: 15px;
            }

            .login-card-3d {
                padding: 35px 25px;
            }

            .title-3d h2 {
                font-size: 1.5rem;
            }

            .logo-3d {
                width: 65px;
                height: 65px;
                font-size: 1.8rem;
            }

            .btn-3d {
                padding: 11px 16px;
                font-size: 0.8rem;
                letter-spacing: 0.8px;
            }

            .input-3d {
                font-size: 0.9rem;
                padding: 11px 14px 11px 40px;
            }
        }
    </style>
</head>
<body>

    <!-- Animated Circles -->
    <div class="circle circle-1"></div>
    <div class="circle circle-2"></div>
    <div class="circle circle-3"></div>

    <!-- Login Container -->
    <div class="login-container">
        <div class="login-card-3d">
            <!-- Logo -->
            <div class="logo-3d">
                <i class="fas fa-cash-register"></i>
            </div>

            <!-- Title -->
            <div class="title-3d">
                <h2>KASIR AZIZ</h2>
                <p>Masuk untuk mengelola toko Anda</p>
            </div>

            <!-- Alert -->
            <?php if(isset($_GET['pesan']) && $_GET['pesan'] == "gagal"): ?>
                <div class="alert-3d">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    Username atau Password salah!
                </div>
            <?php endif; ?>

            <!-- Form -->
            <form action="auth.php" method="POST">
                <!-- Username -->
                <div class="form-group-3d">
                    <label class="form-label-3d">Username</label>
                    <div class="input-container-3d">
                        <i class="input-icon-3d fas fa-user"></i>
                        <input type="text" 
                               name="username" 
                               class="input-3d" 
                               placeholder="Masukkan username" 
                               required 
                               autocomplete="off">
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group-3d">
                    <label class="form-label-3d">Password</label>
                    <div class="input-container-3d">
                        <i class="input-icon-3d fas fa-lock"></i>
                        <input type="password" 
                               name="password" 
                               id="passwordInput" 
                               class="input-3d" 
                               placeholder="Masukkan password" 
                               required>
                        <i class="toggle-password-3d fas fa-eye" 
                           id="eyeIcon" 
                           onclick="togglePassword()"></i>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-3d">
                    <span>
                        Masuk
                        <i class="fas fa-arrow-right ms-2"></i>
                    </span>
                </button>
            </form>

            <!-- Footer -->
            <div class="footer-3d">
                © 2026 KASIR AZIZ
            </div>
        </div>
    </div>

    <script>
        // Toggle Password Visibility
        function togglePassword() {
            const input = document.getElementById("passwordInput");
            const icon = document.getElementById("eyeIcon");
            
            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.replace("fa-eye-slash", "fa-eye");
            }
        }

        // Add ripple effect on button click
        document.querySelector('.btn-3d').addEventListener('click', function(e) {
            let ripple = document.createElement('span');
            ripple.style.position = 'absolute';
            ripple.style.borderRadius = '50%';
            ripple.style.background = 'rgba(255, 255, 255, 0.5)';
            ripple.style.width = '100px';
            ripple.style.height = '100px';
            ripple.style.left = e.offsetX - 50 + 'px';
            ripple.style.top = e.offsetY - 50 + 'px';
            ripple.style.animation = 'ripple-effect 0.6s ease-out';
            ripple.style.pointerEvents = 'none';
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });

        // Add CSS for ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple-effect {
                from {
                    transform: scale(0);
                    opacity: 1;
                }
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>

</body>
</html>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - {{ $settings->site_name ?? 'إطلالة المشرق' }}</title>

    <!-- Cairo Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --primary-light: #dbeafe;
            --bg-light: #f1f5f9;
            --bg-card: rgba(255, 255, 255, 0.85);
            --text-main: #0f172a;
            --text-muted: #64748b;
            --text-light: #94a3b8;
            --border-color: #e2e8f0;
            --input-bg: #ffffff;
            --shadow-color: rgba(15, 23, 42, 0.08);
            --shadow-hover: rgba(37, 99, 235, 0.15);
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Cairo', sans-serif;
            direction: rtl;
            background-color: var(--bg-light);
            background-image:
                radial-gradient(at 0% 0%, rgba(37, 99, 235, 0.06) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(99, 102, 241, 0.06) 0px, transparent 50%);
            overflow: hidden;
            position: relative;
            color: var(--text-main);
        }

        /* Animated Background Blobs - Light version */
        .glow-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.4;
            z-index: 0;
            animation: float 12s infinite ease-in-out alternate;
        }

        .glow-1 {
            width: 500px;
            height: 500px;
            background: rgba(37, 99, 235, 0.10);
            top: -150px;
            right: -150px;
        }

        .glow-2 {
            width: 400px;
            height: 400px;
            background: rgba(99, 102, 241, 0.10);
            bottom: -100px;
            left: -100px;
            animation-delay: -6s;
        }

        @keyframes float {
            0% {
                transform: translateY(0) scale(1);
            }
            100% {
                transform: translateY(40px) scale(1.08);
            }
        }

        .login-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 460px;
            padding: 20px;
        }

        /* Glassmorphism Card - Light version */
        .login-card {
            background: var(--bg-card);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 28px;
            padding: 40px 36px;
            box-shadow:
                0 20px 60px -12px var(--shadow-color),
                0 4px 20px -8px rgba(0, 0, 0, 0.04),
                inset 0 1px 0 rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.6);
            transition: box-shadow 0.4s ease;
        }

        .login-card:hover {
            box-shadow:
                0 30px 80px -16px var(--shadow-hover),
                0 4px 24px -8px rgba(0, 0, 0, 0.06);
        }

        .login-logo {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-logo .logo-wrapper {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
            border-radius: 20px;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            box-shadow: 0 8px 24px rgba(37, 99, 235, 0.12);
            margin-bottom: 18px;
            transition: transform 0.3s ease;
        }

        .login-logo .logo-wrapper:hover {
            transform: scale(1.04);
        }

        .login-logo img {
            width: 72px;
            height: 72px;
            object-fit: cover;
            border-radius: 16px;
        }

        .login-logo .logo-icon {
            font-size: 38px;
            color: var(--primary);
        }

        .login-logo h4 {
            font-size: 26px;
            font-weight: 800;
            color: var(--text-main);
            margin: 0;
            letter-spacing: -0.3px;
        }

        .login-logo p {
            font-size: 14px;
            color: var(--text-muted);
            margin-top: 4px;
            font-weight: 500;
        }

        /* Form Inputs */
        .form-label-modern {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 6px;
            display: block;
        }

        .input-icon-wrapper {
            position: relative;
            margin-bottom: 22px;
        }

        .input-icon {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 20px;
            transition: color 0.3s ease;
            pointer-events: none;
        }

        .form-control-modern {
            height: 54px;
            background: var(--input-bg) !important;
            border: 1.5px solid var(--border-color) !important;
            border-radius: 14px !important;
            color: var(--text-main) !important;
            padding-right: 50px !important;
            padding-left: 16px !important;
            font-size: 15px !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02) !important;
        }

        .form-control-modern::placeholder {
            color: #b0b8c4;
            font-weight: 400;
        }

        .form-control-modern:focus {
            border-color: var(--primary) !important;
            background: #ffffff !important;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.10), 0 2px 8px rgba(37, 99, 235, 0.04) !important;
            outline: none;
        }

        .form-control-modern:focus+.input-icon,
        .form-control-modern:not(:placeholder-shown)+.input-icon {
            color: var(--primary);
        }

        /* Checkbox */
        .form-check {
            margin-bottom: 28px;
            padding-right: 1.5em;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            background-color: #ffffff;
            border: 1.5px solid #cbd5e1;
            border-radius: 6px;
            margin-right: -1.5em;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 2px;
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
            border-color: var(--primary);
        }

        .form-check-label {
            color: var(--text-muted);
            font-size: 14px;
            font-weight: 500;
            padding-right: 10px;
            cursor: pointer;
            user-select: none;
        }

        /* Submit Button */
        .btn-modern-primary {
            position: relative;
            overflow: hidden;
            height: 54px;
            border-radius: 14px;
            border: none;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            font-size: 17px;
            font-weight: 700;
            color: #fff;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 8px 24px -6px rgba(37, 99, 235, 0.35);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-modern-primary::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.15) 0%, transparent 60%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .btn-modern-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 32px -8px rgba(37, 99, 235, 0.45);
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }

        .btn-modern-primary:hover::after {
            opacity: 1;
        }

        .btn-modern-primary:active {
            transform: translateY(0px);
            box-shadow: 0 4px 16px -4px rgba(37, 99, 235, 0.3);
        }

        .btn-modern-primary i {
            transition: transform 0.3s ease;
        }

        .btn-modern-primary:hover i {
            transform: translateX(-5px);
        }

        /* Alert */
        .alert-modern {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
        }

        .alert-modern i {
            font-size: 18px;
            color: #dc2626;
        }

        /* Footer */
        .login-footer {
            text-align: center;
            margin-top: 24px;
            color: var(--text-light);
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding-top: 18px;
            border-top: 1px solid var(--border-color);
        }

        .login-footer i {
            color: #22c55e;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-card {
                padding: 28px 20px;
                border-radius: 20px;
            }

            .login-logo h4 {
                font-size: 22px;
            }

            .login-logo .logo-wrapper {
                width: 68px;
                height: 68px;
            }

            .login-logo .logo-icon {
                font-size: 32px;
            }

            .form-control-modern {
                height: 48px;
                font-size: 14px !important;
            }

            .btn-modern-primary {
                height: 48px;
                font-size: 16px;
            }
        }

        /* Small extra touch: focus ring for accessibility */
        .form-control-modern:focus-visible {
            outline: 2px solid var(--primary);
            outline-offset: 2px;
        }

        .btn-modern-primary:focus-visible {
            outline: 2px solid var(--primary);
            outline-offset: 3px;
        }
    </style>
</head>

<body>

    <!-- Background Glow Blobs -->
    <div class="glow-blob glow-1"></div>
    <div class="glow-blob glow-2"></div>

    <div class="login-container">
        <div class="login-card">

            <!-- Logo & Brand Header -->
            <div class="login-logo">
                <div class="logo-wrapper">
                    @if(isset($settings) && $settings->logo)
                    <img src="{{ asset('uploads/settings/' . $settings->logo) }}" alt="Logo">
                    @else
                    <i class="bi bi-box-seam logo-icon"></i>
                    @endif
                </div>
                <h4>إطلالة المشرق</h4>
                <p>الإطلالة المشرق للخدمات اللوجستيه</p>
            </div>

            <!-- Validation Error Alert -->
            @if ($errors->any())
            <div class="alert-modern">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span>{{ $errors->first() }}</span>
            </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="input-icon-wrapper">
                    <label class="form-label-modern">البريد الإلكتروني</label>
                    <input type="email" name="email" class="form-control form-control-modern"
                    placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                    <i class="bi bi-envelope input-icon"></i>
                </div>

                <!-- Password -->
                <div class="input-icon-wrapper">
                    <label class="form-label-modern">كلمة المرور</label>
                    <input type="password" name="password" class="form-control form-control-modern"
                    placeholder="••••••••" required>
                    <i class="bi bi-lock input-icon"></i>
                </div>



                <!-- Submit Button -->
                <button type="submit" class="btn-modern-primary">
                    <span>دخول النظام</span>
                    <i class="bi bi-box-arrow-in-left"></i>
                </button>
            </form>

        </div>
    </div>

</body>
</html>
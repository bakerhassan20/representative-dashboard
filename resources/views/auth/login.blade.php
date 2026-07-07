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
            --primary: #3b82f6;
            --primary-hover: #2563eb;
            --bg-dark: #0f172a;
            --bg-card: rgba(30, 41, 59, 0.7);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border-color: rgba(255, 255, 255, 0.1);
            --input-bg: rgba(15, 23, 42, 0.6);
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Cairo', sans-serif;
            direction: rtl;
            background-color: var(--bg-dark);
            background-image: 
                radial-gradient(at 0% 0%, rgba(59, 130, 246, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(139, 92, 246, 0.15) 0px, transparent 50%);
            overflow: hidden;
            position: relative;
            color: var(--text-main);
        }

        /* Animated Background Blobs */
        .glow-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.5;
            z-index: 0;
            animation: float 10s infinite ease-in-out alternate;
        }

        .glow-1 {
            width: 400px;
            height: 400px;
            background: rgba(59, 130, 246, 0.3);
            top: -100px;
            right: -100px;
        }

        .glow-2 {
            width: 300px;
            height: 300px;
            background: rgba(139, 92, 246, 0.3);
            bottom: -50px;
            left: -50px;
            animation-delay: -5s;
        }

        @keyframes float {
            0% { transform: translateY(0) scale(1); }
            100% { transform: translateY(30px) scale(1.1); }
        }

        .login-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 460px;
            padding: 20px;
        }

        /* Glassmorphism Card */
        .login-card {
            background: var(--bg-card);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 
                0 25px 50px -12px rgba(0, 0, 0, 0.5),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            border: 1px solid var(--border-color);
        }

        .login-logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-logo img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 24px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            border: 2px solid rgba(255, 255, 255, 0.05);
            margin-bottom: 16px;
        }

        .login-logo h4 {
            font-size: 24px;
            font-weight: 800;
            color: #fff;
            margin: 0;
            letter-spacing: 0.5px;
        }

        .login-logo p {
            font-size: 14px;
            color: var(--text-muted);
            margin-top: 5px;
            font-weight: 500;
        }

        /* Form Inputs */
        .form-label-modern {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 8px;
            display: block;
        }

        .input-icon-wrapper {
            position: relative;
            margin-bottom: 24px;
        }

        .input-icon {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 20px;
            transition: color 0.3s ease;
        }

        .form-control-modern {
            height: 56px;
            background: var(--input-bg) !important;
            border: 1px solid var(--border-color) !important;
            border-radius: 16px !important;
            color: #fff !important;
            padding-right: 50px !important;
            font-size: 15px !important;
            transition: all 0.3s ease !important;
            box-shadow: none !important;
        }

        .form-control-modern::placeholder {
            color: #475569;
            font-weight: 500;
        }

        .form-control-modern:focus {
            border-color: var(--primary) !important;
            background: rgba(15, 23, 42, 0.8) !important;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15) !important;
        }

        .form-control-modern:focus + .input-icon,
        .form-control-modern:not(:placeholder-shown) + .input-icon {
            color: var(--primary);
        }

        /* Checkbox */
        .form-check {
            margin-bottom: 30px;
            padding-right: 1.5em;
        }

        .form-check-input {
            width: 20px;
            height: 20px;
            background-color: var(--input-bg);
            border: 1px solid var(--border-color);
            border-radius: 6px;
            margin-right: -1.5em;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
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
            height: 56px;
            border-radius: 16px;
            border: none;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            font-size: 18px;
            font-weight: 700;
            color: #fff;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 10px 20px -10px rgba(59, 130, 246, 0.5);
            transition: all 0.3s ease;
        }

        .btn-modern-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 25px -10px rgba(59, 130, 246, 0.6);
            background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
        }

        .btn-modern-primary i {
            transition: transform 0.3s ease;
        }

        .btn-modern-primary:hover i {
            transform: translateX(-5px);
        }

        /* Alert */
        .alert-modern {
            background: rgba(239, 68, 68, 0.1);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.2);
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
        }

        /* Footer */
        .login-footer {
            text-align: center;
            margin-top: 24px;
            color: var(--text-muted);
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .login-footer i {
            color: #10b981;
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
                @if(isset($settings) && $settings->logo)
                <img src="{{ asset('uploads/settings/' . $settings->logo) }}" alt="Logo">
                @else
                <div style="width: 100px; height: 100px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 24px; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px auto; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
                    <i class="bi bi-box-seam" style="font-size: 40px; color: var(--primary);"></i>
                </div>
                @endif
                <h4>إطلالة المشرق</h4>
                <p>الإطلالة المشرق للخدمات اللوجستيه</p>
            </div>

            <!-- Validation Error Alert -->
            @if ($errors->any())
                <div class="alert-modern">
                    <i class="bi bi-exclamation-octagon-fill"></i>
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

                <!-- Remember Me -->
                <div class="form-check d-flex align-items-center">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">تذكرني على هذا الجهاز</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-modern-primary">
                    <span>دخول النظام</span>
                    <i class="bi bi-box-arrow-in-left"></i>
                </button>
            </form>

            <div class="login-footer">
                <i class="bi bi-shield-lock-fill"></i> اتصال آمن ومحمي بتبادل بيانات مشفر
            </div>

        </div>
    </div>

</body>
</html>
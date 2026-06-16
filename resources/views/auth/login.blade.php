<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - {{ $settings->site_name ?? '' }}</title>

    <!-- Cairo Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
       :root{
    --primary:#2b9fa0;
    --primary-dark:#21878b;
    --border:#4e9d9f;
}

body{
    margin:0;
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family:'Cairo',sans-serif;
    direction:rtl;
    background:
        linear-gradient(rgba(255,255,255,.88),rgba(255,255,255,.88)),
        url("https://www.transparenttextures.com/patterns/gplay.png");
    background-color:#f4f4f4;
    overflow:hidden;
    position:relative;
}

/* القطعتين الجانبيتين */
body::before,
body::after{
    content:"";
    position:fixed;
    width:120px;
    height:450px;
    background:linear-gradient(180deg,#33b0b2,#2d9698);
    top:50%;
    transform:translateY(-50%);
    border-radius:20px;
    z-index:0;
}

body::before{
    left:-30px;
}

body::after{
    right:-30px;
}

/* إلغاء الـ glow القديم */
.glow-blob{
    display:none;
}

.login-container{
    position:relative;
    z-index:2;
    width:100%;
    max-width:500px;
}

.login-card{
        background:
        linear-gradient(rgba(255,255,255,.88),rgba(255,255,255,.88)),
        url("https://www.transparenttextures.com/patterns/gplay.png");
    background-color:#f4f4f4;
    border-radius:20px;
    padding:30px;
    box-shadow:
        0 10px 25px rgba(0,0,0,.12),
        0 2px 6px rgba(0,0,0,.05);
    border:1px solid #ececec;
}

.login-logo{
    text-align:center;
    margin-bottom:15px;
}

.login-logo img{
    width:180px !important;
    height:auto !important;
    object-fit:contain;
}

.login-logo h4{
    display:none;
}

.login-logo p{
    display:none;
}

/* صندوق الفورم الداخلي */
form{
    background:#fff;
    border-radius:16px;
    padding:25px;
    box-shadow:
        0 4px 15px rgba(0,0,0,.08);
    border:1px solid #ededed;
}

.form-label-modern{
    display:none;
}

.input-icon-wrapper{
    position:relative;
    margin-bottom:18px;
}

.input-icon{
    position:absolute;
    right:18px;
    top:50%;
    transform:translateY(-50%);
    color:var(--primary);
    font-size:22px;
}

.form-control-modern{
    height:52px;
    border:2px solid var(--border) !important;
    border-radius:12px !important;
    background:#fff !important;
    box-shadow:none !important;
    padding-right:55px !important;
    font-size:15px !important;
    color:#444 !important;
}

.form-control-modern::placeholder{
    color:#666;
    font-weight:600;
}

.form-control-modern:focus{
    border-color:var(--primary) !important;
    box-shadow:0 0 0 3px rgba(43,159,160,.12) !important;
}

/* remember me */
.form-check{

}

.form-check-input-modern{
    width:22px;
    height:22px;
    border:2px solid #8f8f8f;
    border-radius:4px;

}

.form-check-label-modern{
    color:#333;
    font-size:18px;
    font-weight:600;
    margin-right: 10px;
}

/* الزر */
.btn-modern-primary{
    position:relative;
    overflow:hidden;
    height:52px;
    border-radius:30px;
    border:none;
    background:linear-gradient(
        135deg,
        #2ea4a6 0%,
        #2b9fa0 40%,
        #1f8b8d 100%
    );
    font-size:18px;
    font-weight:800;
    color:#fff;
    box-shadow:0 5px 15px rgba(43,159,160,.35);
    width: 100%;
}

.btn-modern-primary::before{
    content:"";
    position:absolute;
    top:0;
    left:-100%;
    width:80%;
    height:100%;
    background:rgba(255,255,255,.18);
    transform:skewX(-25deg);
}

.btn-modern-primary:hover::before{
    left:130%;
    transition:1s;
}

.btn-modern-primary:hover{
    transform:none;
}

.alert-modern{
    background:#fff1f1;
    color:#d9534f;
    border:1px solid #f3c1c1;
    border-radius:12px;
}

.login-footer{
    text-align:center;
    margin-top:18px;
    color:#3f6f71;
    font-size:18px;
}

.login-footer i{
    display:none;
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
                @if($settings->logo)
                <img src="{{ asset('uploads/settings/' . $settings->logo) }}" class="rounded-5" style="width: 150px; height: 150px;" alt="">
                @endif
                <h4 class="mt-2">{{ $settings->site_name ?? '' }}</h4>
                <p>{{ $settings->site_description ?? '' }}</p>
            </div>

            <!-- Validation Error Alert -->
            @if ($errors->any())
                <div class="alert-modern">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label class="form-label-modern">البريد الإلكتروني</label>
                    <div class="input-icon-wrapper">
                        <i class="bi bi-envelope input-icon"></i>
                        <input type="email" name="email" class="form-control form-control-modern" 
                               placeholder="name@example.com" required autofocus>
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label class="form-label-modern">كلمة المرور</label>
                    <div class="input-icon-wrapper">
                        <i class="bi bi-lock input-icon"></i>
                        <input type="password" name="password" class="form-control form-control-modern" 
                               placeholder="••••••••" required>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="form-check d-flex align-items-center mb-4 p-0">
                    <input type="checkbox" class="form-check-input-modern" id="remember" name="remember">
                    <label class="form-check-label-modern" for="remember">تذكرني على هذا الجهاز</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-modern-primary">
                    <span>دخول النظام</span>
                    <i class="bi bi-arrow-left"></i>
                </button>
            </form>

            <div class="login-footer">
                <i class="bi bi-shield-fill-check me-1"></i> اتصال آمن ومحمي بالكامل
            </div>

        </div>
    </div>

</body>
</html>
<style>
    /* Premium Sidebar Override */
    :root {
        --sidebar-bg-grad: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
        --sidebar-text: #94a3b8;
        --sidebar-text-hover: #f8fafc;
        --sidebar-active-bg: rgba(255, 255, 255, 0.08);
        --sidebar-border: rgba(255, 255, 255, 0.05);
        --primary-gradient: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    }
    body.dark-mode {
        --sidebar-bg-grad: linear-gradient(180deg, #020617 0%, #0f172a 100%);
        --sidebar-active-bg: rgba(59, 130, 246, 0.15);
    }
    .sidebar {
        box-shadow: -5px 0 25px rgba(0, 0, 0, 0.15);
        border-left: 1px solid var(--sidebar-border);
    }
    .sidebar ul li a {
        margin: 4px 12px;
        border-radius: 10px;
        padding: 12px 16px;
        font-weight: 500;
        letter-spacing: 0.3px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .sidebar ul li a:hover {
        background: rgba(255, 255, 255, 0.05);
        transform: translateX(-4px);
    }
    .sidebar ul li a.active {
        background: var(--sidebar-active-bg);
        border-right: 3px solid #3b82f6;
        color: #fff;
        font-weight: 700;
    }
    .sidebar ul li a.active i {
        color: #60a5fa;
    }
    .sidebar .logo {
        padding: 12px 12px 24px 12px;
    }
    .sidebar .logo-icon {
        box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
    }
    .sidebar::before, .sidebar::after {
        opacity: 0.5; /* Dimmer background blobs */
    }
    .btn-sidebar-add-client {
        background: var(--primary-gradient);
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .btn-sidebar-add-client:hover {
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
    }
</style>

<div class="sidebar" id="sidebar">

    <div>
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="logo">
            <div class="logo-icon">
                @if(isset($settings) && $settings->logo)
                <img src="{{ asset('uploads/settings/' . $settings->logo) }}" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;" alt="">
                @else
                <i class="bi bi-box-seam fs-3"></i>
                @endif
            </div>
            <div class="logo-text">
                <h4>{{ $settings->site_name ?? 'إطلالة المشرق' }}</h4>
                <small>{{ $settings->site_description ?? 'لوحة الإدارة' }}</small>
            </div>
        </a>

        <!-- Menu -->
        <ul>
            @can('view dashboard')
            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i> الرئيسية
                </a>
            </li>
            @endcan

            <li>
                <a href="{{ route('admin.daily-reports.index') }}" class="{{ request()->routeIs('admin.daily-reports.*') ? 'active' : '' }}">
                    <i class="bi bi-journal-text"></i> التقارير اليومية
                </a>
            </li>

            @can('view clients')
            <li>
                <a href="{{ route('clients.index') }}" class="{{ request()->routeIs('clients.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i> المناديب
                </a>
            </li>
            @endcan
            
            <li>
                <a href="{{ route('cities.index') }}" class="{{ request()->routeIs('cities.*') ? 'active' : '' }}">
                    <i class="bi bi-geo-alt-fill"></i> المدن
                </a>
            </li>

            @can('view users')
            <li>
                <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <i class="bi bi-person-badge-fill"></i> المستخدمين
                </a>
            </li>
            @endcan

            @can('view roles')
            <li>
                <a href="{{ route('roles.index') }}" class="{{ request()->routeIs('roles.*') ? 'active' : '' }}">
                    <i class="bi bi-shield-lock-fill"></i> الصلاحيات
                </a>
            </li>
            @endcan

            @can('view settings')
            <li>
                <a href="{{ route('settings') }}" class="{{ request()->routeIs('settings') ? 'active' : '' }}">
                    <i class="bi bi-gear-fill"></i> الإعدادات
                </a>
            </li>
            @endcan
        </ul>
    </div>

    <div class="sidebar-bottom">
        <a href="{{ route('clients.create') }}" class="btn-sidebar-add-client">
            <i class="bi bi-plus-circle-fill"></i> إضافة عميل جديد
        </a>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="sidebar-logout-btn">
                <i class="bi bi-box-arrow-right"></i> تسجيل الخروج
            </button>
        </form>
    </div>

</div>
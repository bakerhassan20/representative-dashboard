<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
  
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- Add this line inside <head> -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <style>
        
    </style>

</head>

<body>

    <div class="wrapper">

        <!-- SIDEBAR -->
        @include('partials.sidebar')

        <!-- MAIN -->
        <div class="main">

            <!-- NAVBAR -->
            @include('partials.navbar')

            <!-- CONTENT -->
            <div class="content">

                @yield('content')

            </div>

        </div>

    </div>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Dark Mode Toggle
        const toggleBtn = document.getElementById('toggleTheme');
        const icon = toggleBtn.querySelector('i');

        // Read from localStorage if theme preference is stored
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-mode');
            icon.classList.replace('bi-moon', 'bi-sun');
        }

        toggleBtn.addEventListener('click', function () {
            document.body.classList.toggle('dark-mode');
            if (document.body.classList.contains('dark-mode')) {
                icon.classList.replace('bi-moon', 'bi-sun');
                localStorage.setItem('theme', 'dark');
            } else {
                icon.classList.replace('bi-sun', 'bi-moon');
                localStorage.setItem('theme', 'light');
            }
        });

        // Sidebar Toggle Responsive
        const sidebarToggleBtn = document.getElementById('sidebarToggleBtn');
        const sidebar = document.getElementById('sidebar');

        if (sidebarToggleBtn && sidebar) {
            sidebarToggleBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                sidebar.classList.toggle('show');
            });

            document.addEventListener('click', function (e) {
                if (!sidebar.contains(e.target) && e.target !== sidebarToggleBtn && !sidebarToggleBtn.contains(e.target)) {
                    sidebar.classList.remove('show');
                }
            });
        }
    </script>

    @stack('scripts')

</body>

</html>
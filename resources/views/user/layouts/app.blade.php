<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance App</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body class="bg-gray-100 font-[Poppins]">

    <div class="max-w-md mx-auto min-h-screen bg-white shadow-lg relative">
        @yield('content')

        @include('user.layouts.bottom-nav')
    </div>

    @if (session('success'))
        <div id="toast-success"
            class="fixed top-5 left-1/2 -translate-x-1/2 bg-green-500 text-white px-5 py-3 rounded-xl shadow-lg z-50 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div id="toast-error"
            class="fixed top-5 left-1/2 -translate-x-1/2 bg-red-500 text-white px-5 py-3 rounded-xl shadow-lg z-50 text-sm">
            {{ session('error') }}
        </div>
    @endif

    <script>
        setTimeout(() => {
            ['toast-success', 'toast-error'].forEach((id) => {
                const toast = document.getElementById(id);

                if (toast) {
                    toast.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    toast.style.opacity = '0';
                    toast.style.transform = 'translate(-50%, -10px)';

                    setTimeout(() => toast.remove(), 500);
                }
            });
        }, 3000);
    </script>

</body>

</html>
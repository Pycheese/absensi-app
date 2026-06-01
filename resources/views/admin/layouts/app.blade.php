<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-[#F7F7F7] overflow-x-hidden">

    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        @include('admin.layouts.sidebar')

        {{-- CONTENT --}}
        <main class="flex-1 min-w-0 bg-[#F7F7F7] px-8 py-6">
            @yield('content')
        </main>

    </div>

</body>

</html>
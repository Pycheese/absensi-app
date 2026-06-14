<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Yukshopping App</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#E5E5E5] flex justify-center min-h-screen">

    <main class="relative w-full max-w-[402px] min-h-[874px] bg-[#1E3A6D] overflow-hidden rounded-[24px]">

        <div class="absolute top-[-220px] left-1/2 -translate-x-1/2 w-[540px] h-[620px] bg-[#31C5E3] rounded-full">
        </div>

        <div class="relative z-10 flex flex-col items-center min-h-[874px]">

            <h1 class="mt-[60px] text-white text-[20px] font-extrabold tracking-wide">
                HELLO, WELCOME!
            </h1>

            <div class="mt-[70px] flex flex-col items-center">
                <img src="{{ asset('images/logo 2.png') }}" class="w-[130px]" alt="Logo">

                <h2 class="mt-[12px] text-[#1E3A6D] text-[42px] font-black tracking-[-2px] leading-none">
                    yukshopping
                </h2>
            </div>

            <form action="{{ route('login') }}" method="POST" class="mt-[110px] w-full px-[70px]">
                @csrf

                <input type="email" name="email" placeholder="Masukkan Email" required
                    class="h-[48px] w-full rounded-full border-[4px] border-[#31C5E3] bg-[#F6F6F6] px-5 outline-none">

                <input type="password" name="password" placeholder="Masukkan Password" required
                    class="mt-[28px] h-[48px] w-full rounded-full border-[4px] border-[#31C5E3] bg-[#F6F6F6] px-5 outline-none">

                <button type="submit"
                    class="mt-[66px] mx-auto block w-[122px] h-[40px] rounded-full bg-[#31C5E3] text-white text-[18px] font-extrabold">
                    Login
                </button>

                <p class="mt-[26px] text-center text-white text-[13px]">
                    Belum punya akun?
                    <a href="register" class="font-medium">Daftar</a>
                </p>
            </form>
            <div class="absolute bottom-[14px] w-[84px] h-[5px] bg-white rounded-full"></div>

        </div>
    </main>
</body>

</html>
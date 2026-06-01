<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Yukshopping</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#E5E5E5] flex justify-center">

    <main class="relative w-full max-w-[402px] min-h-screen bg-[#1E3A6D] overflow-hidden rounded-[24px]">

        <div class="relative z-10 flex min-h-screen flex-col items-center px-[48px] py-[60px]">

            <div class="h-[104px] w-[104px] rounded-full bg-[#31C5E3] overflow-hidden flex items-center justify-center">
                <img src="{{ asset('images/logo 2.png') }}" alt="Logo" class="w-[70px] h-[70px] object-contain">
            </div>

            <h1 class="mt-[34px] text-[32px] font-extrabold leading-none text-white">
                Sign Up
            </h1>

            <p class="mt-[18px] text-center text-[9px] leading-[14px] text-white/45">
                Create an account so you can explore all the<br>
                existing jobs
            </p>

            @if ($errors->any())
                <div class="mt-5 w-full rounded-xl bg-red-500 p-3 text-[12px] text-white">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="mt-[35px] w-full">
                @csrf

                <div class="flex h-[60px] w-full overflow-hidden rounded-[17px] bg-white">
                    <div class="flex w-[54px] items-center justify-center text-black">
                        <svg width="29" height="29" viewBox="0 0 24 24" fill="black">
                            <path
                                d="M12 12c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm0 2c-3.33 0-10 1.67-10 5v3h20v-3c0-3.33-6.67-5-10-5z" />
                        </svg>
                    </div>

                    <div class="h-full w-[1px] bg-gray-300"></div>

                    <input type="text" name="name" value="{{ old('name') }}" placeholder="User Name" required
                        class="h-full min-w-0 flex-1 px-3 text-[14px] text-gray-700 outline-none placeholder:text-[#9EA2AA]">
                </div>

                <div class="mt-[18px] flex h-[60px] w-full overflow-hidden rounded-[17px] bg-white">
                    <div class="flex w-[54px] items-center justify-center text-black">
                        <svg width="29" height="29" viewBox="0 0 24 24" fill="none">
                            <path d="M3 5h18v14H3V5z" stroke="black" stroke-width="2.3" stroke-linejoin="round" />
                            <path d="M4 6l8 7 8-7" stroke="black" stroke-width="2.3" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>

                    <div class="h-full w-[1px] bg-gray-300"></div>

                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Address" required
                        class="h-full min-w-0 flex-1 px-3 text-[14px] text-gray-700 outline-none placeholder:text-[#9EA2AA]">
                </div>

                <div class="mt-[18px] flex h-[60px] w-full overflow-hidden rounded-[17px] bg-white">
                    <div class="flex w-[54px] items-center justify-center text-black">
                        <svg width="29" height="29" viewBox="0 0 24 24" fill="black">
                            <path
                                d="M17 8V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H5v15h14V8h-2zm-8 0V6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9zm4 9.73V20h-2v-2.27c-.6-.35-1-1-1-1.73 0-1.1.9-2 2-2s2 .9 2 2c0 .73-.4 1.38-1 1.73z" />
                        </svg>
                    </div>

                    <div class="h-full w-[1px] bg-gray-300"></div>

                    <input type="password" name="password" placeholder="Password" required
                        class="h-full min-w-0 flex-1 px-3 text-[14px] text-gray-700 outline-none placeholder:text-[#9EA2AA]">
                </div>

                <div class="mt-[18px] flex h-[60px] w-full overflow-hidden rounded-[17px] bg-white">
                    <div class="flex w-[54px] items-center justify-center text-black">
                        <svg width="29" height="29" viewBox="0 0 24 24" fill="black">
                            <path
                                d="M17 8V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H5v15h14V8h-2zm-8 0V6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9zm4 9.73V20h-2v-2.27c-.6-.35-1-1-1-1.73 0-1.1.9-2 2-2s2 .9 2 2c0 .73-.4 1.38-1 1.73z" />
                        </svg>
                    </div>

                    <div class="h-full w-[1px] bg-gray-300"></div>

                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required
                        class="h-full min-w-0 flex-1 px-3 text-[14px] text-gray-700 outline-none placeholder:text-[#9EA2AA]">
                </div>

                <button type="submit"
                    class="mt-[33px] h-[52px] w-full rounded-full bg-[#31C5E3] text-[20px] font-extrabold text-white">
                    Sign Up
                </button>

            </form>

            <p class="mt-[30px] text-center text-[13px] text-white">
                Already gave an account?
                <a href="{{ url('/login') }}" class="font-extrabold text-white">
                    Log in
                </a>
            </p>

        </div>

    </main>

</body>

</html>
<div class="fixed bottom-0 left-0 right-0 max-w-md mx-auto bg-white border-t shadow-lg">

    <div class="flex justify-around py-4">

        <a href="/dashboard" class="font-medium">
            Home
        </a>

        <a href="/history" class="font-medium">
            History
        </a>

        <a href="/profile" class="font-medium">
            Profile
        </a>

    </div>
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-4">
            {{ session('success') }}
        </div>
    @endif

</div>
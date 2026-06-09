<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate - Auth</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f7f3ee] min-h-screen flex flex-col">


    <!-- ヘッダー -->
    <header class="relative w-full bg-white px-8 py-4 flex justify-center items-center border-b border-[#e0d8d0]">
        <h1 class="text-xl font-serif text-[#6b4f3f]">FashionablyLate</h1>

        @if ($showLogin ?? false)
            <a href="{{ route('admin.login') }}"
                class="absolute right-8 px-4 py-1.5 border border-[#ddd8d3] text-[#6b4f3f] bg-white rounded hover:bg-gray-50 transition">
                login
            </a>
        @endif

        @if ($showRegister ?? false)
            <a href="{{ route('admin.register') }}"
                class="absolute right-8 px-4 py-1.5 border border-[#ddd8d3] text-[#6b4f3f] bg-white rounded hover:bg-gray-50 transition">
                register
            </a>
        @endif

    </header>

    <main class="flex-1 flex flex-col items-center mt-12">
        {{ $slot }}
    </main>

</body>


</html>
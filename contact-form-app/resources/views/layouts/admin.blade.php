<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate - Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white min-h-screen flex flex-col">

    <!-- ヘッダー -->
    <header class="relative w-full bg-white px-8 py-4 flex justify-center items-center border-b border-[#e0d8d0]">
        <h1 class="text-xl font-serif text-[#6b4f3f]">FashionablyLate</h1>

        <form method="POST" action="{{ route('admin.logout') }}" class="absolute right-8">
            @csrf
            <button
                class="px-4 py-1.5 border border-[#ddd8d3] text-[#6b4f3f] bg-white rounded hover:bg-gray-50 transition">
                logout
            </button>
        </form>
    </header>

    <!-- メイン -->
    <main class="flex-1 px-8 py-10">
        {{ $slot }}
    </main>

</body>


</html>
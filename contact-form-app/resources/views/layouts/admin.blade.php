<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate - Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f7f3ee] min-h-screen flex flex-col">

    <!-- ヘッダー -->
    <header class="w-full bg-[#f7f3ee] px-8 py-4 flex justify-between items-center border-b border-[#e0d8d0]">
        <h1 class="text-xl font-serif text-[#6b4f3f]">FashionablyLate</h1>

        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button class="text-[#6b4f3f] hover:underline">
                ログアウト
            </button>
        </form>
    </header>

    <!-- メイン -->
    <main class="flex-1 px-8 py-10">
        {{ $slot }}
    </main>

</body>

</html>
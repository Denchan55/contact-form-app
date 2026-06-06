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
    <header class="w-full bg-[#f7f3ee] px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-serif text-[#6b4f3f]">FashionablyLate</h1>

        @isset($showRegister)
            <a href="{{ route('admin.register') }}" class="text-[#6b4f3f] hover:underline">register</a>
        @endisset

        @isset($showLogin)
            <a href="{{ route('admin.login') }}" class="text-[#6b4f3f] hover:underline">login</a>
        @endisset
    </header>

    <!-- メイン -->
    <main class="flex-1 flex justify-center items-start mt-12">
        {{ $slot }}
    </main>

</body>

</html>
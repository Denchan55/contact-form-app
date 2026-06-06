<x-auth-layout :showLogin="true">

    <div class="bg-white w-full max-w-md mx-auto p-8 rounded shadow">
        <h2 class="text-center text-2xl font-serif text-[#6b4f3f] mb-6">Register</h2>

        <form method="POST" action="{{ route('admin.register.post') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm text-[#6b4f3f] mb-1">名前</label>
                <input type="text" name="name" placeholder="名前"
                    class="w-full px-4 py-2 border border-[#d6cfc7] rounded focus:outline-none focus:border-[#6b4f3f]">
            </div>

            <div class="mb-4">
                <label class="block text-sm text-[#6b4f3f] mb-1">メールアドレス</label>
                <input type="email" name="email" placeholder="email@example.com"
                    class="w-full px-4 py-2 border border-[#d6cfc7] rounded focus:outline-none focus:border-[#6b4f3f]">
            </div>

            <div class="mb-4">
                <label class="block text-sm text-[#6b4f3f] mb-1">パスワード</label>
                <input type="password" name="password" placeholder="password"
                    class="w-full px-4 py-2 border border-[#d6cfc7] rounded focus:outline-none focus:border-[#6b4f3f]">
            </div>

            <div class="mb-6">
                <label class="block text-sm text-[#6b4f3f] mb-1">パスワード確認</label>
                <input type="password" name="password_confirmation" placeholder="password"
                    class="w-full px-4 py-2 border border-[#d6cfc7] rounded focus:outline-none focus:border-[#6b4f3f]">
            </div>

            <button type="submit" class="w-full py-2 bg-[#6b4f3f] text-white rounded hover:bg-[#5a4234] transition">
                登録
            </button>
        </form>
    </div>

</x-auth-layout>
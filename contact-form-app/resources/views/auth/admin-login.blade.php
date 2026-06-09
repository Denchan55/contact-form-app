<x-auth-layout :showRegister="true" :showLogin="false">

    <!-- タイトル（中央寄せ） -->
    <h2 class="text-center text-2xl font-serif text-[#6b4f3f] mt-16 mb-8">
        Login
    </h2>

    <!-- カード（中央寄せ） -->
    <div class="w-full max-w-md bg-white p-8 rounded shadow">
        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm text-[#6b4f3f] mb-1">メールアドレス</label>
                <input type="email" name="email" placeholder="email@example.com"
                    class="w-full px-4 py-2 border border-[#d6cfc7] rounded focus:outline-none focus:border-[#6b4f3f]">
            </div>

            <div class="mb-6">
                <label class="block text-sm text-[#6b4f3f] mb-1">パスワード</label>
                <input type="password" name="password" placeholder="password"
                    class="w-full px-4 py-2 border border-[#d6cfc7] rounded focus:outline-none focus:border-[#6b4f3f]">
            </div>

            <button type="submit"
    class="px-6 py-2 bg-[#6b4f3f] text-white rounded hover:bg-[#5a4234] transition mx-auto block">
    ログイン
</button>

        </form>
    </div>

</x-auth-layout>

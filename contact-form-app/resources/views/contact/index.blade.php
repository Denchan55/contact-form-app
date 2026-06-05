<x-guest-layout>
    <div class="bg-white min-h-screen">
        <div class="max-w-3xl mx-auto px-8 py-12">
            <h1 class="text-2xl font-serif text-[#6b5744] text-center mb-10">Contact</h1>
@if ($errors->any())
    <div class="text-red-500">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <!-- 入力フォーム -->
            <form action="{{ route('contact.confirm') }}" method="POST">
                @csrf
                @include('contact._form')

                <!-- 確認画面ボタン -->
                <div class="flex justify-center mt-10">
                    <button type="submit"
                        class="px-16 py-3 bg-[#7d7470] hover:bg-[#6b5f57] border border-transparent rounded font-medium text-white transition">
                        確認画面
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        @vite(['resources/js/contact/init.js']) 
    @endpush
</x-guest-layout>

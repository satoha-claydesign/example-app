@auth
<div class="p-4">
    <form action=" {{ route('tweet.create') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mt-1">
            <textarea name="tweet" rows="3"
                class="focus:ring-blue-400 focus:border-blue-400 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
                placeholder="つぶやきを入力"></textarea>
        </div>
        <p class="mt-2 text-sm text-gray-500">
            140文字まで
        </p>

        <div>
            <x-tweet.form.images>
            </x-tweet.form.images>
        </div>


        @error('tweet')
        <x-alert.error>{{ $message }}</x-alert.error>
        @enderror

        <div class="flex flex-wrap justify-end">
            <x-element.button>
                つぶやく
            </x-element.button>
        </div>
    </form>
</div>
@endauth
@guest
<div class="w-full flex flex-wrap justify-center">
    <div class="w-full p-4 flex flex-wrap justify-between">
        <x-element.button-a :href="route('login')" theme="primary">
            ログイン
        </x-element.button-a>
        <x-element.button-a :href="route('register')" theme="secondary">
            会員登録
        </x-element.button-a>
    </div>
</div>
@endguest
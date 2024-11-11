<x-layout>
    <h1 class="my-16 text-4xl font-medium text-center text-slate-600">
        Sign in To Your Account
    </h1>

    <x-card class="px-16 py-8">
        <form action="{{ route('auth.store') }}" method="POST">
            @csrf

            <div class="mb-8">
                {{-- <label for="email" class="block mb-2 text-sm font-medium text-slate-900">E-mail</label> --}}
                <x-label for="email" :required="true">Email</x-label>
                <x-text-input name="email"></x-text-input>
            </div>

            <div class="mb-8">
                <x-label for="password" :required="true">
                    Password
                </x-label>
                <x-text-input name="password" type="password"></x-text-input>
            </div>

            <div class="flex justify-between mb-8 text-sm font-medium">
                <div>
                    <div class="flex items-center space-x-2">
                        <input type="checkbox" name="remember" class="border rounded-sm border-slate-400">
                        <label for="remember">Remember Me</label>
                    </div>
                </div>

                <div>
                    <a href="#" class="text-indigo-600 hover:underline">Forgot Password ??</a>
                </div>

            </div>

            <x-button class="w-full bg-blue-100">Login</x-button>
        </form>
    </x-card>
</x-layout>

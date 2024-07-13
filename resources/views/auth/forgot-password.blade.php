<x-guest-layout>
    <x-auth-card>
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Masukkan nomor email dan telepon anda untuk mengganti password') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" />

        <x-splade-form action="{{ route('password.email') }}" class="space-y-4">
            <x-splade-input id="email" class="block mt-1 w-full" type="email" name="email" :label="__('Email')" required autofocus />
            <x-splade-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :label="__('Phone Number')" required />
            <div class="flex items-center justify-end">
                <x-splade-submit :label="__('Reset Password')" class="bg-primary-700 text-white" />
            </div>
        </x-splade-form>
    </x-auth-card>
</x-guest-layout>

<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        @if(session('success'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('success') }}
            </div>
        @endif

        <h1 style="font-size:35px; margin-left:40px;">CliniQuickAid Login</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
            <x-label for="student_id" value="{{ __('Student ID') }}" />
            <x-input id="student_id" class="block mt-1 w-full gray-text" type="text" name="student_id"
             value="Enter your Student ID" required autofocus autocomplete="username"
             onfocus="if (this.value === 'Enter your Student ID') this.value = 'SVFC-';"
             oninput="formatStudentID(this)" maxlength="20" />

            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" placeholder="Password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

<style>
    .gray-text {
        color: gray;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let studentIdField = document.getElementById('student_id');

        if (!studentIdField.value.startsWith('SVFC-')) {
            studentIdField.value = 'SVFC-';
        }

        applyPlaceholderEffect(studentIdField);

        setTimeout(() => {
            studentIdField.setSelectionRange(5, 5);
        }, 10);
    });

    function formatStudentID(input) {
        let value = input.value.replace('SVFC-', '').replace(/[^0-9]/g, '');

        let formattedValue = 'SVFC-';

        if (value.length > 6) {
            formattedValue += value.substring(0, 6) + '-' + value.substring(6);
        } else {
            formattedValue += value;
        }

        input.value = formattedValue;
        applyPlaceholderEffect(input);

        let newPos = value.length > 6 ? value.length + 7 : value.length + 5;
        input.setSelectionRange(newPos, newPos);
    }

    function applyPlaceholderEffect(input) {
        if (input.value === 'Enter your Student ID') {
            input.classList.add('gray-text');
            input.value = 'Enter your Student ID';
        } else if (input.value.startsWith('Enter your Student ID')) {
            input.value = 'Enter your Student ID';
        } else {
            input.classList.remove('gray-text');
        }
    }
</script>

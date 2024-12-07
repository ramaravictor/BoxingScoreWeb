<section class="bg-white rounded-lg shadow-md p-6 space-y-6">
    <!-- Header -->
    <header>
        <h2 class="text-2xl font-semibold text-slate-900">
            {{ __('Update Password') }}
        </h2>
        <p class="mt-2 text-sm text-gray-600 leading-relaxed">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <!-- Update Password Form -->
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div class="relative">
            <label for="current_password" class="text-sm font-medium text-slate-700 mb-1 block">
                {{ __('Current Password') }}
            </label>
            <input id="current_password" name="current_password" type="password"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-slate-500 focus:outline-none"
                autocomplete="current-password" required />
            <button type="button" onclick="togglePassword('current_password', this)"
                class="absolute right-3 top-9 text-gray-500 hover:text-gray-700">
                <i class="fa-regular fa-eye"></i>
            </button>
        </div>

        <!-- New Password -->
        <div class="relative">
            <label for="password" class="text-sm font-medium text-slate-700 mb-1 block">
                {{ __('New Password') }}
            </label>
            <input id="password" name="password" type="password"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-slate-500 focus:outline-none"
                autocomplete="new-password" required />
            <button type="button" onclick="togglePassword('password', this)"
                class="absolute right-3 top-9 text-gray-500 hover:text-gray-700">
                <i class="fa-regular fa-eye"></i>
            </button>
        </div>

        <!-- Confirm Password -->
        <div class="relative">
            <label for="password_confirmation" class="text-sm font-medium text-slate-700 mb-1 block">
                {{ __('Confirm Password') }}
            </label>
            <input id="password_confirmation" name="password_confirmation" type="password"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-slate-500 focus:outline-none"
                autocomplete="new-password" required />
            <button type="button" onclick="togglePassword('password_confirmation', this)"
                class="absolute right-3 top-9 text-gray-500 hover:text-gray-700">
                <i class="fa-regular fa-eye"></i>
            </button>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end items-center gap-4">
            <button type="submit"
                class="px-6 py-2 bg-slate-900 text-white text-sm font-semibold uppercase tracking-wide rounded-md hover:bg-slate-700 transition duration-300">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-slate-600">
                    {{ __('Password updated successfully.') }}
                </p>
            @endif
        </div>
    </form>
</section>

<!-- JavaScript Toggle Password -->
<script>
    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);
        const icon = button.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>

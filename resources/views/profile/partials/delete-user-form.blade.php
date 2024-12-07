<section class="p-6 space-y-6 bg-white rounded-lg shadow-md">
    <!-- Header -->
    <header>
        <h2 class="text-2xl font-semibold text-slate-900">
            {{ __('Delete Account') }}
        </h2>
        <p class="mt-2 text-sm leading-relaxed text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <!-- Delete Button -->
    <div class="text-right">
        <button type="button" x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="px-6 py-2 text-sm font-semibold text-white transition duration-300 bg-red-600 rounded-md shadow hover:bg-red-700">
            <i class="mr-2 fa-solid fa-trash-can"></i>{{ __('Delete Account') }}
        </button>
    </div>

    <!-- Modal Confirmation -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-white rounded-lg shadow-lg">
            @csrf
            @method('delete')

            <!-- Modal Header -->
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-slate-900">
                    {{ __('Confirm Account Deletion') }}
                </h2>
                <button type="button" x-on:click="$dispatch('close')" class="text-gray-500 hover:text-gray-800">
                    <i class="text-xl fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Confirmation Text -->
            <p class="text-sm leading-relaxed text-gray-600">
                {{ __('Are you sure you want to delete your account? This action is irreversible. Please enter your password to confirm.') }}
            </p>

            <!-- Password Input -->
            <div class="relative mt-4">
                <label for="password" class="block mb-1 text-sm font-medium text-slate-700">
                    {{ __('Password') }}
                </label>
                <input id="password" name="password" type="password"
                    class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-slate-500 focus:outline-none"
                    placeholder="{{ __('Enter your password') }}" required />
                <button type="button" onclick="togglePassword('password', this)"
                    class="absolute text-gray-500 right-3 top-9 hover:text-gray-700">
                    <i class="fa-regular fa-eye"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-sm text-red-500" />

            <!-- Action Buttons -->
            <div class="flex justify-end gap-4 mt-6">
                <button type="button" x-on:click="$dispatch('close')"
                    class="px-4 py-2 font-semibold transition duration-300 border rounded-md text-slate-600 border-slate-300 hover:bg-slate-200">
                    {{ __('Cancel') }}
                </button>
                <button type="submit"
                    class="px-6 py-2 text-sm font-semibold text-white transition duration-300 bg-red-600 rounded-md shadow hover:bg-red-700">
                    <i class="mr-2 fa-solid fa-trash"></i>{{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>

<!-- JavaScript untuk Toggle Password Visibility -->
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

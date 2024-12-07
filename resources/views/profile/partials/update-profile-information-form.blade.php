<section class="bg-white rounded-lg shadow-md p-6 space-y-6">
    <!-- Header -->
    <header>
        <h2 class="text-2xl font-semibold text-slate-900">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-2 text-sm text-gray-600 leading-relaxed">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <!-- Profile Update Form -->
    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <!-- Name Input -->
        <div class="flex flex-col">
            <label for="name" class="text-sm font-medium text-slate-700 mb-1">{{ __('Name') }}</label>
            <input id="name" name="name" type="text"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-slate-500 focus:outline-none"
                value="{{ old('name', auth()->user()->name) }}" required autocomplete="name" />
            <p class="text-red-500 text-sm mt-1">{{ $errors->first('name') }}</p>
        </div>

        <!-- Email Input -->
        <div class="flex flex-col">
            <label for="email" class="text-sm font-medium text-slate-700 mb-1">{{ __('Email') }}</label>
            <input id="email" name="email" type="email"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-slate-500 focus:outline-none"
                value="{{ old('email', auth()->user()->email) }}" required autocomplete="username" />
            <p class="text-red-500 text-sm mt-1">{{ $errors->first('email') }}</p>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end items-center gap-4">
            <button type="submit"
                class="px-6 py-2 bg-slate-900 text-white text-sm font-semibold uppercase tracking-wide rounded-md hover:bg-slate-700 transition duration-300">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-slate-600">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>

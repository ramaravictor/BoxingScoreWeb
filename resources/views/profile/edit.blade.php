<x-app-layout>
    <div class="py-40">
        <div class="px-6 mx-auto max-w-7xl lg:px-8">
            <!-- Grid Container -->
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                <!-- Column 1: Update Profile Information -->
                @include('profile.partials.update-profile-information-form')

                <!-- Column 2: Update Password -->
                @include('profile.partials.update-password-form')

                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>

<div class="card">
    <div class="card-body">
        <h2 class="h5 font-weight-bold text-gray-900 dark:text-gray-100 mb-4">
            {{ __('Update Password') }}
        </h2>

        <form method="post" action="{{ route('password.update') }}" class="space-y-4">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="current_password" class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Current Password') }}
                </label>
                <input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" />
                <x-input-error class="mt-2" :messages="$errors->updatePassword->get('current_password')" />
            </div>

            <div class="form-group">
                <label for="password" class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('New Password') }}
                </label>
                <input id="password" name="password" type="password" class="form-control" autocomplete="new-password" />
                <x-input-error class="mt-2" :messages="$errors->updatePassword->get('password')" />
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Confirm Password') }}
                </label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
                <x-input-error class="mt-2" :messages="$errors->updatePassword->get('password_confirmation')" />
            </div>

            <div class="d-flex justify-content-between">
                <x-primary-button>{{ __('Save') }}</x-primary-button>

                @if (session('status') === 'password-updated')
                    <p class="ml-4 text-sm text-success">
                        {{ __('Saved.') }}
                    </p>
                @endif
            </div>
        </form>
    </div>
</div>

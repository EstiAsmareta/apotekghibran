<div class="card">
    <div class="card-body">
        <h2 class="h5 font-weight-bold text-gray-900 dark:text-gray-100 mb-4">
            {{ __('Profile Information') }}
        </h2>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
            @csrf
            @method('patch')

            <div class="form-group">
                <label for="name" class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Name') }}
                </label>
                <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="form-group">
                <label for="email" class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Email') }}
                </label>
                <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-2 text-sm text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-blue-500 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div class="d-flex justify-content-between">
                <x-primary-button>{{ __('Save') }}</x-primary-button>

                @if (session('status') === 'profile-updated')
                    <p class="ml-4 text-sm text-success">
                        {{ __('Saved.') }}
                    </p>
                @endif
            </div>
        </form>
    </div>
</div>

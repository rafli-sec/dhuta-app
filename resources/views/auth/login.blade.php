{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
<!DOCTYPE html>
<html lang="en" class="h-full bg-black">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - SIM Dhuta Car Wash</title>
  @vite('resources/css/app.css')
  <style>
    html, body {
      margin: 0; padding: 0; height: 100%;
    }
    .background-image {
      position: fixed;
      inset: 0;
      z-index: -10;
      background-image: url("{{ asset('images/dhutcarwash.jpg') }}");
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      filter: brightness(0.5);
    }
  </style>
</head>
<body class="flex h-screen w-screen">

  <!-- Background full layar -->
  <div class="background-image"></div>

  <!-- Spacer kiri di desktop, hilang di mobile -->
  <div class="hidden md:block md:flex-1"></div>

  <!-- Form login di kanan -->
  <div class="flex flex-1 items-center justify-center px-6 md:px-16">

    <div class="w-full max-w-md bg-white/20 backdrop-blur-md rounded-lg p-8 shadow-lg text-white">

      <h2 class="text-3xl font-bold underline mb-10 text-center select-none">Login</h2>

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
          <x-input-label for="email" :value="__('Email')" class="text-white" />
          <x-text-input id="email" class="block mt-1 w-full bg-white/10 text-white border-white focus:border-indigo-300 focus:ring-indigo-300" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
          <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <!-- Password -->
        <div class="mt-4">
          <x-input-label for="password" :value="__('Password')" class="text-white" />

          <x-text-input id="password" class="block mt-1 w-full bg-white/10 text-white border-white focus:border-indigo-300 focus:ring-indigo-300"
                        type="password"
                        name="password"
                        required autocomplete="current-password" />

          <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
          <label for="remember_me" class="inline-flex items-center text-white">
            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
            <span class="ml-2 text-sm">{{ __('Remember me') }}</span>
          </label>
        </div>

        <div class="flex items-center justify-end mt-4 space-x-3">
          @if (Route::has('password.request'))
            <a class="underline text-sm text-white hover:text-indigo-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
              {{ __('Forgot your password?') }}
            </a>
          @endif

          <x-primary-button>
            {{ __('Log in') }}
          </x-primary-button>
        </div>

      </form>

      <footer class="mt-16 text-center text-white select-none text-lg">
        SIM @2025 - Dhuta Car Wash
      </footer>

    </div>

  </div>

</body>
</html>

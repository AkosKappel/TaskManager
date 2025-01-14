@extends('layout.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white rounded-xl shadow-2xl p-8">
            <!-- Logo Section -->
            <div class="text-center mb-8">
                <a href="/">
                    <x-application-logo class="mx-auto w-16 h-16 text-indigo-600" />
                </a>
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Welcome back</h2>
                <p class="mt-2 text-sm text-gray-600">Please sign in to your account</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('Email')" class="block text-sm font-medium text-gray-700" />
                    <div class="mt-1">
                        <x-input id="email"
                                 class="appearance-none block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                 type="email"
                                 name="email"
                                 :value="old('email')"
                                 placeholder="you@example.com"
                                 required
                                 autofocus />
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between">
                        <x-label for="password" :value="__('Password')" class="block text-sm font-medium text-gray-700" />
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                    <div class="mt-1">
                        <x-input id="password"
                                 class="appearance-none block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                 type="password"
                                 name="password"
                                 placeholder="••••••••"
                                 required
                                 autocomplete="current-password" />
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me"
                               type="checkbox"
                               name="remember"
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded cursor-pointer">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-900 cursor-pointer">
                            {{ __('Remember me') }}
                        </label>
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                        {{ __('Sign in') }}
                    </button>
                </div>

                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        {{ __("Don't have an account?") }}
                        <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                            {{ __('Sign up') }}
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('layout.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white rounded-xl shadow-2xl p-8">
            <!-- Logo Section -->
            <div class="text-center mb-8">
                <a href="/">
                    <x-application-logo class="mx-auto w-16 h-16 text-indigo-600" />
                </a>
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Create an account</h2>
                <p class="mt-2 text-sm text-gray-600">Join us and get started today</p>
            </div>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <x-label for="name" :value="__('Name')" class="block text-sm font-medium text-gray-700" />
                    <div class="mt-1">
                        <x-input id="name"
                                 class="appearance-none block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                 type="text"
                                 name="name"
                                 :value="old('name')"
                                 placeholder="John Doe"
                                 required
                                 autofocus />
                    </div>
                </div>

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
                                 required />
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <x-label for="password" :value="__('Password')" class="block text-sm font-medium text-gray-700" />
                    <div class="mt-1">
                        <x-input id="password"
                                 class="appearance-none block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                 type="password"
                                 name="password"
                                 placeholder="••••••••"
                                 required
                                 autocomplete="new-password" />
                    </div>
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-label for="password_confirmation" :value="__('Confirm Password')" class="block text-sm font-medium text-gray-700" />
                    <div class="mt-1">
                        <x-input id="password_confirmation"
                                 class="appearance-none block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                 type="password"
                                 name="password_confirmation"
                                 placeholder="••••••••"
                                 required />
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                        {{ __('Create Account') }}
                    </button>
                </div>

                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        {{ __('Already have an account?') }}
                        <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                            {{ __('Sign in') }}
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection

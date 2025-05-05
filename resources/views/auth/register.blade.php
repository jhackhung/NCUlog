<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-r from-blue-50 to-indigo-50">
        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-md overflow-hidden rounded-xl">
            <div class="mb-6 flex justify-center">
                <a href="/" class="flex items-center">
                    <x-authentication-card-logo class="w-20 h-20" />
                    <span class="text-2xl font-bold text-blue-600 ml-2">NCU 課程評論</span>
                </a>
            </div>
            
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">{{ __('註冊帳戶') }}</h2>
            
            <x-validation-errors class="mb-4 bg-red-50 p-3 rounded-lg text-sm" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <x-label for="name" value="{{ __('姓名') }}" class="text-gray-700" />
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <x-input id="name" class="block mt-1 w-full pl-10 border-gray-300 focus:border-blue-500 focus:ring-blue-500" 
                            type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="請輸入您的姓名" />
                    </div>
                </div>

                <div class="mt-4">
                    <x-label for="email" value="{{ __('電子信箱') }}" class="text-gray-700" />
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <x-input id="email" class="block mt-1 w-full pl-10 border-gray-300 focus:border-blue-500 focus:ring-blue-500" 
                            type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="your-email@example.com" />
                    </div>
                    <p class="text-xs text-gray-500 mt-1">建議使用校園信箱註冊，以獲得完整功能</p>
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('密碼') }}" class="text-gray-700" />
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <x-input id="password" class="block mt-1 w-full pl-10 border-gray-300 focus:border-blue-500 focus:ring-blue-500" 
                            type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                    </div>
                    <p class="text-xs text-gray-500 mt-1">密碼必須至少8個字元</p>
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('確認密碼') }}" class="text-gray-700" />
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <x-input id="password_confirmation" class="block mt-1 w-full pl-10 border-gray-300 focus:border-blue-500 focus:ring-blue-500" 
                            type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                    </div>
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-label for="terms">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms" required class="text-blue-600 focus:ring-blue-500" />
                                <div class="ms-2">
                                    {!! __('我同意 :terms_of_service 和 :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="text-blue-600 hover:text-blue-800">'.__('服務條款').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="text-blue-600 hover:text-blue-800">'.__('隱私政策').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif

                <div class="mt-6">
                    <x-button class="w-full justify-center py-3 bg-blue-600 hover:bg-blue-700">
                        {{ __('註冊') }}
                    </x-button>
                </div>
                
                <div class="mt-5 text-center">
                    <a class="text-sm text-blue-600 hover:text-blue-800" href="{{ route('login') }}">
                        {{ __('已有帳戶？點此登入') }}
                    </a>
                </div>
            </form>
            
            <!-- Social Registration Options -->
            <div class="mt-8">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="bg-white px-3 text-gray-500">{{ __('或使用以下方式註冊') }}</span>
                    </div>
                </div>
                
                <div class="mt-4 grid grid-cols-2 gap-3">
                    <a href="#" class="flex justify-center items-center py-2 border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">
                        <svg class="h-5 w-5 mr-2" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" />
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                        </svg>
                        Google
                    </a>
                    <a href="#" class="flex justify-center items-center py-2 border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">
                        <svg class="h-5 w-5 mr-2" fill="#1877F2" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                        Facebook
                    </a>
                </div>
            </div>
        </div>
        
        <p class="mt-6 text-center text-gray-500 text-xs">
            &copy; {{ date('Y') }} NCU課程評論平台. {{ __('版權所有') }}
        </p>
    </div>
</x-guest-layout>
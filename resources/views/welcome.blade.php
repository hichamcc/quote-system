<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Custom Quotes Generator</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-2 hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Log in
                        </a>
                    @endauth
                </nav>
            @endif
        </header>
        <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
            <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
                <div class="flex flex-col justify-center p-6 lg:p-8 shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)] bg-white dark:bg-[#161615] rounded-bl-lg rounded-br-lg lg:rounded-br-none lg:rounded-tl-lg lg:w-[438px] overflow-hidden">
                    <div class="mb-6">
                        <h1 class="text-3xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Custom Quotes Generator</h1>
                        <p class="text-[#706f6c] dark:text-[#A1A09A]">Generate detailed custom quotes for countertops, backsplashes, and more</p>
                    </div>
                    
                    <div class="mb-6">
                        <h2 class="text-xl font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Features</h2>
                        <ul class="space-y-2 text-[#706f6c] dark:text-[#A1A09A]">
                            <li class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#f53003] dark:text-[#FF4433]">
                                    <path d="M20 6 9 17l-5-5"/>
                                </svg>
                                Project Management
                            </li>
                            <li class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#f53003] dark:text-[#FF4433]">
                                    <path d="M20 6 9 17l-5-5"/>
                                </svg>
                                Material Calculation
                            </li>
                            <li class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#f53003] dark:text-[#FF4433]">
                                    <path d="M20 6 9 17l-5-5"/>
                                </svg>
                                Place Takeoffs
                            </li>
                            <li class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#f53003] dark:text-[#FF4433]">
                                    <path d="M20 6 9 17l-5-5"/>
                                </svg>
                                Detailed Cost Breakdowns
                            </li>
                        </ul>
                    </div>
                    
                    <div class="flex gap-3">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-5 py-2 bg-[#1b1b18] hover:bg-black text-white dark:bg-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white rounded-sm text-sm font-medium">
                                    Go to Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="inline-flex items-center px-5 py-2 bg-[#1b1b18] hover:bg-black text-white dark:bg-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white rounded-sm text-sm font-medium">
                                    Get Started
                                </a>

                            @endauth
                        @endif
                    </div>
                </div>
                
                <div class="bg-[#dbdbd7] dark:bg-[#3E3E3A] lg:grow rounded-t-lg lg:rounded-t-none lg:rounded-r-lg relative aspect-[335/376] lg:aspect-auto">
                    <div class="absolute inset-0 flex items-center justify-center p-6 bg-cover bg-center" style="background-image: url('https://artelye.com/wp-content/uploads/2025/03/Depositphotos_782910228_XL-scaled.jpg');">
                        <!-- Your content inside the div -->
                    </div>
                </div>
            </main>
        </div>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="NCU課程評論平台 - 中央大學學生的課程評價、心得分享與選課參考">
    <title>NCU 課程評論平台 - 選課的最佳夥伴</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <!-- Add favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
</head>

<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <a href="/" class="flex items-center">
                        <img src="{{ asset('images/logo.svg') }}" alt="NCU課評Logo" class="h-8 w-8 mr-2">
                        <span class="text-xl font-bold text-blue-600">NCU 課程評論</span>
                    </a>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="/courses" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">課程討論區</a>
                    <a href="/announcements"
                        class="text-gray-700 hover:text-blue-600 font-medium transition-colors">公告</a>
                    <a href="/textbooks"
                        class="text-gray-700 hover:text-blue-600 font-medium transition-colors">教科書購買</a>
                    <a href="/contact" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">聯絡我們</a>
                </div>
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <div class="relative inline-block text-left">
                                <button id="userMenuButton"
                                    class="flex items-center space-x-1 text-gray-700 hover:text-blue-600 transition focus:outline-none">
                                    <span>{{ Auth::user()->name }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <div id="userDropdown"
                                    class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-10">
                                    <a href="{{ url('/dashboard') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">我的帳戶</a>
                                    <a href="{{ url('/my-reviews') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">我的評論</a>
                                    <a href="{{ url('/bookmarks') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">我的收藏</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">登出</button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-medium">登入</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition-colors">註冊</a>
                            @endif
                        @endauth
                    @endif
                    <button class="md:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-12 md:py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">選擇最適合你的課程</h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">透過真實學長姐的評論，做出明智的選課決定</p>

            <!-- Search Bar (Featured Position) -->
            <div class="max-w-2xl mx-auto">
                <form action="/courses" method="GET" class="flex">
                    <input type="text" name="query" placeholder="搜尋課程、教師或科系..."
                        class="w-full border-0 rounded-l-md px-6 py-4 text-gray-800 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <button type="submit"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-4 rounded-r-md transition-colors font-medium">
                        搜尋
                    </button>
                </form>
            </div>

            <div class="mt-8 flex flex-wrap justify-center gap-4">
                <div class="flex items-center">
                    <span class="bg-blue-500 rounded-full p-2 mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </span>
                    <span>{{ rand(1000, 5000) }}+ 課程評論</span>
                </div>
                <div class="flex items-center">
                    <span class="bg-blue-500 rounded-full p-2 mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </span>
                    <span>{{ rand(300, 800) }}+ 教師資料</span>
                </div>
                <div class="flex items-center">
                    <span class="bg-blue-500 rounded-full p-2 mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                    </span>
                    <span>{{ rand(80, 120) }}+ 系所學程</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto mt-10 px-4 flex-grow">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Left Column: Popular Categories -->
            <div class="md:col-span-1">
                <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                    <h2 class="text-xl font-bold mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        熱門分類
                    </h2>
                    <ul class="space-y-3">
                        <li><a href="/categories/general-education"
                                class="block p-3 bg-gray-50 rounded hover:bg-blue-50 transition-colors">通識課程</a></li>
                        <li><a href="/categories/programming"
                                class="block p-3 bg-gray-50 rounded hover:bg-blue-50 transition-colors">程式設計</a></li>
                        <li><a href="/categories/english"
                                class="block p-3 bg-gray-50 rounded hover:bg-blue-50 transition-colors">英語課程</a></li>
                        <li><a href="/categories/mathematics"
                                class="block p-3 bg-gray-50 rounded hover:bg-blue-50 transition-colors">數學課程</a></li>
                        <li><a href="/categories/management"
                                class="block p-3 bg-gray-50 rounded hover:bg-blue-50 transition-colors">管理課程</a></li>
                        <li><a href="/categories"
                                class="text-blue-600 hover:text-blue-800 text-sm flex justify-end mt-2">查看所有分類 →</a>
                        </li>
                    </ul>
                </div>

                <!-- Announcements -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                        最新公告
                    </h2>
                    <ul class="space-y-4">
                        <li class="pb-3 border-b border-gray-100">
                            <p class="font-medium">網站更新：新增教科書團購功能！</p>
                            <p class="text-sm text-gray-500 mt-1">2025/05/01</p>
                        </li>
                        <li class="pb-3 border-b border-gray-100">
                            <p class="font-medium">開放學生上傳課程評論與評分</p>
                            <p class="text-sm text-gray-500 mt-1">2025/04/25</p>
                        </li>
                        <li class="pb-3">
                            <p class="font-medium">112學年度下學期課程資料更新完成</p>
                            <p class="text-sm text-gray-500 mt-1">2025/04/10</p>
                        </li>
                        <li><a href="/announcements"
                                class="text-blue-600 hover:text-blue-800 text-sm flex justify-end mt-2">查看所有公告 →</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Right Column: Hot Posts and Highly Rated Courses -->
            <div class="md:col-span-2">
                <!-- Hot Posts -->
                <section class="mb-10">
                    <h2 class="text-2xl font-bold mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-red-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z" />
                        </svg>
                        熱門討論
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-white p-5 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                            <div class="flex justify-between items-start mb-3">
                                <span
                                    class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">程式設計</span>
                                <span class="text-gray-500 text-sm">3 小時前</span>
                            </div>
                            <h3 class="font-semibold text-lg">程式設計（一）哪位老師最推？</h3>
                            <p class="text-gray-600 mt-2 line-clamp-2">想詢問資工系的程式設計（一）課程，聽說有幾位老師教學風格差很多，想請問推薦哪位老師的課...
                            </p>
                            <div class="flex items-center justify-between mt-4">
                                <div class="flex items-center space-x-4">
                                    <span class="flex items-center text-gray-500 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                        42 則留言
                                    </span>
                                    <span class="flex items-center text-gray-500 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                        </svg>
                                        120 個讚
                                    </span>
                                </div>
                                <a href="/posts/1" class="text-blue-600 hover:text-blue-800 text-sm">查看討論</a>
                            </div>
                        </div>

                        <div class="bg-white p-5 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                            <div class="flex justify-between items-start mb-3">
                                <span
                                    class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded">通識英語</span>
                                <span class="text-gray-500 text-sm">1 天前</span>
                            </div>
                            <h3 class="font-semibold text-lg">通識英語心得分享串</h3>
                            <p class="text-gray-600 mt-2 line-clamp-2">
                                想開個串讓大家分享通識英語的上課心得，聽說有些班適合英文程度較低的同學，有些則需要英文底子好...</p>
                            <div class="flex items-center justify-between mt-4">
                                <div class="flex items-center space-x-4">
                                    <span class="flex items-center text-gray-500 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                        33 則留言
                                    </span>
                                    <span class="flex items-center text-gray-500 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                        </svg>
                                        87 個讚
                                    </span>
                                </div>
                                <a href="/posts/2" class="text-blue-600 hover:text-blue-800 text-sm">查看討論</a>
                            </div>
                        </div>

                        <div class="bg-white p-5 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                            <div class="flex justify-between items-start mb-3">
                                <span
                                    class="inline-block bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded">選課建議</span>
                                <span class="text-gray-500 text-sm">2 天前</span>
                            </div>
                            <h3 class="font-semibold text-lg">大三上學期課太多怎麼辦？</h3>
                            <p class="text-gray-600 mt-2 line-clamp-2">資工系大三上學期必修太多，還有通識和英文要補修，感覺修不完，想請問學長姐有沒有建議...</p>
                            <div class="flex items-center justify-between mt-4">
                                <div class="flex items-center space-x-4">
                                    <span class="flex items-center text-gray-500 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                        28 則留言
                                    </span>
                                    <span class="flex items-center text-gray-500 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                        </svg>
                                        65 個讚
                                    </span>
                                </div>
                                <a href="/posts/3" class="text-blue-600 hover:text-blue-800 text-sm">查看討論</a>
                            </div>
                        </div>

                        <div class="bg-white p-5 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                            <div class="flex justify-between items-start mb-3">
                                <span
                                    class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded">課堂體驗</span>
                                <span class="text-gray-500 text-sm">3 天前</span>
                            </div>
                            <h3 class="font-semibold text-lg">有人修過XXX教授的微積分嗎？</h3>
                            <p class="text-gray-600 mt-2 line-clamp-2">下學期打算修微積分，想了解一下XXX教授上課風格、評分方式和作業多寡，謝謝！</p>
                            <div class="flex items-center justify-between mt-4">
                                <div class="flex items-center space-x-4">
                                    <span class="flex items-center text-gray-500 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                        19 則留言
                                    </span>
                                    <span class="flex items-center text-gray-500 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                        </svg>
                                        42 個讚
                                    </span>
                                </div>
                                <a href="/posts/4" class="text-blue-600 hover:text-blue-800 text-sm">查看討論</a>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-6">
                        <a href="/posts"
                            class="inline-flex items-center px-6 py-2 border border-blue-600 text-blue-600 rounded-md hover:bg-blue-50 transition-colors">
                            查看更多討論
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </section>

                <!-- Top Rated Courses -->
                <section class="mb-10">
                    <h2 class="text-2xl font-bold mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-yellow-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                        好評課程
                    </h2>
                    <div class="overflow-hidden overflow-x-auto">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-white p-5 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                                <div class="flex justify-between mb-2">
                                    <span
                                        class="inline-block bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded">資訊工程學系</span>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <span class="font-bold ml-1">4.9</span>
                                    </div>
                                </div>
                                <h3 class="font-semibold text-lg">資料結構</h3>
                                <p class="text-gray-600 text-sm mt-1">張OO 教授</p>
                                <div class="mt-3">
                                    <div class="flex items-center mb-1">
                                        <span class="text-sm text-gray-600 w-20">內容實用性</span>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-green-500 h-2 rounded-full" style="width: 95%"></div>
                                        </div>
                                        <span class="text-sm text-gray-600 ml-2">4.8</span>
                                    </div>
                                    <div class="flex items-center mb-1">
                                        <span class="text-sm text-gray-600 w-20">教學品質</span>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-green-500 h-2 rounded-full" style="width: 98%"></div>
                                        </div>
                                        <span class="text-sm text-gray-600 ml-2">4.9</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-sm text-gray-600 w-20">難易度</span>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-yellow-500 h-2 rounded-full" style="width: 70%"></div>
                                        </div>
                                        <span class="text-sm text-gray-600 ml-2">3.5</span>
                                    </div>
                                </div>
                                <a href="/courses/1"
                                    class="block text-blue-600 hover:text-blue-800 text-sm mt-4 text-center">查看課程詳情</a>
                            </div>

                            <div class="bg-white p-5 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                                <div class="flex justify-between mb-2">
                                    <span
                                        class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded">管理學院</span>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <span class="font-bold ml-1">4.8</span>
                                    </div>
                                </div>
                                <h3 class="font-semibold text-lg">行銷管理</h3>
                                <p class="text-gray-600 text-sm mt-1">王OO 教授</p>
                                <div class="mt-3">
                                    <div class="flex items-center mb-1">
                                        <span class="text-sm text-gray-600 w-20">內容實用性</span>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-green-500 h-2 rounded-full" style="width: 98%"></div>
                                        </div>
                                        <span class="text-sm text-gray-600 ml-2">4.9</span>
                                    </div>
                                    <div class="flex items-center mb-1">
                                        <span class="text-sm text-gray-600 w-20">教學品質</span>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-green-500 h-2 rounded-full" style="width: 94%"></div>
                                        </div>
                                        <span class="text-sm text-gray-600 ml-2">4.7</span>
                                    </div>
                                </div>
                                <a href="/courses/2"
                                    class="block text-blue-600 hover:text-blue-800 text-sm mt-4 text-center">查看課程詳情</a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
    <!-- Footer -->
    <footer class="bg-white border-t py-6 text-center text-sm text-gray-500 mt-10">
        &copy; {{ date('Y') }} NCU 課程評論平台. All rights reserved.
    </footer>

    <script>
        const button = document.getElementById('userMenuButton');
        const dropdown = document.getElementById('userDropdown');

        button.addEventListener('click', function(event) {
            event.stopPropagation(); // 防止觸發 body 的關閉事件
            dropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', function(event) {
            if (!dropdown.contains(event.target) && !button.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
</body>

</html>

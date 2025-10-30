<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'App Pegawai')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-50 min-h-screen">
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <nav class="mt-4">
                <div class="flex justify-between items-center">
                    <div class="flex space-x-6 items-center">
                        <h1 class="font-bold text-gray-800">@yield('page-title', 'App Pegawai')</h1>
                        <ul class="flex space-x-6">
                            <li><a href="{{ url('/employees') }}"
                                    class="text-blue-600 hover:text-blue-800 transition duration-200">Employee</a></li>
                            <li><a href="{{ url('/departments') }}"
                                    class="text-blue-600 hover:text-blue-800 transition duration-200">Department</a></li>
                            <li><a href="{{ route('attendances.index') }}"
                                    class="text-blue-600 hover:text-blue-800 transition duration-200">Attendance</a></li>
                            <li><a href="{{ route('reports.index') }}"
                                    class="text-blue-600 hover:text-blue-800 transition duration-200">Report</a></li>
                            <li><a href="{{ url('/settings') }}"
                                    class="text-blue-600 hover:text-blue-800 transition duration-200">Settings</a></li>
                                    {{-- Contoh di dalam header/sidebar --}}
<li><a href="{{ route('positions.index') }}" class="text-blue-600 hover:text-blue-800 ...">Positions</a></li>
                        </ul>
                    </div>
                    
                    @auth {{-- Hanya tampilkan jika user sudah login --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" 
                                class="flex items-center text-gray-600 hover:text-gray-800 focus:outline-none px-3 py-2 rounded-md hover:bg-gray-100">
                            <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 ml-2 fill-current transition-transform" 
                                 :class="{ 'rotate-180': open }" 
                                 viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        
                        <div x-show="open" 
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-50"
                             style="display: none;">
                            <div class="py-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-150">
                                        <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endauth
                </div>
            </nav>
        </div>
    </header>

    <!-- Success Notification -->
    @if (session('success'))
        <div id="notification"
            class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-lg shadow-2xl border
     border-green-200 p-6 max-w-sm w-full mx-4 z-50 transition-all duration-300">
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Berhasil!</h3>
                    <p class="text-sm text-gray-600">{{ session('success') }}</p>
                </div>
            </div>
            <div class="mt-4 flex justify-end">
                <button onclick="closeNotification()" class="text-sm text-gray-500 hover:text-gray-700 font-medium">
                    Tutup
                </button>
            </div>
        </div>
        <div id="notification-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40"></div>
    @endif

    <main class="py-8">
        @yield('content')
    </main>
    <footer class="bg-white border-t mt-auto">
        <div class="max-w-7xl mx-auto px-4 py-4 text-center">
            <p class="text-gray-600">&copy; {{ date('Y') }} App Pegawai</p>
        </div>
    </footer>

    <script>
        //3 detik
        @if (session('success'))
            setTimeout(function() {
                closeNotification();
            }, 3000);
        @endif

        function closeNotification() {
            const notification = document.getElementById('notification');
            const overlay = document.getElementById('notification-overlay');
            if (notification && overlay) {
                notification.style.opacity = '0';
                notification.style.transform = 'translate(-50%, -50%) scale(0.95)';
                overlay.style.opacity = '0';
                setTimeout(function() {
                    notification.style.display = 'none';
                    overlay.style.display = 'none';
                }, 300);
            }
        }

        // Close notification when clicking overlay
        @if (session('success'))
            document.getElementById('notification-overlay').addEventListener('click', closeNotification);
        @endif
    </script>
</body>

</html>
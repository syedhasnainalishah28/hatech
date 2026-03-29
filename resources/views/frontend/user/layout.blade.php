<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | HA Tech</title>
    
    <!-- Google Fonts: Syncopate & Inter for Brutalist Luxury look -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Syncopate:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Syncopate', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            dark: '#0a0506',
                            red: '#3B0000',
                            gold: '#d4a574',
                            light: '#e8b44a'
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        body {
            background-color: #030101;
            color: #ffffff;
            font-family: 'Inter', sans-serif;
            background-image: 
                radial-gradient(circle at 15% 50%, rgba(59, 0, 0, 0.4), transparent 25%),
                radial-gradient(circle at 85% 30%, rgba(212, 165, 116, 0.05), transparent 25%);
            background-attachment: fixed;
        }
        
        h1, h2, h3, h4, h5, h6, .font-display {
            font-family: 'Syncopate', sans-serif;
        }

        /* Glassmorphism Classes */
        .glass-panel {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        .glass-card {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.05) 0%, rgba(255, 255, 255, 0.01) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* Nav Link Active State */
        .nav-link.active {
            color: #d4a574;
            background: rgba(212, 165, 116, 0.1);
            border-right: 2px solid #d4a574;
        }
        
        /* Custom Scrollbar for Sidebar */
        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar-scroll::-webkit-scrollbar-track {
            background: transparent;
        }
        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: rgba(212, 165, 116, 0.2);
            border-radius: 4px;
        }
    </style>
</head>
<body class="antialiased selection:bg-[#d4a574] selection:text-[#0a0506] flex h-screen overflow-hidden">

    <!-- Mobile Header -->
    <div class="lg:hidden fixed top-0 w-full h-16 glass-panel z-50 flex items-center justify-between px-4 border-b border-[#d4a574]/20">
        <a href="{{ url('/') }}" class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-full overflow-hidden ring-1 ring-[#d4a574]/30">
                <img src="{{ asset('logo.png') }}" alt="HA Tech" class="w-full h-full object-cover">
            </div>
            <span class="font-bold text-sm bg-gradient-to-r from-[#d4a574] to-[#e8b44a] bg-clip-text text-transparent">HA Tech</span>
        </a>
        <button id="mobile-sidebar-toggle" class="p-2 text-white hover:text-[#d4a574]">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>
    </div>

    <!-- Sidebar Navigation -->
    <aside id="dashboard-sidebar" class="fixed lg:static top-0 left-0 h-full w-64 glass-panel border-r border-[#d4a574]/20 z-40 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col">
        
        <!-- Logo Area (Desktop) -->
        <div class="hidden lg:flex items-center gap-3 px-6 h-20 border-b border-white/5 shrink-0">
            <div class="relative w-10 h-10 rounded-full overflow-hidden ring-2 ring-[#d4a574]/30">
                <img src="{{ asset('logo.png') }}" alt="HA Tech" class="w-full h-full object-cover">
            </div>
            <div>
                <div class="text-lg font-bold bg-gradient-to-r from-[#d4a574] via-[#e8b44a] to-[#c49a6b] bg-clip-text text-transparent">HA Tech</div>
            </div>
        </div>

        <!-- User Profile Quick View -->
        <div class="p-6 border-b border-white/5 mt-16 lg:mt-0">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#d4a574] to-[#e8b44a] p-0.5">
                    <div class="w-full h-full bg-[#0a0506] rounded-[10px] flex items-center justify-center">
                        <span class="text-[#d4a574] font-bold text-xl uppercase">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                </div>
                <div class="overflow-hidden">
                    <p class="text-white font-medium truncate">{{ Auth::user()->name }}</p>
                    <p class="text-gray-400 text-xs truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 py-6 px-4 space-y-2 sidebar-scroll overflow-y-auto">
            <a href="{{ route('user.dashboard') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400 hover:text-white hover:bg-white/5 transition-all group {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <i data-lucide="layout-dashboard" class="w-5 h-5 {{ request()->routeIs('user.dashboard') ? 'text-[#d4a574]' : 'group-hover:text-[#d4a574]' }} transition-colors"></i>
                <span class="font-medium text-sm">Overview</span>
            </a>
            
            <a href="{{ route('user.orders') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400 hover:text-white hover:bg-white/5 transition-all group {{ request()->routeIs('user.orders') ? 'active' : '' }}">
                <i data-lucide="shopping-bag" class="w-5 h-5 {{ request()->routeIs('user.orders') ? 'text-[#d4a574]' : 'group-hover:text-[#d4a574]' }} transition-colors"></i>
                <span class="font-medium text-sm">Order History</span>
            </a>
            
            <a href="{{ route('user.downloads') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400 hover:text-white hover:bg-white/5 transition-all group {{ request()->routeIs('user.downloads') ? 'active' : '' }}">
                <i data-lucide="download-cloud" class="w-5 h-5 {{ request()->routeIs('user.downloads') ? 'text-[#d4a574]' : 'group-hover:text-[#d4a574]' }} transition-colors"></i>
                <span class="font-medium text-sm">Digital Downloads</span>
            </a>
            
            <a href="{{ route('user.settings') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400 hover:text-white hover:bg-white/5 transition-all group {{ request()->routeIs('user.settings') ? 'active' : '' }}">
                <i data-lucide="settings" class="w-5 h-5 {{ request()->routeIs('user.settings') ? 'text-[#d4a574]' : 'group-hover:text-[#d4a574]' }} transition-colors"></i>
                <span class="font-medium text-sm">Settings</span>
            </a>
        </nav>

        <!-- Footer Actions -->
        <div class="p-4 border-t border-white/5 space-y-2">
            <a href="{{ url('/') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400 hover:text-white hover:bg-white/5 transition-all">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
                <span class="font-medium text-sm">Back to Website</span>
            </a>
            
            <form method="POST" action="{{ route('logout') }}" w-full>
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-red-400 hover:text-red-300 hover:bg-red-400/10 transition-all text-left">
                    <i data-lucide="log-out" class="w-5 h-5"></i>
                    <span class="font-medium text-sm">Sign Out</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Sidebar Overlay for Mobile -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-30 hidden lg:hidden"></div>

    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden relative">
        <!-- Top decorative gradient -->
        <div class="absolute top-0 left-0 right-0 h-32 bg-gradient-to-b from-[#d4a574]/5 to-transparent pointer-events-none z-0"></div>
        
        <!-- Content Scrollable Area -->
        <div class="flex-1 overflow-y-auto pt-20 lg:pt-8 px-4 lg:px-8 pb-12 relative z-10 w-full">
            <div class="max-w-6xl mx-auto w-full">
                
                @if(session('success'))
                <div class="mb-6 p-4 rounded-lg bg-green-500/10 border border-green-500/20 text-green-400 flex items-start gap-3 shadow-lg">
                    <i data-lucide="check-circle" class="w-5 h-5 shrink-0 mt-0.5"></i>
                    <p>{{ session('success') }}</p>
                </div>
                @endif
                
                @if($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-red-500/10 border border-red-500/20 text-red-400 shadow-lg">
                    <div class="flex items-center gap-2 mb-2">
                        <i data-lucide="alert-circle" class="w-5 h-5"></i>
                        <span class="font-bold">Please fix the following errors:</span>
                    </div>
                    <ul class="list-disc list-inside space-y-1 text-sm ml-7">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Page Header -->
                <div class="mb-8">
                    <h1 class="text-3xl lg:text-4xl font-display font-bold text-white tracking-wide uppercase">@yield('title')</h1>
                    @hasSection('subtitle')
                        <p class="text-gray-400 mt-2 text-sm lg:text-base">@yield('subtitle')</p>
                    @endif
                </div>

                <!-- Page Content -->
                @yield('content')
            </div>
        </div>
    </main>

    <script>
        // Initialize Lucide Icons
        lucide.createIcons();
        
        // Mobile Sidebar Toggle
        const toggleBtn = document.getElementById('mobile-sidebar-toggle');
        const sidebar = document.getElementById('dashboard-sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        
        function toggleSidebar() {
            const isClosed = sidebar.classList.contains('-translate-x-full');
            if (isClosed) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.style.overflow = '';
            }
        }
        
        toggleBtn.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);
    </script>
</body>
</html>

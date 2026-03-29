<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page_title', 'Admin Dashboard') | HA Tech</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS (via CDN for standalone layout) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'], },
                    colors: { background: '#0a0506', surface: '#1a0f11', primary: '#d4a574', accent: '#e8b44a' },
                }
            }
        }
    </script>
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        body { background-color: #0a0506; color: #fff; font-family: 'Inter', sans-serif; overflow-x: hidden; }
        .glass-card { background: rgba(255, 255, 255, 0.02); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 1.5rem; }
        .sidebar { background: #0a0506; border-right: 1px solid rgba(212, 165, 116, 0.1); box-shadow: 10px 0 30px rgba(0,0,0,0.5); }
        .nav-link { transition: all 0.3s ease; }
        .nav-link:hover, .nav-link.active { background: rgba(212, 165, 116, 0.05); color: #d4a574; border-right: 3px solid #d4a574; }
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(212, 165, 116, 0.2); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(212, 165, 116, 0.5); }
        
        /* Dropdown Styling */
        select option { background-color: #1a0f11 !important; color: #ffffff !important; }
        select:focus option { background-color: #1a0f11 !important; }
    </style>
</head>
<body class="antialiased flex h-screen overflow-hidden">
    
    <!-- Sidebar -->
    <aside class="sidebar w-72 flex-shrink-0 flex flex-col h-full relative z-20">
        <!-- Logo -->
        <div class="h-24 flex items-center px-8 border-b border-white/5">
            <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-full overflow-hidden ring-2 ring-[#d4a574]/30">
                    <img src="{{ asset('logo.png') }}" class="w-full h-full object-cover">
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-bold bg-gradient-to-r from-[#d4a574] to-[#e8b44a] bg-clip-text text-transparent uppercase tracking-wider">HA Tech</span>
                    <span class="text-[9px] text-gray-500 font-bold uppercase tracking-[0.2em]">Master Control</span>
                </div>
            </a>
        </div>
        
        <!-- Nav Links -->
        <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1">
            <p class="px-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-600 mb-4">Core Modules</p>
            
            <a href="{{ route('admin.dashboard') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 font-medium {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i> Dashboard
            </a>
            
            <a href="{{ route('admin.portfolios') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 font-medium {{ request()->routeIs('admin.portfolios*') ? 'active' : '' }}">
                <i data-lucide="briefcase" class="w-5 h-5"></i> Portfolios
            </a>

            <a href="{{ route('admin.products') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 font-medium {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                <i data-lucide="package" class="w-5 h-5"></i> Products
            </a>
            
            <a href="{{ route('admin.testimonials') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 font-medium {{ request()->routeIs('admin.testimonials*') ? 'active' : '' }}">
                <i data-lucide="message-square" class="w-5 h-5"></i> Testimonials
            </a>
            
            <a href="{{ route('admin.service_orders') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 font-medium {{ request()->routeIs('admin.service_orders*') ? 'active' : '' }}">
                <i data-lucide="shopping-cart" class="w-5 h-5"></i> Service Orders
            </a>

            <a href="{{ route('admin.services') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 font-medium {{ request()->routeIs('admin.services*') ? 'active' : '' }}">
                <i data-lucide="layers" class="w-5 h-5"></i> Services Catalog
            </a>
            
            <a href="{{ route('admin.pages') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 font-medium {{ request()->routeIs('admin.pages*') ? 'active' : '' }}">
                <i data-lucide="layout" class="w-5 h-5"></i> Site Pages
            </a>

            <a href="{{ route('admin.users') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 font-medium {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <i data-lucide="users" class="w-5 h-5"></i> Users
            </a>

            <p class="px-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-600 mt-6 mb-4">Marketing</p>
            <a href="{{ route('admin.email_templates') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 font-medium {{ request()->routeIs('admin.email_templates*') ? 'active' : '' }}">
                <i data-lucide="mail" class="w-5 h-5"></i> Email Templates
            </a>
            <a href="{{ route('admin.emails.send') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 font-medium {{ request()->routeIs('admin.emails.send*') ? 'active' : '' }}">
                <i data-lucide="send" class="w-5 h-5"></i> Send Bulk Email
            </a>
        </nav>
        
        <!-- Bottom Action -->
        <div class="p-6 border-t border-white/5">
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full py-3 rounded-xl border border-white/10 text-[#d4a574] font-bold hover:bg-[#d4a574] hover:text-[#0a0506] transition-all flex items-center justify-center gap-2 text-sm uppercase tracking-widest">
                    <i data-lucide="log-out" class="w-4 h-4"></i> Logout
                </button>
            </form>
        </div>
    </aside>
    
    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-full bg-[#11090B] relative overflow-hidden">
        <!-- Topbar -->
        <header class="h-24 flex items-center justify-between px-10 border-b border-white/5 relative z-10 bg-[#0a0506]/90 backdrop-blur-xl">
            <div>
                <h1 class="text-2xl font-black uppercase tracking-tight text-white">@yield('page_title', 'Dashboard')</h1>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ url('/') }}" target="_blank" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-gray-400 hover:text-[#d4a574] hover:bg-white/10 transition-all shadow-lg" title="Live Website">
                    <i data-lucide="external-link" class="w-4 h-4"></i>
                </a>
                <div class="h-10 px-4 rounded-full bg-[#d4a574]/10 border border-[#d4a574]/20 flex items-center justify-center text-[#d4a574] font-bold text-xs uppercase tracking-widest gap-2">
                    <i data-lucide="shield-check" class="w-4 h-4"></i> Admin
                </div>
            </div>
        </header>

        <!-- Dynamic Flash Statuses -->
        @if(session('success'))
        <div class="absolute top-28 right-10 z-50 animate-bounce">
            <div class="bg-emerald-500/20 border border-emerald-500/50 text-emerald-400 px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3 backdrop-blur-md">
                <i data-lucide="check-circle" class="w-5 h-5"></i>
                <span class="font-bold text-sm tracking-wide">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        @if($errors->any())
        <div class="absolute top-28 right-10 z-50">
            <div class="bg-rose-500/20 border border-rose-500/50 text-rose-400 px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3 backdrop-blur-md">
                <i data-lucide="alert-triangle" class="w-5 h-5"></i>
                <div class="font-bold text-sm tracking-wide">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Scrollable Dashboard Content -->
        <div class="flex-1 overflow-y-auto p-10 relative z-0">
            <!-- Subtle Texture -->
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0IiBoZWlnaHQ9IjQiPgo8cmVjdCB3aWR0aD0iNCIgaGVpZ2h0PSI0IiBmaWxsPSIjZmZmIiBmaWxsLW9wYWNpdHk9IjAuMDIiLz4KPC9zdmc+')] opacity-30 pointer-events-none"></div>
            <div class="relative z-10 w-full max-w-7xl mx-auto">
                @yield('content')
            </div>
        </div>
    </main>

    <!-- Init Icons -->
    <script>
        lucide.createIcons();
    </script>
    @stack('scripts')
</body>
</html>

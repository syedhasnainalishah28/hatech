<nav id="main-nav" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#d4a574] to-[#e8b44a] rounded-full blur-lg opacity-50 group-hover:opacity-75 transition-opacity"></div>
                    <div class="relative w-12 h-12 rounded-full overflow-hidden ring-2 ring-[#d4a574]/30 group-hover:ring-[#d4a574]/60 transition-all">
                        <img src="{{ asset('logo.png') }}" alt="HA Tech Logo" class="w-full h-full object-cover">
                    </div>
                </div>
                <div>
                    <div class="text-2xl font-bold bg-gradient-to-r from-[#d4a574] via-[#e8b44a] to-[#c49a6b] bg-clip-text text-transparent">HA Tech</div>
                    <div class="text-xs text-[#c4a57b] -mt-1 uppercase tracking-wider">Gen Z Evolution</div>
                </div>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center gap-8">
                <a href="{{ url('/') }}" class="text-gray-300 hover:text-[#d4a574] transition-colors relative group py-2">
                    Home
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-[#d4a574] to-[#e8b44a] group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="{{ url('/services') }}" class="text-gray-300 hover:text-[#d4a574] transition-colors relative group py-2">
                    Services
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-[#d4a574] to-[#e8b44a] group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="{{ url('/work') }}" class="text-gray-300 hover:text-[#d4a574] transition-colors relative group py-2">
                    Work
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-[#d4a574] to-[#e8b44a] group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="{{ url('/blogs') }}" class="text-gray-300 hover:text-[#d4a574] transition-colors relative group py-2">
                    Blogs
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-[#d4a574] to-[#e8b44a] group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="{{ url('/products') }}" class="text-gray-300 hover:text-[#d4a574] transition-colors relative group py-2">
                    Products
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-[#d4a574] to-[#e8b44a] group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="{{ url('/marketplace') }}" class="text-gray-300 hover:text-[#d4a574] transition-colors relative group py-2">
                    Marketplace
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-[#d4a574] to-[#e8b44a] group-hover:w-full transition-all duration-300"></span>
                </a>

                <div class="relative group">
                    <button class="text-gray-300 hover:text-[#d4a574] transition-colors flex items-center gap-1 py-2 outline-none">
                        About <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </button>
                    <div class="absolute top-full left-0 mt-4 w-56 bg-[#1a0f11]/70 backdrop-blur-xl border border-white/10 rounded-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 overflow-hidden shadow-2xl shadow-black/50 z-50">
                        <div class="py-2">
                            <a href="{{ url('/about') }}" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:text-[#d4a574] hover:bg-white/5 transition-all group/item">
                                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center group-hover/item:bg-[#d4a574]/20 transition-colors">
                                    <i data-lucide="info" class="w-4 h-4"></i>
                                </div>
                                <span class="font-medium tracking-wide">About Us</span>
                            </a>
                            <a href="{{ url('/team') }}" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:text-[#d4a574] hover:bg-white/5 transition-all group/item">
                                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center group-hover/item:bg-[#d4a574]/20 transition-colors">
                                    <i data-lucide="users" class="w-4 h-4"></i>
                                </div>
                                <span class="font-medium tracking-wide">Our Team</span>
                            </a>
                            <a href="{{ url('/about/founder') }}" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:text-[#d4a574] hover:bg-white/5 transition-all group/item">
                                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center group-hover/item:bg-[#d4a574]/20 transition-colors">
                                    <i data-lucide="user" class="w-4 h-4"></i>
                                </div>
                                <span class="font-medium tracking-wide">Founder</span>
                            </a>
                            <a href="{{ url('/about/ceo') }}" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:text-[#d4a574] hover:bg-white/5 transition-all group/item">
                                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center group-hover/item:bg-[#d4a574]/20 transition-colors">
                                    <i data-lucide="award" class="w-4 h-4"></i>
                                </div>
                                <span class="font-medium tracking-wide">CEO</span>
                            </a>
                        </div>
                    </div>
                </div>

                <a href="{{ url('/contact') }}" class="text-gray-300 hover:text-[#d4a574] transition-colors relative group py-2">
                    Contact
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-[#d4a574] to-[#e8b44a] group-hover:w-full transition-all duration-300"></span>
                </a>
            </div>

            <!-- Auth Buttons -->
            <div class="hidden lg:flex items-center gap-4">
                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="px-6 py-2.5 rounded-full bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#2b0e14] font-semibold hover:from-[#e8b44a] hover:to-[#d4a574] transition-all duration-300 shadow-lg shadow-[#d4a574]/30 flex items-center gap-2">
                            <i data-lucide="shield" class="w-4 h-4"></i> Admin Panel
                        </a>
                    @else
                        <a href="{{ route('user.dashboard') }}" class="px-6 py-2.5 rounded-full bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#2b0e14] font-semibold hover:from-[#e8b44a] hover:to-[#d4a574] transition-all duration-300 shadow-lg shadow-[#d4a574]/30 flex items-center gap-2">
                            <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard
                        </a>
                    @endif
                @else
                    <a href="{{ url('/login') }}" class="text-gray-300 hover:text-[#d4a574] transition-colors">Sign In</a>
                    <a href="{{ url('/signup') }}" class="px-6 py-2.5 rounded-full bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#2b0e14] font-semibold hover:from-[#e8b44a] hover:to-[#d4a574] transition-all duration-300 shadow-lg shadow-[#d4a574]/30">
                        Get Started
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="lg:hidden text-white p-2 rounded-xl hover:bg-white/10 transition-colors">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>
    </div>
</nav>

<!-- Sidebar Backdrop -->
<div id="sidebar-backdrop" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[60] opacity-0 pointer-events-none transition-opacity duration-300 lg:hidden"></div>

<!-- Sidebar Panel -->
<div id="mobile-sidebar" class="fixed top-0 right-0 h-full w-[300px] z-[70] lg:hidden transform translate-x-full transition-transform duration-300 ease-in-out">
    <!-- Sidebar Background -->
    <div class="absolute inset-0 bg-[#0a0506] border-l border-[#d4a574]/20"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-[#3B0000]/20 via-transparent to-[#d4a574]/5 pointer-events-none"></div>

    <!-- Sidebar Content -->
    <div class="relative h-full flex flex-col overflow-y-auto">
        <!-- Header -->
        <div class="flex items-center justify-between px-6 py-5 border-b border-white/5">
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <div class="w-9 h-9 rounded-full overflow-hidden ring-2 ring-[#d4a574]/30">
                    <img src="{{ asset('logo.png') }}" alt="HA Tech" class="w-full h-full object-cover">
                </div>
                <span class="font-bold text-lg bg-gradient-to-r from-[#d4a574] to-[#e8b44a] bg-clip-text text-transparent">HA Tech</span>
            </a>
            <button id="sidebar-close" class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-gray-400 hover:text-white hover:bg-white/10 transition-all">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Nav Links -->
        <nav class="flex-1 px-4 py-6 space-y-1">
            <a href="{{ url('/') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300 hover:text-[#d4a574] hover:bg-white/5 transition-all group">
                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center group-hover:bg-[#d4a574]/10 transition-colors">
                    <i data-lucide="home" class="w-4 h-4"></i>
                </div>
                <span class="font-medium">Home</span>
            </a>
            <a href="{{ url('/services') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300 hover:text-[#d4a574] hover:bg-white/5 transition-all group">
                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center group-hover:bg-[#d4a574]/10 transition-colors">
                    <i data-lucide="layers" class="w-4 h-4"></i>
                </div>
                <span class="font-medium">Services</span>
            </a>
            <a href="{{ url('/work') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300 hover:text-[#d4a574] hover:bg-white/5 transition-all group">
                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center group-hover:bg-[#d4a574]/10 transition-colors">
                    <i data-lucide="briefcase" class="w-4 h-4"></i>
                </div>
                <span class="font-medium">Work</span>
            </a>
            <a href="{{ url('/blogs') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300 hover:text-[#d4a574] hover:bg-white/5 transition-all group">
                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center group-hover:bg-[#d4a574]/10 transition-colors">
                    <i data-lucide="book-open" class="w-4 h-4"></i>
                </div>
                <span class="font-medium">Blogs</span>
            </a>
            <a href="{{ url('/products') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300 hover:text-[#d4a574] hover:bg-white/5 transition-all group">
                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center group-hover:bg-[#d4a574]/10 transition-colors">
                    <i data-lucide="package" class="w-4 h-4"></i>
                </div>
                <span class="font-medium">Products</span>
            </a>
            <a href="{{ url('/marketplace') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300 hover:text-[#d4a574] hover:bg-white/5 transition-all group">
                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center group-hover:bg-[#d4a574]/10 transition-colors">
                    <i data-lucide="store" class="w-4 h-4"></i>
                </div>
                <span class="font-medium">Marketplace</span>
            </a>

            <!-- About Section -->
            <div class="pt-2 pb-1">
                <p class="px-4 text-[9px] font-black uppercase tracking-[0.3em] text-gray-600">About HA Tech</p>
            </div>
            <a href="{{ url('/about') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300 hover:text-[#d4a574] hover:bg-white/5 transition-all group">
                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center group-hover:bg-[#d4a574]/10 transition-colors">
                    <i data-lucide="info" class="w-4 h-4"></i>
                </div>
                <span class="font-medium">About Us</span>
            </a>
            <a href="{{ url('/team') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300 hover:text-[#d4a574] hover:bg-white/5 transition-all group">
                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center group-hover:bg-[#d4a574]/10 transition-colors">
                    <i data-lucide="users" class="w-4 h-4"></i>
                </div>
                <span class="font-medium">Our Team</span>
            </a>
            <a href="{{ url('/about/founder') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300 hover:text-[#d4a574] hover:bg-white/5 transition-all group">
                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center group-hover:bg-[#d4a574]/10 transition-colors">
                    <i data-lucide="user" class="w-4 h-4"></i>
                </div>
                <span class="font-medium">Founder</span>
            </a>
            <a href="{{ url('/about/ceo') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300 hover:text-[#d4a574] hover:bg-white/5 transition-all group">
                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center group-hover:bg-[#d4a574]/10 transition-colors">
                    <i data-lucide="award" class="w-4 h-4"></i>
                </div>
                <span class="font-medium">CEO</span>
            </a>
            <a href="{{ url('/contact') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300 hover:text-[#d4a574] hover:bg-white/5 transition-all group">
                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center group-hover:bg-[#d4a574]/10 transition-colors">
                    <i data-lucide="mail" class="w-4 h-4"></i>
                </div>
                <span class="font-medium">Contact</span>
            </a>
        </nav>

        <!-- Bottom CTA -->
        <div class="px-4 py-6 border-t border-white/5 space-y-3">
            @auth
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-center gap-2 w-full py-3 rounded-xl bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#2b0e14] font-black text-sm hover:from-[#e8b44a] hover:to-[#d4a574] transition-all shadow-lg shadow-[#d4a574]/20">
                        <i data-lucide="shield" class="w-4 h-4"></i> Admin Panel
                    </a>
                @else
                    <a href="{{ route('user.dashboard') }}" class="flex items-center justify-center gap-2 w-full py-3 rounded-xl bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#2b0e14] font-black text-sm hover:from-[#e8b44a] hover:to-[#d4a574] transition-all shadow-lg shadow-[#d4a574]/20">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i> My Dashboard
                    </a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 py-3 rounded-xl border border-red-500/20 text-red-400 hover:bg-red-500/10 transition-all text-sm font-semibold">
                        <i data-lucide="log-out" class="w-4 h-4"></i> Sign Out
                    </button>
                </form>
            @else
                <a href="{{ url('/login') }}" class="flex items-center justify-center gap-2 w-full py-3 rounded-xl border border-white/10 text-gray-300 hover:text-[#d4a574] hover:border-[#d4a574]/30 transition-all text-sm font-semibold">
                    <i data-lucide="log-in" class="w-4 h-4"></i> Sign In
                </a>
                <a href="{{ url('/signup') }}" class="flex items-center justify-center gap-2 w-full py-3 rounded-xl bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#2b0e14] font-black text-sm hover:from-[#e8b44a] hover:to-[#d4a574] transition-all shadow-lg shadow-[#d4a574]/20">
                    <i data-lucide="rocket" class="w-4 h-4"></i> Get Started
                </a>
            @endauth
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btn = document.getElementById('mobile-menu-btn');
        const sidebar = document.getElementById('mobile-sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');
        const closeBtn = document.getElementById('sidebar-close');

        function openSidebar() {
            sidebar.classList.remove('translate-x-full');
            backdrop.classList.remove('opacity-0', 'pointer-events-none');
            backdrop.classList.add('opacity-100');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar.classList.add('translate-x-full');
            backdrop.classList.add('opacity-0', 'pointer-events-none');
            backdrop.classList.remove('opacity-100');
            document.body.style.overflow = '';
        }

        if (btn) btn.addEventListener('click', openSidebar);
        if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
        if (backdrop) backdrop.addEventListener('click', closeSidebar);

        // Close on link click
        document.querySelectorAll('.sidebar-link').forEach(link => {
            link.addEventListener('click', closeSidebar);
        });
    });
</script>

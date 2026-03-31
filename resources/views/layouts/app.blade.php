<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO -->
    <title>@yield('title', 'HA Tech | Gen Z Evolution')</title>
    <meta name="description" content="@yield('meta_description', 'High-end digital agency shaping the future through innovation and design.')">
    
    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- ICONS -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    
    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Inter"', 'sans-serif'],
                        display: ['"Montserrat"', 'sans-serif'],
                    },
                    colors: {
                        primary: '#d4a574',
                        secondary: '#8b6f47',
                        accent: '#e8b44a',
                        background: '#0a0506',
                    },
                    backgroundImage: {
                        'luxury-mesh': "radial-gradient(circle at 15% 15%, rgba(59, 0, 0, 0.4) 0%, transparent 60%), radial-gradient(circle at 85% 85%, rgba(212, 165, 116, 0.08) 0%, transparent 60%), #0a0506",
                    },
                    animation: {
                        'float-slow': 'float 6s ease-in-out infinite',
                        'bounce-slow': 'bounce-slow 4s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0) rotate(0deg)' },
                            '50%': { transform: 'translateY(-20px) rotate(2deg)' },
                        },
                        'bounce-slow': {
                            '0%, 100%': { transform: 'translateY(-5%)', animationTimingFunction: 'cubic-bezier(0.8,0,1,1)' },
                            '50%': { transform: 'none', animationTimingFunction: 'cubic-bezier(0,0,0.2,1)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        :root {
            --primary: #d4a574;
            --background: #0a0506;
        }
        html, body, * {
            cursor: none !important;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background);
            color: white;
            margin: 0;
            overflow-x: hidden;
        }
        h1, h2, h3, h4, h5, h6, .font-display {
            font-family: 'Montserrat', sans-serif;
            font-weight: 900;
            letter-spacing: -0.04em;
            text-transform: uppercase;
        }
        .bg-luxury-mesh {
            background: radial-gradient(circle at 15% 15%, rgba(59, 0, 0, 0.4) 0%, transparent 60%),
                        radial-gradient(circle at 85% 85%, rgba(212, 165, 116, 0.08) 0%, transparent 60%),
                        #0a0506;
        }
        .reveal-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .reveal-up.active {
            opacity: 1;
            transform: translateY(0);
        }
        .hero-grid {
            mask-image: radial-gradient(circle at center, black, transparent 80%);
            -webkit-mask-image: radial-gradient(circle at center, black, transparent 80%);
        }
        nav.scrolled {
            background: rgba(10, 5, 6, 0.98);
            border-bottom: 1px solid rgba(212, 165, 116, 0.2);
            backdrop-filter: blur(10px);
        }

        /* Figma AI Cursor Styles with Mac Look */
        #cursor-dot {
            position: fixed;
            pointer-events: none;
            z-index: 10000;
            width: 36px;
            height: 36px;
            background-size: contain;
            background-repeat: no-repeat;
            background-image: url("{{ asset('images/pointer_mac.svg') }}");
            will-change: transform;
            top: 0;
            left: 0;
            backface-visibility: hidden;
            /* Direct CSS Variable drive for zero latency */
            transform: translate3d(calc(var(--mouse-x, 0) * 1px), calc(var(--mouse-y, 0) * 1px), 0);
        }
        #cursor-glow-outer {
            width: 120px;
            height: 120px;
            /* Using a multi-stop gradient for a natural soft glow without filter:blur */
            background: radial-gradient(circle, rgba(212, 165, 116, 0.35) 0%, rgba(212, 165, 116, 0.15) 30%, transparent 70%);
            border-radius: 50%;
            position: fixed;
            pointer-events: none;
            z-index: 9999;
            opacity: 0.3;
            will-change: transform;
            top: 0;
            left: 0;
            backface-visibility: hidden;
            /* Smooth interpolation via lerp in JS */
            transform: translate3d(calc(var(--glow-x, 0) * 1px - 60px), calc(var(--glow-y, 0) * 1px - 60px), 0);
        }

        /* Cursor States */
        body.cursor-pointer #cursor-dot {
            /* Mac Hand Icon */
            background-image: url("{{ asset('images/hand.svg') }}");
            width: 52px;
            height: 52px;
        }
        body.cursor-text #cursor-dot {
            background-image: url("{{ asset('images/ibeam_mac.svg') }}");
            width: 30px;
            height: 30px;
        }
        body.cursor-zoom #cursor-dot {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='11' cy='11' r='8'/%3E%3Cline x1='21' y1='21' x2='16.65' y2='16.65'/%3E%3Cline x1='11' y1='8' x2='11' y2='14'/%3E%3Cline x1='8' y1='11' x2='14' y2='11'/%3E%3C/svg%3E");
            width: 48px;
            height: 48px;
            filter: drop-shadow(0 4px 12px rgba(0,0,0,0.5));
        }

        .cursor-hover #cursor-glow-outer {
            width: 180px;
            height: 180px;
            opacity: 0.5;
            background: radial-gradient(circle, rgba(212, 165, 116, 0.45) 0%, rgba(212, 165, 116, 0.2) 40%, transparent 70%);
        }

        #main-content.modal-active {
            opacity: 0.3;
            transform: scale(0.98);
            pointer-events: none;
            transition: all 0.6s cubic-bezier(0.22, 1, 0.36, 1);
        }
        #main-content {
            transition: all 0.6s cubic-bezier(0.22, 1, 0.36, 1);
            will-change: transform, opacity;
        }
        
        /* Hide Custom Cursor on Mobile/Touch */
        @media (max-width: 1024px) {
            #cursor-dot, #cursor-glow-outer {
                display: none !important;
            }
            html, body, * {
                cursor: auto !important;
            }
            html, body {
                overflow-x: hidden !important;
                width: 100%;
                position: relative;
            }
        }
        
        /* Premium Overlay for when modal is active */
        #modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 105;
            background: radial-gradient(circle at center, transparent 0%, rgba(0,0,0,0.8) 100%);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.6s ease;
        }
        #modal-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        /* Dropdown Styling */
        select option { background-color: #1a0f11 !important; color: #ffffff !important; }
        select:focus option { background-color: #1a0f11 !important; }
    </style>
</head>
<body class="antialiased opacity-0 transition-opacity duration-700 overflow-x-hidden" id="main-body">
    <!-- Figma AI Cursor Elements -->
    <div id="cursor-dot"></div>
    <div id="cursor-glow-outer"></div>

    <!-- Texture & Mesh -->
    <div class="fixed inset-0 pointer-events-none -z-10 opacity-[0.4]" 
         style="background-image: url('data:image/svg+xml,%3Csvg viewBox=\'0 0 200 200\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cfilter id=\'noiseFilter\'%3E%3CfeTurbulence type=\'fractalNoise\' baseFrequency=\'0.65\' numOctaves=\'3\' stitchTiles=\'stitch\'/%3E%3C/filter%3E%3Crect width=\'100%25\' height=\'100%25\' filter=\'url(%23noiseFilter)\'/%3E%3C/svg%3E');">
    </div>
    <div class="fixed inset-0 pointer-events-none -z-10 bg-luxury-mesh"></div>

    <div id="main-content">
        <!-- HEADER / NAV -->
        @include('frontend.partials.navbar')

        <!-- MAIN CONTENT -->
        @yield('content')

        <!-- FOOTER -->
        @include('frontend.partials.footer')
    </div>

    <div id="modal-overlay"></div>

    <!-- MODAL STACK -->
    @stack('modals')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const body = document.getElementById('main-body');
            body.classList.remove('opacity-0');
            
            const dot = document.getElementById('cursor-dot');
            const glow = document.getElementById('cursor-glow-outer');
            
            let mouseX = 0;
            let mouseY = 0;
            let currentGlowX = 0;
            let currentGlowY = 0;
            let lastUpdate = 0;

            // Direct CSS Drive for the dot (Zero Latency)
            document.addEventListener('mousemove', (e) => {
                mouseX = e.clientX;
                mouseY = e.clientY;
                
                // Set custom variables for immediate CSS response
                let offsetX = -4;
                let offsetY = -4;

                if (body.classList.contains('cursor-text')) {
                    offsetX = -15; offsetY = -15;
                } else if (body.classList.contains('cursor-zoom')) {
                    offsetX = -24; offsetY = -24;
                } else if (body.classList.contains('cursor-pointer')) {
                    offsetX = -20; offsetY = -10;
                }

                body.style.setProperty('--mouse-x', mouseX + offsetX);
                body.style.setProperty('--mouse-y', mouseY + offsetY);

                // Throttled target detection for performance
                const now = performance.now();
                if (now - lastUpdate > 100) {
                    lastUpdate = now;
                    const target = e.target;
                    const clickable = target.closest('a, button, .group, [role="button"], .cursor-zoom-trigger');
                    const isZoom = target.closest('.cursor-zoom-trigger');
                    const isText = !clickable && target.closest('p, h1, h2, h3, h4, span');

                    body.classList.remove('cursor-pointer', 'cursor-hover', 'cursor-text', 'cursor-zoom');
                    
                    if (isZoom) {
                        body.classList.add('cursor-zoom', 'cursor-hover');
                    } else if (clickable) {
                        body.classList.add('cursor-pointer', 'cursor-hover');
                    } else if (isText && target.innerText.trim().length > 0) {
                        body.classList.add('cursor-text');
                    }
                }
            }, { passive: true });

            document.addEventListener('mousedown', () => body.classList.add('is-clicking'));
            document.addEventListener('mouseup', () => body.classList.remove('is-clicking'));

            const animateGlow = () => {
                const lerpFactor = 0.12;
                currentGlowX += (mouseX - currentGlowX) * lerpFactor;
                currentGlowY += (mouseY - currentGlowY) * lerpFactor;

                body.style.setProperty('--glow-x', currentGlowX);
                body.style.setProperty('--glow-y', currentGlowY);

                requestAnimationFrame(animateGlow);
            };
            animateGlow();

            const nav = document.getElementById('main-nav');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    nav?.classList.add('scrolled');
                } else {
                    nav?.classList.remove('scrolled');
                }
            }, { passive: true });

            // Optimized Scroll Reveal with IntersectionObserver
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        revealObserver.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.reveal-up').forEach(el => revealObserver.observe(el));
            // FAQ Accordion Logic
            document.querySelectorAll('.faq-trigger').forEach(trigger => {
                trigger.addEventListener('click', () => {
                    const item = trigger.closest('.faq-item');
                    const content = item.querySelector('.faq-content');
                    const icon = item.querySelector('.faq-icon');
                    
                    // Close others
                    document.querySelectorAll('.faq-item').forEach(otherItem => {
                        if (otherItem !== item) {
                            const otherContent = otherItem.querySelector('.faq-content');
                            otherContent.style.maxHeight = null;
                            otherContent.classList.add('opacity-0');
                            otherItem.querySelector('.faq-icon').style.transform = 'rotate(0deg)';
                        }
                    });

                    // Toggle current
                    if (content.style.maxHeight) {
                        content.style.maxHeight = null;
                        content.classList.add('opacity-0');
                        icon.style.transform = 'rotate(0deg)';
                    } else {
                        content.style.maxHeight = content.scrollHeight + "px";
                        content.classList.remove('opacity-0');
                        icon.style.transform = 'rotate(45deg)';
                    }
                });
            });

            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });

        // Fallback for icons
        window.onload = () => {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        };
    </script>
    @stack('scripts')
</body>
</html>

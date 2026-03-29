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
            /* White Mac Pointer */
            background-image: url("{{ asset('images/pointer_mac.svg') }}");
            will-change: transform;
            top: 0;
            left: 0;
        }
        #cursor-glow-outer {
            width: 70px;
            height: 70px;
            background: radial-gradient(circle, #d4a574 0%, transparent 70%);
            filter: blur(20px);
            border-radius: 50%;
            position: fixed;
            pointer-events: none;
            z-index: 9999;
            opacity: 0.3;
            will-change: transform;
            top: 0;
            left: 0;
        }

        /* Cursor States */
        body.cursor-pointer #cursor-dot {
            /* Mac Hand Icon */
            background-image: url("{{ asset('images/hand.svg') }}");
            width: 52px;
            height: 52px;
        }
        body.cursor-text #cursor-dot {
            /* Mac I-Beam Icon */
            background-image: url("{{ asset('images/ibeam_mac.svg') }}");
            width: 30px;
            height: 30px;
        }

        .cursor-hover #cursor-glow-outer {
            width: 100px;
            height: 100px;
            opacity: 0.6;
            filter: blur(25px);
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
            let dotX = 0;
            let dotY = 0;
            let glowX = 0;
            let glowY = 0;

            let lastTarget = null;
            document.addEventListener('mousemove', (e) => {
                mouseX = e.clientX;
                mouseY = e.clientY;
                
                // Only check intersection if target changes for performance
                if (e.target !== lastTarget) {
                    lastTarget = e.target;
                    const isClickable = lastTarget.closest('a, button, .group, [role="button"]');
                    const isText = lastTarget.closest('p, h1, h2, h3, h4, span, div:not(:has(*))');

                    if (isClickable) {
                        body.classList.add('cursor-pointer', 'cursor-hover');
                        body.classList.remove('cursor-text');
                    } else if (isText && lastTarget.innerText.trim().length > 0) {
                        body.classList.add('cursor-text');
                        body.classList.remove('cursor-pointer', 'cursor-hover');
                    } else {
                        body.classList.remove('cursor-pointer', 'cursor-hover', 'cursor-text');
                    }
                }
            }, { passive: true });

            document.addEventListener('mousedown', () => body.classList.add('is-clicking'));
            document.addEventListener('mouseup', () => body.classList.remove('is-clicking'));

            const animateCursor = () => {
                const dotSpeed = 0.35; 
                const glowSpeed = 0.12;

                dotX += (mouseX - dotX) * dotSpeed;
                dotY += (mouseY - dotY) * dotSpeed;
                glowX += (mouseX - glowX) * glowSpeed;
                glowY += (mouseY - glowY) * glowSpeed;

                if(dot) {
                    let offsetX = -4;
                    let offsetY = -4;
                    let origin = '0 0'; // Default tip for pointer
                    let scaleValue = body.classList.contains('is-clicking') ? 0.85 : 1;

                    if (body.classList.contains('cursor-text')) {
                        offsetX = -15; 
                        offsetY = -15;
                        origin = '50% 50%';
                    } else if (body.classList.contains('cursor-pointer')) {
                        offsetX = -20; 
                        offsetY = -10;
                        origin = '50% 50%'; // Hand centers better
                    }

                    dot.style.transformOrigin = origin;
                    dot.style.transform = `translate3d(${dotX + offsetX}px, ${dotY + offsetY}px, 0) scale(${scaleValue})`;
                }
                
                if(glow) {
                    glow.style.transform = `translate3d(${glowX - 35}px, ${glowY - 35}px, 0) rotate(${(glowX + glowY) * 0.1}deg)`;
                }

                requestAnimationFrame(animateCursor);
            };
            animateCursor();

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

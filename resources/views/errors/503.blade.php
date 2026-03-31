<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Upgrade | HA Tech</title>
    
    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Inter"', 'sans-serif'], display: ['"Montserrat"', 'sans-serif'] },
                    colors: { primary: '#d4a574', background: '#0a0506' }
                }
            }
        }
    </script>
    
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body { 
            background-color: #0a0506; 
            color: #fff; 
            font-family: 'Inter', sans-serif; 
            margin: 0; 
            overflow: hidden; 
        }
        .luxury-mesh {
            background: radial-gradient(circle at 15% 15%, rgba(59, 0, 0, 0.4) 0%, transparent 60%),
                        radial-gradient(circle at 85% 85%, rgba(212, 165, 116, 0.08) 0%, transparent 60%),
                        #0a0506;
            position: fixed;
            inset: 0;
            z-index: -1;
        }
        .noise {
            background-image: url('data:image/svg+xml,%3Csvg viewBox=\'0 0 200 200\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cfilter id=\'noiseFilter\'%3E%3CfeTurbulence type=\'fractalNoise\' baseFrequency=\'0.65\' numOctaves=\'3\' stitchTiles=\'stitch\'/%3E%3C/filter%3E%3Crect width=\'100%25\' height=\'100%25\' filter=\'url(%23noiseFilter)\'/%3E%3C/svg%3E');
            opacity: 0.15;
            position: fixed;
            inset: 0;
            z-index: -2;
            pointer-events: none;
        }
        .glow-sphere {
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(212, 165, 116, 0.05) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(80px);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
            animation: breathe 8s ease-in-out infinite;
        }
        @keyframes breathe {
            0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.5; }
            50% { transform: translate(-50%, -50%) scale(1.1); opacity: 0.8; }
        }
        .glitch-text {
            text-shadow: 0 0 20px rgba(212, 165, 116, 0.3);
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen relative">
    <div class="luxury-mesh"></div>
    <div class="noise"></div>
    <div class="glow-sphere"></div>

    <div class="text-center px-6 relative z-10 w-full max-w-[90%] md:max-w-2xl bg-white/[0.01] border border-white/[0.05] p-10 md:p-24 rounded-[4rem] backdrop-blur-3xl shadow-2xl overflow-hidden group">
        <!-- Floating Accent -->
        <div class="absolute -top-10 -right-10 w-24 h-24 md:w-40 md:h-40 bg-primary/10 blur-[40px] md:blur-[60px] rounded-full group-hover:scale-150 transition-transform duration-1000"></div>
        <div class="absolute -bottom-10 -left-10 w-24 h-24 md:w-40 md:h-40 bg-primary/5 blur-[40px] md:blur-[60px] rounded-full group-hover:scale-150 transition-transform duration-1000"></div>

        <!-- Logo -->
        <div class="mb-10 md:mb-12 flex justify-center animate-bounce-slow">
            <div class="w-16 h-16 md:w-24 md:h-24 rounded-full border-2 border-primary/20 p-2 relative">
                <div class="absolute inset-0 rounded-full border border-primary/40 animate-ping opacity-20"></div>
                <img src="{{ asset('logo.png') }}" alt="Logo" class="w-full h-full object-contain rounded-full">
            </div>
        </div>

        <!-- Status -->
        <div class="flex items-center justify-center gap-3 mb-6">
            <span class="w-1.5 h-1.5 md:w-2 md:h-2 rounded-full bg-primary animate-pulse"></span>
            <span class="text-[8px] md:text-[10px] font-black uppercase tracking-[0.4em] md:tracking-[0.5em] text-primary">System Upgrade in Progress</span>
        </div>

        <!-- Heading -->
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-display font-black leading-[0.95] md:leading-[0.9] tracking-tighter mb-8 glitch-text uppercase">
            Perfecting <br>the <span class="bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Future.</span>
        </h1>

        <!-- Subtext -->
        <p class="text-gray-400 text-sm md:text-lg lg:text-xl font-medium leading-relaxed max-w-lg mx-auto mb-12 md:mb-16 px-4">
            We're currently enhancing our ecosystem to deliver a more powerful digital experience. We'll be back online in just a few moments.
        </p>

        <!-- Connectivity -->
        <div class="flex flex-col md:flex-row items-center justify-center gap-6 md:gap-8 mb-4">
            <a href="#" class="flex items-center gap-4 text-gray-500 hover:text-white transition-all group">
                <i data-lucide="instagram" class="w-4 h-4 md:w-5 md:h-5 group-hover:scale-110 transition-transform"></i>
                <span class="text-[9px] md:text-[10px] font-bold uppercase tracking-widest group-hover:tracking-[0.2em] transition-all">Instagram</span>
            </a>
            <div class="hidden md:block w-px h-4 bg-white/10"></div>
            <a href="#" class="flex items-center gap-4 text-gray-500 hover:text-white transition-all group">
                <i data-lucide="linkedin" class="w-4 h-4 md:w-5 md:h-5 group-hover:scale-110 transition-transform"></i>
                <span class="text-[9px] md:text-[10px] font-bold uppercase tracking-widest group-hover:tracking-[0.2em] transition-all">LinkedIn</span>
            </a>
        </div>
        
        <p class="text-[8px] md:text-[9px] text-gray-700 font-bold uppercase tracking-[0.25em] mt-10 md:mt-12">ESTIMATED RESTORATION: [ SHORTLY ]</p>
    </div>

    <!-- Background Decoration -->
    <div class="absolute bottom-12 left-1/2 -translate-x-1/2 text-[15vw] font-black text-white/[0.02] uppercase pointer-events-none select-none tracking-tighter mix-blend-overlay">
        HA TECH
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 | System Calibration - HA Tech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #050505; color: #fff; }
        .secure-gradient { background: radial-gradient(circle at center, #1a1a05 0%, #050505 100%); }
    </style>
</head>
<body class="secure-gradient min-h-screen flex items-center justify-center p-6 text-center">
    <div>
        <h1 class="text-[12rem] font-black leading-none tracking-tighter text-white/5 select-none absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
            500
        </h1>
        
        <div class="relative z-10">
            <div class="text-[#d4a574] text-sm uppercase tracking-[0.5em] mb-4 font-bold">Internal Calibration</div>
            <h2 class="text-4xl md:text-6xl font-extrabold mb-8 tracking-tighter uppercase">STABILITY <br> <span class="text-[#d4a574]">UNDER MAINTENANCE</span></h2>
            <p class="text-gray-400 max-w-lg mx-auto mb-10 text-sm md:text-base leading-relaxed font-bold italic">
                HA Tech is currently fixing this and hardware recalibration is in progress. <br>
                Please maintain patience while we optimize your experience.
            </p>
            <div class="flex items-center justify-center gap-2">
                <div class="w-3 h-3 bg-[#d4a574] rounded-full animate-ping"></div>
                <div class="text-xs uppercase tracking-[0.3em] text-[#d4a574]">Fixing in progress...</div>
            </div>
        </div>
        
        <div class="mt-20 text-[10px] text-gray-800 uppercase tracking-widest">
            &copy; {{ date('Y') }} HA TECH SYSTEMS
        </div>
    </div>
</body>
</html>

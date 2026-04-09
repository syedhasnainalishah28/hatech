<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Access | HA Tech Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #050505; color: #fff; }
        .secure-gradient { background: radial-gradient(circle at center, #3B0000 0%, #050505 100%); }
    </style>
</head>
<body class="secure-gradient min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold tracking-tighter mb-2">
                HA TECH <span class="text-[#d4a574]">SECURE PORTAL</span>
            </h1>
            <p class="text-gray-500 text-sm uppercase tracking-widest">Administrative Authorization Required</p>
        </div>

        <div class="bg-white/5 border border-white/10 backdrop-blur-xl rounded-3xl p-8 shadow-2xl">
            <form action="{{ route('admin.login') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Admin Identifier</label>
                    <input type="email" name="email" required 
                        class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-[#d4a574] focus:ring-1 focus:ring-[#d4a574] transition-all outline-none"
                        placeholder="admin@hatechservices.com.pk">
                    @error('email') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Access Key</label>
                    <input type="password" name="password" required 
                        class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-[#d4a574] focus:ring-1 focus:ring-[#d4a574] transition-all outline-none"
                        placeholder="••••••••••••••••">
                </div>

                <button type="submit" 
                    class="w-full bg-[#d4a574] hover:bg-[#b88c5a] text-black font-black py-4 rounded-xl transition-all uppercase tracking-widest text-sm">
                    Initiate Authorization
                </button>
            </form>
        </div>

        <p class="text-center text-gray-600 text-xs mt-8">
            Unauthorized access attempts are logged and reported. <br>
            Tracking ID: {{ substr(md5(request()->ip()), 0, 8) }}
        </p>
    </div>
</body>
</html>

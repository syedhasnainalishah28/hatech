<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identity Verification | HA Tech Portal</title>
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
            <h1 class="text-3xl font-extrabold tracking-tighter mb-2 uppercase text-[#d4a574]">
                Identity Verification
            </h1>
            <p class="text-gray-500 text-sm tracking-widest px-8">We've sent a 6-digit verification code to your administrative email.</p>
        </div>

        <div class="bg-white/5 border border-white/10 backdrop-blur-xl rounded-3xl p-8 shadow-2xl text-center">
            <form action="{{ route('admin.2fa') }}" method="POST" class="space-y-8">
                @csrf
                <div>
                    <input type="text" name="code" required maxlength="6"
                        class="w-full bg-black/40 border-b-2 border-white/10 text-center text-4xl font-bold py-4 text-[#d4a574] focus:border-[#d4a574] transition-all outline-none tracking-[0.5em]"
                        placeholder="••••••" autofocus autocomplete="one-time-code">
                    @error('code') <p class="text-red-500 text-xs mt-4">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-4">
                    <button type="submit" 
                        class="w-full bg-[#d4a574] hover:bg-[#b88c5a] text-black font-black py-4 rounded-xl transition-all uppercase tracking-widest text-sm">
                        Verify Identity
                    </button>
                    <a href="{{ route('admin.login') }}" class="block text-gray-500 hover:text-white text-xs uppercase tracking-widest transition-colors font-bold">
                        Back to Login
                    </a>
                </div>
            </form>
        </div>

        <div class="mt-12 flex items-center justify-center gap-4 text-gray-700">
            <div class="h-[1px] w-8 bg-gray-800"></div>
            <span class="text-[10px] uppercase tracking-[0.3em]">Secure Tunnel 256-Bit AES</span>
            <div class="h-[1px] w-8 bg-gray-800"></div>
        </div>
    </div>
</body>
</html>

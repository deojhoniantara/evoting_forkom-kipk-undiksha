<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Voting Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4576D3',
                        accent: '#4DCEC6',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 via-cyan-50 to-primary font-sans">
    <div class="container mx-auto px-4 min-h-screen flex flex-col">
        <!-- Header -->
        <div class="text-center pt-16 pb-8">
            <h1 class="text-5xl font-bold text-primary mb-2">E-Voting</h1>
            <p class="text-gray-600 text-lg">Sistem Pemilihan Online</p>
        </div>

        <!-- Main Content -->
        <div class="flex-grow flex flex-col lg:flex-row items-center justify-center -mt-20">
            <!-- Title Kiri -->
            <div class="flex-1 flex flex-col justify-center items-start mb-12 lg:mb-0 lg:mr-0 max-w-3xl w-full px-44">
                <h2 class="text-4xl font-bold text-primary mb-1">Pemilihan Ketua Umum</h2>
                <h3 class="text-3xl font-bold text-gray-700 mb-1">Forum Komunikasi KIP Kuliah Undiksha</h3>
                <h4 class="text-2lg text-gray-600">Masa Bhakti 2025/2026</h4>
            </div>

            <!-- Form Card Kanan -->
            <div class="flex-1 flex flex-col items-center justify-center w-full">
                <div class="bg-white rounded-3xl shadow-xl max-w-md w-full pb-8 pt-0">
                    <!-- Card Header -->
                    <div class="bg-primary rounded-t-3xl px-8 py-5 text-center">
                        <h2 class="text-2xl font-bold text-white">Masukkan Kode Voting</h2>
                    </div>
                    <form action="{{ route('verify.code') }}" method="POST" class="space-y-6 px-8 pt-8">
                        @csrf
                        <div>
                            <label for="voting_code" class="block text-base font-medium text-gray-700 mb-2">Kode Voting</label>
                            <input type="text" 
                                   name="voting_code" 
                                   id="voting_code" 
                                   maxlength="6"
                                   class="w-full px-6 py-4 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition duration-200 bg-white text-center text-xl font-bold tracking-widest text-gray-400 placeholder-gray-400 uppercase shadow-sm"
                                   placeholder="MASUKKAN KODE"
                                   required>
                        </div>
                        <button type="submit" 
                                class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-4 rounded-2xl transition duration-200 flex items-center justify-center gap-2 text-lg shadow-md">
                            Lanjutkan ke Voting
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                        </button>
                        @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="text-center py-6">
            <p class="text-sm text-gray-600">
                © 2025 <a href="{{ route('login') }}" class="hover:text-primary transition duration-200">E - Voting System. Forkom KIP-K Undiksha</a>
            </p>
        </footer>
    </div>

    <script>
        // Auto uppercase for voting code input
        document.getElementById('voting_code').addEventListener('input', function(e) {
            this.value = this.value.toUpperCase();
        });
    </script>
</body>
</html>

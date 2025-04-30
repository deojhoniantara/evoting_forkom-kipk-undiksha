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
    <style>
        .gradient-background {
            background: linear-gradient(135deg, #4576D3 0%, #4DCEC6 100%);
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 via-cyan-50 to-primary font-sans">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="w-full py-8 sm:py-12 px-4">
            <div class="max-w-lg mx-auto text-center space-y-2">
                <h1 class="text-4xl sm:text-5xl font-bold text-primary">
                    E-Voting
                </h1>
                <p class="text-lg sm:text-xl text-gray-600">Sistem Pemilihan Online</p>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow flex items-center justify-center px-4 pb-8">
            <div class="w-full max-w-4xl mx-auto flex flex-col lg:flex-row items-center gap-8 lg:gap-12">
                <!-- Left Section - Title -->
                <div class="w-full lg:w-1/2 text-center lg:text-left space-y-3">
                    <h2 class="text-2xl sm:text-3xl font-bold text-primary">
                        Pemilihan Ketua Umum
                    </h2>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-700">
                        Forum Komunikasi<br>KIP Kuliah Undiksha
                    </h3>
                    <p class="text-lg text-gray-600">
                        Masa Bhakti 2025/2026
                    </p>
                </div>

                <!-- Right Section - Form Card -->
                <div class="w-full lg:w-1/2 max-w-md">
                    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                        <!-- Card Header -->
                        <div class="gradient-background px-6 py-6 text-center">
                            <h2 class="text-xl sm:text-2xl font-bold text-white">
                                Masukkan Kode Voting
                            </h2>
                        </div>

                        <!-- Form -->
                        <div class="p-6 sm:p-8">
                            <form action="{{ route('verify.code') }}" method="POST" class="space-y-6">
                                @csrf
                                <div class="space-y-3">
                                    <label for="voting_code" class="block text-sm font-medium text-gray-700">
                                        Kode Voting
                                    </label>
                                    <input type="text" 
                                           name="voting_code" 
                                           id="voting_code" 
                                           maxlength="6"
                                           class="w-full px-4 py-3 text-center text-xl font-bold tracking-wider text-gray-700 placeholder-gray-400 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition duration-200"
                                           placeholder="MASUKKAN KODE"
                                           required>
                                </div>

                                <button type="submit" 
                                        class="w-full flex items-center justify-center gap-2 px-6 py-3 text-base font-semibold text-white bg-primary hover:bg-primary/90 rounded-xl transition duration-200 shadow-lg hover:shadow-xl">
                                    Lanjutkan ke Voting
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </button>

                                @if(session('error'))
                                <div class="mt-4 p-4 rounded-lg bg-red-50 border border-red-200">
                                    <p class="text-sm text-red-600">
                                        {{ session('error') }}
                                    </p>
                                </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="py-6 px-4 text-center">
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

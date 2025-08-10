<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Dashboard V2 - Dokumentasi Sertifikasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-teal: #0f766e;
            --primary-teal-dark: #134e4a;
            --primary-teal-light: #5eead4;
            --accent-coral: #f97316;
            --accent-purple: #7c3aed;
            --accent-emerald: #10b981;
            --accent-rose: #f43f5e;
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --text-primary: #ffffff;
            --text-secondary: #e2e8f0;
            --card-bg: rgba(255, 255, 255, 0.95);
            --card-text: #1e293b;
        }

        [data-theme="dark"] {
            --glass-bg: rgba(0, 0, 0, 0.3);
            --glass-border: rgba(255, 255, 255, 0.1);
            --text-primary: #ffffff;
            --text-secondary: #cbd5e1;
            --card-bg: rgba(30, 41, 59, 0.9);
            --card-text: #f1f5f9;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, var(--primary-teal) 0%, var(--primary-teal-dark) 50%, #0d9488 100%);
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        .glass-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        .slide-up {
            animation: slideUp 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .theme-toggle {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            transition: all 0.3s ease;
        }

        .theme-toggle:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .text-theme {
            color: var(--card-text);
        }

        .bg-theme {
            background: var(--card-bg);
        }

        .table-header {
            background: var(--card-bg);
            color: var(--card-text);
        }

        .table-row {
            background: var(--card-bg);
            color: var(--card-text);
            transition: all 0.2s ease;
        }

        .table-row:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-1px);
        }

        .filter-card {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
        }
    </style>
</head>

<body class="min-h-screen">
    <!-- Header -->
    <header class="glass-card border-0 border-b border-white/20 px-6 py-4 fade-in">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="{{ route('dashboard.v2') }}"
                    class="flex items-center space-x-2 text-white hover:text-white/80 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                    <span>Kembali ke Dashboard V2</span>
                </a>
                <div class="h-6 w-px bg-white/30"></div>
                <h1 class="text-xl font-semibold text-white">📋 Detail Dokumen</h1>
            </div>
            <div class="flex items-center space-x-4">
                <!-- Theme Toggle -->
                <button onclick="toggleTheme()"
                    class="theme-toggle p-2 rounded-lg text-white hover:text-white/80 transition-all">
                    <svg id="theme-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                </button>
                <div class="h-6 w-px bg-white/30"></div>
                <span class="text-white/80">{{ auth()->user()->name ?? 'User' }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 bg-red-500/80 text-white text-sm rounded-lg hover:bg-red-500 transition-all backdrop-blur-sm">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-6 py-8">
        <!-- Filter Info -->
        @if (!empty($filterInfo))
            <div class="filter-card rounded-xl p-6 mb-8 slide-up">
                <h3 class="text-lg font-semibold text-white mb-4">🔍 Filter Aktif</h3>
                <div class="flex flex-wrap gap-3">
                    @foreach ($filterInfo as $key => $value)
                        <span
                            class="px-4 py-2 bg-white/20 text-white rounded-full text-sm backdrop-blur-sm border border-white/30">
                            {{ ucwords(str_replace('_', ' ', $key)) }}: <strong>{{ $value }}</strong>
                        </span>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Data Table -->
        <div class="glass-card rounded-xl overflow-hidden slide-up" style="animation-delay: 0.2s;">
            <div class="px-6 py-4 border-b border-white/10">
                <h3 class="text-xl font-semibold text-theme flex items-center">
                    📊 Data Dokumen
                    <span class="ml-2 px-3 py-1 bg-blue-500/20 text-blue-300 rounded-full text-sm">
                        {{ $dokumenDetail->total() }} total
                    </span>
                </h3>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="table-header border-b border-white/10">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-theme uppercase tracking-wider">No
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-theme uppercase tracking-wider">
                                NIA</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-theme uppercase tracking-wider">
                                Entitas</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-theme uppercase tracking-wider">
                                Regional</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-theme uppercase tracking-wider">
                                Kebun</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-theme uppercase tracking-wider">
                                Posisi</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-theme uppercase tracking-wider">
                                Status Dokumen</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-theme uppercase tracking-wider">
                                Luas Permohonan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-theme uppercase tracking-wider">
                                Tanggal Pemberitahuan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        @forelse($dokumenDetail as $index => $dokumen)
                            <tr class="table-row">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-theme">
                                    {{ $dokumenDetail->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-theme">
                                    {{ $dokumen->NIA ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-theme">
                                    {{ $dokumen->Entitas ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-theme">
                                    {{ $dokumen->Regional ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-theme">
                                    {{ $dokumen->Kebun ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-theme">
                                    <span
                                        class="px-3 py-1 text-xs font-medium bg-blue-500/20 text-blue-300 rounded-full border border-blue-400/30">
                                        {{ ucwords(str_replace('_', ' ', $dokumen->posisi ?? '-')) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-theme">
                                    @php
                                        $statusClass = 'bg-gray-500/20 text-gray-300 border-gray-400/30';
                                        if (str_contains(strtolower($dokumen->status_dokumen ?? ''), 'clear')) {
                                            $statusClass = 'bg-green-500/20 text-green-300 border-green-400/30';
                                        } elseif (str_contains(strtolower($dokumen->status_dokumen ?? ''), 'uncler')) {
                                            $statusClass = 'bg-red-500/20 text-red-300 border-red-400/30';
                                        } elseif (str_contains(strtolower($dokumen->status_dokumen ?? ''), 'telaah')) {
                                            $statusClass = 'bg-yellow-500/20 text-yellow-300 border-yellow-400/30';
                                        }
                                    @endphp
                                    <span
                                        class="px-3 py-1 text-xs font-medium {{ $statusClass }} rounded-full border">
                                        {{ $dokumen->status_dokumen ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-theme font-medium">
                                    {{ number_format($dokumen->Luas_permohonan ?? 0, 2) }} Ha
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-theme">
                                    {{ $dokumen->tanggal_pemberitahuan ? \Carbon\Carbon::parse($dokumen->tanggal_pemberitahuan)->format('d/m/Y') : '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-8 text-center text-theme/70">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-theme/40 mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        <p class="text-lg font-medium">Tidak ada data yang ditemukan</p>
                                        <p class="text-sm">Coba ubah filter atau kriteria pencarian</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($dokumenDetail->hasPages())
                <div class="px-6 py-4 border-t border-white/10">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-theme/70">
                            Menampilkan {{ $dokumenDetail->firstItem() }} - {{ $dokumenDetail->lastItem() }}
                            dari {{ $dokumenDetail->total() }} hasil
                        </div>
                        <div class="pagination-wrapper">
                            {{ $dokumenDetail->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Theme Toggle Function
        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);

            // Update icon
            const icon = document.getElementById('theme-icon');
            if (newTheme === 'dark') {
                icon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>';
            } else {
                icon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>';
            }
        }

        // Initialize theme
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);

        // Update icon based on saved theme
        const icon = document.getElementById('theme-icon');
        if (savedTheme === 'dark') {
            icon.innerHTML =
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>';
        }
    </script>
</body>

</html>

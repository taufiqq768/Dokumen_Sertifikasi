<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Dokumen - Dashboard Dokumentasi Sertifikasi</title>
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

        .scale-in {
            animation: scaleIn 0.5s ease-out;
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

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
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

        .gradient-text {
            background: linear-gradient(135deg, var(--primary-teal-light), var(--accent-coral));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .text-theme {
            color: var(--card-text);
        }

        .bg-theme {
            background: var(--card-bg);
        }

        .table-row {
            transition: all 0.3s ease;
        }

        .table-row:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: scale(1.01);
        }

        .badge {
            background: linear-gradient(135deg, var(--accent-emerald), #22c55e);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .badge:hover {
            transform: scale(1.05);
        }

        .badge-blue {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        }

        .badge-purple {
            background: linear-gradient(135deg, var(--accent-purple), #5b21b6);
        }

        .filter-badge {
            background: linear-gradient(135deg, var(--accent-coral), #ea580c);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .filter-badge:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body class="min-h-screen">
    <!-- Theme Toggle Button -->
    <div class="fixed top-4 right-4 z-50">
        <button onclick="toggleTheme()"
            class="theme-toggle p-3 rounded-full text-white hover:scale-110 transition-all duration-300">
            <svg id="theme-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                </path>
            </svg>
        </button>
    </div>

    <div class="container mx-auto px-4 py-8">
        <!-- Header dengan tombol kembali -->
        <div class="flex items-center justify-between mb-8 fade-in">
            <div>
                <h1 class="text-4xl font-bold text-white mb-2">📄 Detail Dokumen</h1>
                @if (!empty($filterInfo))
                    <div class="mt-4 text-sm">
                        <span class="font-medium text-white/80 mb-2 block">Filter yang diterapkan:</span>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($filterInfo as $key => $value)
                                <span class="filter-badge">
                                    {{ ucwords(str_replace('_', ' ', $key)) }}: {{ $value }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <a href="{{ route('dashboard') }}"
                class="glass-card px-6 py-3 rounded-xl text-theme hover:scale-105 transition-all duration-300 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>

        <!-- Informasi Total -->
        <div class="glass-card rounded-xl p-6 mb-6 slide-up">
            <div class="flex items-center">
                <div class="bg-gradient-to-r from-orange-500 to-purple-600 text-white rounded-xl p-4 mr-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-theme">Total Dokumen Ditemukan</h3>
                    <p class="text-3xl font-bold gradient-text">{{ number_format($dokumenDetail->total()) }}</p>
                </div>
            </div>
        </div>

        <!-- Tabel Detail Dokumen -->
        <div class="glass-card rounded-xl overflow-hidden slide-up" style="animation-delay: 0.2s;">
            <div class="px-6 py-4 border-b border-white/10">
                <h3 class="text-lg font-semibold text-theme">📊 Data Detail Dokumen</h3>
            </div>

            @if ($dokumenDetail->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gradient-to-r from-teal-600/20 to-teal-700/20">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-theme uppercase tracking-wider">
                                    No</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-theme uppercase tracking-wider">
                                    NIA</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-theme uppercase tracking-wider">
                                    Entitas</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-theme uppercase tracking-wider">
                                    Regional</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-theme uppercase tracking-wider">
                                    Kebun</th>
                                {{-- <th class="px-6 py-4 text-left text-xs font-medium text-theme uppercase tracking-wider">Provinsi</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-theme uppercase tracking-wider">Kabupaten</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-theme uppercase tracking-wider">Kecamatan</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-theme uppercase tracking-wider">Desa</th> --}}
                                <th class="px-6 py-4 text-left text-xs font-medium text-theme uppercase tracking-wider">
                                    Luas Areal</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-theme uppercase tracking-wider">
                                    Posisi</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-theme uppercase tracking-wider">
                                    Jenis Hak</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-theme uppercase tracking-wider">
                                    Jenis Permohonan</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-theme uppercase tracking-wider">
                                    Keterangan</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-theme uppercase tracking-wider">
                                    Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/10">
                            @foreach ($dokumenDetail as $index => $dokumen)
                                <tr class="table-row">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-theme font-medium">
                                        {{ ($dokumenDetail->currentPage() - 1) * $dokumenDetail->perPage() + $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-theme">
                                        {{ $dokumen->NIA ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-theme font-medium">
                                        {{ $dokumen->Entitas ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-theme">
                                        {{ $dokumen->Regional ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-theme">
                                        {{ $dokumen->Kebun ?? '-' }}
                                    </td>
                                    {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-theme">
                                        {{ $dokumen->Provinsi ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-theme">
                                        {{ $dokumen->Kabupaten ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-theme">
                                        {{ $dokumen->Kecamatan ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-theme">
                                        {{ $dokumen->Desa ?? '-' }}
                                    </td> --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-theme">
                                        {{ $dokumen->Luas_areal ? number_format($dokumen->Luas_areal, 2) . ' Ha' : '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="badge badge-blue">
                                            {{ ucwords(str_replace('_', ' ', $dokumen->posisi ?? '-')) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="badge">
                                            {{ $dokumen->jenis_hak ?? 'Tidak Diketahui' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="badge badge-purple">
                                            {{ $dokumen->jenis_permohonan ?? 'Tidak Diketahui' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-theme">
                                        <div class="max-w-sm max-h-32 overflow-auto">
                                            @if ($dokumen->keterangan)
                                                <div class="whitespace-pre-wrap break-words">{{ $dokumen->keterangan }}
                                                </div>
                                            @else
                                                <span class="text-theme/50 italic">-</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-theme">
                                        {{ $dokumen->created_at ? $dokumen->created_at->format('d/m/Y H:i') : '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-white/10">
                    {{ $dokumenDetail->appends(request()->query())->links() }}
                </div>
            @else
                <div class="px-6 py-12 text-center scale-in">
                    <div
                        class="bg-gradient-to-r from-gray-400 to-gray-500 text-white rounded-full p-4 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-theme mb-2">Tidak ada data ditemukan</h3>
                    <p class="text-sm text-theme/70">Tidak ada dokumen yang sesuai dengan filter yang dipilih.</p>
                    <p class="text-xs text-theme/50 mt-2">Coba ubah filter atau kembali ke dashboard untuk melihat semua
                        data.</p>
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

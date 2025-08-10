<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard V2 - Dokumentasi Sertifikasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        .chart-container {
            background: var(--card-bg);
            backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            transition: all 0.3s ease;
            height: 120px;
        }

        .chart-container:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.1);
        }

        .stat-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .stat-card:hover::before {
            left: 100%;
        }

        .stat-card:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.15);
        }

        .icon-gradient {
            background: linear-gradient(135deg, var(--accent-coral), var(--accent-purple));
        }

        .icon-gradient-green {
            background: linear-gradient(135deg, var(--accent-emerald), #22c55e);
        }

        .icon-gradient-red {
            background: linear-gradient(135deg, var(--accent-rose), #dc2626);
        }

        .text-theme {
            color: var(--card-text);
        }

        .bg-theme {
            background: var(--card-bg);
        }

        .progress-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .progress-card:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>

<body class="min-h-screen">
    <!-- Header with Theme Toggle and Logout -->
    <div class="fixed top-4 right-4 z-50 flex items-center space-x-3">
        <!-- User Info -->
        <div class="theme-toggle px-4 py-2 rounded-full text-white text-sm">
            <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
        </div>

        <!-- Theme Toggle Button -->
        <button onclick="toggleTheme()"
            class="theme-toggle p-3 rounded-full text-white hover:scale-110 transition-all duration-300">
            <svg id="theme-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                </path>
            </svg>
        </button>

        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit"
                class="theme-toggle p-3 rounded-full text-white hover:scale-110 hover:bg-red-500/20 transition-all duration-300"
                title="Logout">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                    </path>
                </svg>
            </button>
        </form>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="fade-in">
            <h1 class="text-4xl font-bold text-white mb-2 text-center">Dashboard Dokumentasi Sertifikasi</h1>
            <h3 class="text-2xl font-bold text-white mb-2 text-center">PT. PERKEBUNAN NUSANTARA</h3>
            <p class="text-center text-white/80 mb-8">Sistem Monitoring Dokumen Sertifikasi Lahan</p>
        </div>

        <!-- Bagian 1: Total Bidang Dimohon -->
        <div class="mb-8 slide-up">
            <h2 class="text-xl font-semibold text-white mb-4">📊 Total Bidang Dimohon</h2>
            <div class="glass-card rounded-xl p-6">
                <div class="flex items-center">
                    <div class="icon-gradient text-white rounded-xl p-4 mr-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-theme">Total Bidang Dimohon</h3>
                        <p class="text-3xl font-bold gradient-text">{{ number_format($totalBidangDimohon) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian 2: Progress Dokumen Berdasarkan Posisi -->
        <div class="mb-8 slide-up" style="animation-delay: 0.2s;">
            <h2 class="text-xl font-semibold text-white mb-4">📍 Progress Dokumen Berdasarkan Posisi</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
                @php
                    $gradients = [
                        'from-blue-500 to-blue-600',
                        'from-emerald-500 to-emerald-600',
                        'from-amber-500 to-amber-600',
                        'from-purple-500 to-purple-600',
                        'from-rose-500 to-rose-600',
                        'from-indigo-500 to-indigo-600',
                        'from-pink-500 to-pink-600',
                        'from-teal-500 to-teal-600',
                    ];
                @endphp

                @foreach ($posisiData as $index => $posisi)
                    @php
                        $gradient = $gradients[$index % count($gradients)];
                    @endphp
                    <a href="{{ route('dashboard.v2.detail', ['posisi_id' => $posisi->id]) }}"
                        class="stat-card block rounded-xl p-4 scale-in" style="animation-delay: {{ 0.1 * $index }}s;">
                        <div class="flex items-center gap-3">
                            <div class="bg-gradient-to-r {{ $gradient }} text-white rounded-lg p-2 flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex-1 overflow-hidden">
                                <h3
                                    class="text-sm font-semibold bg-gradient-to-r {{ $gradient }} bg-clip-text text-transparent mb-1 whitespace-nowrap overflow-hidden text-ellipsis">
                                    {{ ucwords(str_replace('_', ' ', $posisi->posisi)) }}
                                </h3>
                                <div class="flex items-center gap-1">
                                    <span
                                        class="text-4xl font-bold text-theme leading-none">{{ number_format($posisi->proses_dokumen_count) }}</span>
                                    <span class="text-4xl text-theme"> </span>
                                    <span class="text-xs text-theme/70">Bidang</span>

                                </div>
                                <p class="text-xs text-theme/70 mt-0.5">
                                    {{ number_format($posisi->total_luas_permohonan, 2) }} Ha.
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 slide-up" style="animation-delay: 0.4s;">
            <!-- Left Column -->
            <div class="space-y-6">
                <!-- Status Dokumen -->
                <div class="glass-card rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-theme mb-4">📋 Status Dokumen</h3>
                    <div class="space-y-3">
                        @foreach ($statusDokumen as $status)
                            @php
                                $bgColor = 'bg-red-500';
                                if (str_contains(strtolower($status->status_dokumen), 'clear')) {
                                    $bgColor = 'bg-green-500';
                                } elseif (str_contains(strtolower($status->status_dokumen), 'telaah')) {
                                    $bgColor = 'bg-yellow-500';
                                }
                            @endphp
                            <a href="{{ route('dashboard.v2.detail', ['status_dokumen' => $status->status_dokumen]) }}"
                                class="flex justify-between items-center p-3 {{ $bgColor }} text-white rounded-lg cursor-pointer hover:opacity-90 transition-all">
                                <span class="text-sm font-medium">{{ $status->status_dokumen }}</span>
                                <span class="font-bold">{{ number_format($status->total) }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Summary Highlight -->
                <div class="glass-card rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-theme mb-4">✨ Summary Highlight</h3>
                    <ul class="space-y-3 text-sm">

                        <li class="flex items-center">
                            <span class="w-3 h-3 bg-red-500 rounded-full mr-3"></span>
                            <span class="text-theme">
                                @php
                                    $totalUnclear = $statusDokumen
                                        ->filter(function ($item) {
                                            return str_contains(strtolower($item->status_dokumen), 'uncler');
                                        })
                                        ->sum('total');
                                @endphp
                                {{ number_format($totalUnclear) }} Tidak Clear
                            </span>
                        </li>
                        <li class="flex items-center">
                            <span class="w-3 h-3 bg-orange-500 rounded-full mr-3"></span>
                            <span class="text-theme">
                                @php
                                    $entitasUnclearTerbanyak = '';
                                    $maxUnclear = 0;
                                    foreach ($statusDokumenPerEntitas as $entitas => $statusData) {
                                        $unclearCount = $statusData
                                            ->filter(function ($item) {
                                                return str_contains(strtolower($item->status_dokumen), 'uncler');
                                            })
                                            ->sum('total');
                                        if ($unclearCount > $maxUnclear) {
                                            $maxUnclear = $unclearCount;
                                            $entitasUnclearTerbanyak = $entitas;
                                        }
                                    }
                                @endphp
                                Berkas Tidak Clear terbanyak di {{ $entitasUnclearTerbanyak ?: 'Tidak ada data' }}
                                ({{ number_format($maxUnclear) }} dokumen)
                            </span>
                        </li>
                        <li class="flex items-center">
                            <span class="w-3 h-3 bg-purple-500 rounded-full mr-3"></span>
                            <span class="text-theme">
                                @php
                                    $totalDurasiTerlambat = 0;
                                    foreach ($durasiDokumenUnclear as $entitas => $durasiData) {
                                        $totalDurasiTerlambat += $durasiData
                                            ->filter(function ($item) {
                                                return $item->durasi_hari > 7;
                                            })
                                            ->sum('total');
                                    }
                                @endphp
                                Pemenuhan dokumen unclear {{ number_format($totalDurasiTerlambat) }} lebih dari 1
                                minggu
                            </span>
                        </li>
                        <li class="flex items-center">
                            <span class="w-3 h-3 bg-gray-500 rounded-full mr-3"></span>
                            <span class="text-theme">
                                @php
                                    $totalBelumTelaah = $statusDokumen
                                        ->filter(function ($item) {
                                            return str_contains(strtolower($item->status_dokumen), 'telaah');
                                        })
                                        ->sum('total');
                                @endphp
                                {{ number_format($totalBelumTelaah) }} Belum telaah
                            </span>
                        </li>
                        <li class="flex items-center">
                            <span class="w-3 h-3 bg-green-500 rounded-full mr-3"></span>
                            <span class="text-theme">
                                @php
                                    $totalClear = $statusDokumen
                                        ->filter(function ($item) {
                                            return str_contains(strtolower($item->status_dokumen), 'clear');
                                        })
                                        ->sum('total');
                                @endphp
                                {{ number_format($totalClear) }} Sudah Clear
                            </span>
                        </li>
                    </ul>
                </div>

                <!-- Tingkat Durasi -->
                <div class="glass-card rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-theme mb-4">⏱️ Tingkat Durasi Pemenuhan</h3>
                    <div class="space-y-3">
                        @foreach ($tingkatDurasi as $durasi)
                            @php
                                $bgColor = 'bg-red-500';
                                if ($durasi->kategori_durasi == '< 1 bulan') {
                                    $bgColor = 'bg-red-500';
                                } elseif ($durasi->kategori_durasi == '1-3 bulan') {
                                    $bgColor = 'bg-yellow-500';
                                } else {
                                    $bgColor = 'bg-green-500';
                                }
                            @endphp
                            <div
                                class="flex justify-between items-center p-3 {{ $bgColor }} text-white rounded-lg">
                                <span class="text-sm font-medium">{{ $durasi->kategori_durasi }}</span>
                                <span class="font-bold">{{ number_format($durasi->total) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Column - Charts -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Status Dokumen per Entitas -->
                <div class="glass-card rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-theme mb-4">📊 Status Dokumen per Entitas</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($statusDokumenPerEntitas as $entitas => $statusData)
                            <div class="text-center">
                                <h4 class="text-sm font-medium text-theme mb-3">{{ $entitas }}</h4>
                                <div class="chart-container">
                                    <canvas id="chart-{{ $loop->index }}"></canvas>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Durasi pemenuhan dokumen unclear -->
                <div class="glass-card rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-theme mb-4">⏳ Durasi Pemenuhan Dokumen Unclear</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($durasiDokumenUnclear as $entitas => $durasiData)
                            <div class="text-center">
                                <h4 class="text-sm font-medium text-theme mb-3">{{ $entitas }}</h4>
                                <div class="chart-container">
                                    <canvas id="durasi-chart-{{ $loop->index }}"></canvas>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
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

        // Hitung nilai maksimum untuk Status Dokumen per Entitas
        @php
            $maxStatusValue = 0;
            foreach ($statusDokumenPerEntitas as $entitas => $statusData) {
                $maxInEntitas = $statusData->max('total');
                if ($maxInEntitas > $maxStatusValue) {
                    $maxStatusValue = $maxInEntitas;
                }
            }
            // Tambahkan padding 20% untuk tampilan yang lebih baik
            $maxStatusValue = ceil($maxStatusValue * 1.2);
        @endphp

        // Hitung nilai maksimum untuk Durasi Dokumen Unclear
        @php
            $maxDurasiValue = 0;
            foreach ($durasiDokumenUnclear as $entitas => $durasiData) {
                $maxInEntitas = $durasiData->max('total');
                if ($maxInEntitas > $maxDurasiValue) {
                    $maxDurasiValue = $maxInEntitas;
                }
            }
            // Tambahkan padding 20% untuk tampilan yang lebih baik
            $maxDurasiValue = ceil($maxDurasiValue * 1.2);
        @endphp

        // Chart.js configurations untuk Status Dokumen per Entitas
        @foreach ($statusDokumenPerEntitas as $entitas => $statusData)
            const ctx{{ $loop->index }} = document.getElementById('chart-{{ $loop->index }}').getContext('2d');

            // Urutkan data berdasarkan prioritas: unclear (merah), clear (hijau), telaah (kuning)
            const sortedData{{ $loop->index }} = {!! json_encode(
                $statusData->sortBy(function ($item) {
                        if (str_contains(strtolower($item->status_dokumen), 'uncler')) {
                            return 1;
                        }
                        if (str_contains(strtolower($item->status_dokumen), 'clear')) {
                            return 2;
                        }
                        if (str_contains(strtolower($item->status_dokumen), 'telaah')) {
                            return 3;
                        }
                        return 4;
                    })->values(),
            ) !!};

            // Buat array warna berdasarkan status dokumen
            const colors{{ $loop->index }} = sortedData{{ $loop->index }}.map(item => {
                const status = item.status_dokumen.toLowerCase();
                if (status.includes('uncler')) return '#ef4444'; // Merah untuk unclear
                if (status.includes('clear')) return '#22c55e'; // Hijau untuk clear
                if (status.includes('telaah')) return '#f59e0b'; // Kuning untuk telaah
                return '#6b7280'; // Abu-abu untuk status lainnya
            });

            new Chart(ctx{{ $loop->index }}, {
                type: 'bar',
                data: {
                    labels: sortedData{{ $loop->index }}.map(item => item.status_dokumen),
                    datasets: [{
                        data: sortedData{{ $loop->index }}.map(item => item.total),
                        backgroundColor: colors{{ $loop->index }},
                        borderWidth: 0,
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: {{ $maxStatusValue }}, // Gunakan nilai maksimum yang sama untuk semua chart
                            display: false
                        },
                        x: {
                            display: false
                        }
                    }
                }
            });
        @endforeach

        // Chart.js configurations untuk Durasi Dokumen Unclear
        @foreach ($durasiDokumenUnclear as $entitas => $durasiData)
            const durasiCtx{{ $loop->index }} = document.getElementById('durasi-chart-{{ $loop->index }}').getContext(
                '2d');
            new Chart(durasiCtx{{ $loop->index }}, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($durasiData->pluck('durasi_hari')->toArray()) !!},
                    datasets: [{
                        data: {!! json_encode($durasiData->pluck('total')->toArray()) !!},
                        backgroundColor: ['#ef4444', '#22c55e', '#f59e0b'],
                        borderWidth: 0,
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: {{ $maxDurasiValue }}, // Gunakan nilai maksimum yang sama untuk semua chart durasi
                            display: false
                        },
                        x: {
                            display: false
                        }
                    }
                }
            });
        @endforeach
    </script>
</body>

</html>

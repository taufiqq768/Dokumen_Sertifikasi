<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dokumentasi Sertifikasi</title>
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
        <div class="fade-in">
            <h1 class="text-4xl font-bold text-white mb-2 text-center">Dashboard Dokumentasi Sertifikasi</h1>
            <p class="text-center text-white/80 mb-8">Sistem Monitoring Dokumen Sertifikasi Lahan</p>
        </div>

        <!-- Bagian 1: Total Dokumen -->
        <div class="mb-8 slide-up">
            <h2 class="text-xl font-semibold text-white mb-4">📊 Total Dokumen</h2>
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
                        <h3 class="text-lg font-medium text-theme">Total Semua Dokumen Proses</h3>
                        <p class="text-3xl font-bold gradient-text">{{ number_format($totalDokumen) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian 2: Dokumen Berdasarkan Posisi -->
        <div class="mb-8 slide-up" style="animation-delay: 0.2s;">
            <h2 class="text-xl font-semibold text-white mb-4">📍 Dokumen Berdasarkan Posisi</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
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
                    <a href="{{ route('dashboard.detail', ['posisi_id' => $posisi->id]) }}"
                        class="stat-card block rounded-xl p-6 scale-in" style="animation-delay: {{ 0.1 * $index }}s;">
                        <div class="flex items-center">
                            <div class="bg-gradient-to-r {{ $gradient }} text-white rounded-lg p-3 mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-theme">
                                    {{ ucwords(str_replace('_', ' ', $posisi->posisi)) }}</h3>
                                <p
                                    class="text-2xl font-bold bg-gradient-to-r {{ $gradient }} bg-clip-text text-transparent">
                                    {{ number_format($posisi->proses_dokumen_count) }}</p>
                                <p class="text-xs text-theme/70 mt-1">Klik untuk detail</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Status Cards Section -->
        <div class="mb-8 slide-up" style="animation-delay: 0.4s;">
            <h2 class="text-xl font-semibold text-white mb-4">✅ Dokumen Berdasarkan Status</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Clear Status Card -->
                <a href="{{ route('dashboard.detail', ['status' => 'clear']) }}" class="stat-card block rounded-xl p-6">
                    <div class="flex items-center">
                        <div class="icon-gradient-green text-white rounded-lg p-3 mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-theme">Clear</h3>
                            <p class="text-2xl font-bold text-emerald-600">{{ number_format($clearCount) }}</p>
                            <p class="text-xs text-theme/70 mt-1">Klik untuk detail</p>
                        </div>
                    </div>
                </a>

                <!-- Non Clear Status Card -->
                <a href="{{ route('dashboard.detail', ['status' => 'non_clear']) }}"
                    class="stat-card block rounded-xl p-6">
                    <div class="flex items-center">
                        <div class="icon-gradient-red text-white rounded-lg p-3 mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-theme">Non Clear</h3>
                            <p class="text-2xl font-bold text-rose-600">{{ number_format($nonClearCount) }}</p>
                            <p class="text-xs text-theme/70 mt-1">Klik untuk detail</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8 slide-up" style="animation-delay: 0.6s;">
            <!-- Pie Chart: Dokumen berdasarkan Entitas -->
            <div class="chart-container p-6">
                <h3 class="text-lg font-semibold text-theme mb-4">📈 Distribusi Dokumen per Entitas</h3>
                <div class="relative h-64">
                    <canvas id="entitasPieChart"></canvas>
                </div>
            </div>

            <!-- Pie Chart: Non Clear berdasarkan Entitas -->
            <div class="chart-container p-6">
                <h3 class="text-lg font-semibold text-theme mb-4">⚠️ Distribusi Non Clear per Entitas</h3>
                <div class="relative h-64">
                    <canvas id="nonClearPieChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Charts Section: Bar Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8 slide-up" style="animation-delay: 0.8s;">
            <!-- Bar Chart: Jenis Hak berdasarkan Entitas -->
            <div class="chart-container p-6">
                <h3 class="text-lg font-semibold text-theme mb-4">🏛️ Jenis Hak per Entitas</h3>
                <div class="relative h-64">
                    <canvas id="jenisHakBarChart"></canvas>
                </div>
            </div>

            <!-- Chart Section: Jenis Permohonan -->
            <div class="chart-container p-6">
                <h3 class="text-lg font-semibold text-theme mb-4">📋 Jenis Permohonan per Entitas</h3>
                <div class="relative h-64">
                    <canvas id="jenisPermohonanChart"></canvas>
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

        // Data untuk charts
        const dokumenByEntitas = @json($dokumenByEntitas);
        const jenisHakByEntitas = @json($jenisHakByEntitas);
        const jenisPermohonanByEntitas = @json($jenisPermohonanByEntitas);
        const nonClearByEntitas = @json($nonClearByEntitas);

        // Modern color palettes
        const modernColors = [
            '#06b6d4', '#10b981', '#f59e0b', '#ef4444',
            '#8b5cf6', '#f97316', '#84cc16', '#ec4899'
        ];

        const warmColors = [
            '#ef4444', '#f97316', '#f59e0b', '#dc2626',
            '#ea580c', '#d97706', '#b91c1c', '#c2410c'
        ];

        // Plugin untuk menampilkan persentase pada pie chart
        const percentagePlugin = {
            id: 'percentageLabels',
            afterDatasetsDraw: function(chart) {
                const ctx = chart.ctx;
                const data = chart.data;
                const total = data.datasets[0].data.reduce((a, b) => a + b, 0);

                chart.data.datasets.forEach((dataset, i) => {
                    const meta = chart.getDatasetMeta(i);
                    meta.data.forEach((element, index) => {
                        const value = dataset.data[index];
                        const percentage = ((value / total) * 100).toFixed(1);

                        if (percentage > 3) {
                            const position = element.tooltipPosition();

                            ctx.save();
                            ctx.fillStyle = 'white';
                            ctx.font = 'bold 12px Inter';
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'middle';
                            ctx.strokeStyle = '#000';
                            ctx.lineWidth = 2;

                            ctx.strokeText(percentage + '%', position.x, position.y);
                            ctx.fillText(percentage + '%', position.x, position.y);
                            ctx.restore();
                        }
                    });
                });
            }
        };

        // Pie Chart untuk distribusi dokumen per entitas
        const pieCtx = document.getElementById('entitasPieChart').getContext('2d');
        const pieChart = new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: dokumenByEntitas.map(item => item.label),
                datasets: [{
                    data: dokumenByEntitas.map(item => item.value),
                    backgroundColor: modernColors,
                    borderWidth: 3,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                onClick: function(event, elements) {
                    if (elements.length > 0) {
                        const elementIndex = elements[0].index;
                        const entitas = dokumenByEntitas[elementIndex].label;
                        window.location.href =
                            `{{ route('dashboard.detail') }}?entitas=${encodeURIComponent(entitas)}`;
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            usePointStyle: true,
                            font: {
                                family: 'Inter',
                                size: 11
                            },
                            generateLabels: function(chart) {
                                const data = chart.data;
                                if (data.labels.length && data.datasets.length) {
                                    // Perbaikan: Konversi ke number sebelum reduce
                                    const total = data.datasets[0].data
                                        .map(val => Number(val) || 0)
                                        .reduce((a, b) => a + b, 0);

                                    return data.labels.map((label, i) => {
                                        const value = Number(data.datasets[0].data[i]) || 0;
                                        const percentage = total > 0 ? ((value / total) * 100).toFixed(
                                            1) : '0.0';
                                        return {
                                            text: `${label}: ${value} (${percentage}%)`,
                                            fillStyle: data.datasets[0].backgroundColor[i],
                                            strokeStyle: data.datasets[0].borderColor,
                                            lineWidth: data.datasets[0].borderWidth,
                                            pointStyle: 'circle',
                                            hidden: false,
                                            index: i
                                        };
                                    });
                                }
                                return [];
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleFont: {
                            family: 'Inter',
                            size: 12
                        },
                        bodyFont: {
                            family: 'Inter',
                            size: 11
                        },
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data
                                    .map(val => Number(val) || 0) // Konversi setiap nilai ke number
                                    .reduce((a, b) => a + b, 0); // Sekarang akan menjumlahkan number

                                const percentage = ((context.parsed / total) * 100).toFixed(1);
                                return `${context.label}: ${context.parsed} dokumen (${percentage}%) - Klik untuk detail`;
                            }
                        }
                    }
                },
                onHover: function(event, elements) {
                    event.native.target.style.cursor = elements.length > 0 ? 'pointer' : 'default';
                }
            },
            plugins: [percentagePlugin]
        });

        // Bar Chart untuk jenis hak per entitas
        const jenisHakCtx = document.getElementById('jenisHakBarChart').getContext('2d');

        // Prepare data for jenis hak chart
        const allJenisHak = [...new Set(jenisHakByEntitas.flatMap(item => Object.keys(item.data)))];
        const jenisHakDatasets = allJenisHak.map((jenisHak, index) => ({
            label: jenisHak,
            data: jenisHakByEntitas.map(item => item.data[jenisHak] || 0),
            backgroundColor: modernColors[index % modernColors.length],
            borderWidth: 0,
            borderRadius: 4
        }));

        const jenisHakChart = new Chart(jenisHakCtx, {
            type: 'bar',
            data: {
                labels: jenisHakByEntitas.map(item => item.entitas),
                datasets: jenisHakDatasets
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                onClick: function(event, elements) {
                    if (elements.length > 0) {
                        const elementIndex = elements[0].index;
                        const datasetIndex = elements[0].datasetIndex;
                        const entitas = jenisHakByEntitas[elementIndex].entitas;
                        const jenisHak = allJenisHak[datasetIndex];
                        window.location.href =
                            `{{ route('dashboard.detail') }}?entitas=${encodeURIComponent(entitas)}&jenis_hak=${encodeURIComponent(jenisHak)}`;
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                family: 'Inter',
                                size: 11
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleFont: {
                            family: 'Inter',
                            size: 12
                        },
                        bodyFont: {
                            family: 'Inter',
                            size: 11
                        },
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            afterBody: function() {
                                return 'Klik untuk melihat detail';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Entitas',
                            font: {
                                family: 'Inter',
                                size: 12
                            }
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Jumlah Dokumen',
                            font: {
                                family: 'Inter',
                                size: 12
                            }
                        },
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    }
                },
                onHover: function(event, elements) {
                    event.native.target.style.cursor = elements.length > 0 ? 'pointer' : 'default';
                }
            }
        });

        // Bar Chart untuk jenis permohonan per entitas
        const jenisPermohonanCtx = document.getElementById('jenisPermohonanChart').getContext('2d');

        // Prepare data for jenis permohonan chart
        const allJenisPermohonan = [...new Set(jenisPermohonanByEntitas.flatMap(item => Object.keys(item.data)))];
        const jenisPermohonanDatasets = allJenisPermohonan.map((jenisPermohonan, index) => ({
            label: jenisPermohonan,
            data: jenisPermohonanByEntitas.map(item => item.data[jenisPermohonan] || 0),
            backgroundColor: modernColors[index % modernColors.length],
            borderWidth: 0,
            borderRadius: 4
        }));

        const jenisPermohonanChart = new Chart(jenisPermohonanCtx, {
            type: 'bar',
            data: {
                labels: jenisPermohonanByEntitas.map(item => item.entitas),
                datasets: jenisPermohonanDatasets
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                onClick: function(event, elements) {
                    if (elements.length > 0) {
                        const elementIndex = elements[0].index;
                        const datasetIndex = elements[0].datasetIndex;
                        const entitas = jenisPermohonanByEntitas[elementIndex].entitas;
                        const jenisPermohonan = allJenisPermohonan[datasetIndex];
                        window.location.href =
                            `{{ route('dashboard.detail') }}?entitas=${encodeURIComponent(entitas)}&jenis_permohonan=${encodeURIComponent(jenisPermohonan)}`;
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            boxWidth: 12,
                            padding: 10,
                            font: {
                                family: 'Inter',
                                size: 10
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleFont: {
                            family: 'Inter',
                            size: 12
                        },
                        bodyFont: {
                            family: 'Inter',
                            size: 11
                        },
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            afterBody: function() {
                                return 'Klik untuk melihat detail';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Entitas',
                            font: {
                                family: 'Inter',
                                size: 12
                            }
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Jumlah Dokumen',
                            font: {
                                family: 'Inter',
                                size: 12
                            }
                        },
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    }
                },
                onHover: function(event, elements) {
                    event.native.target.style.cursor = elements.length > 0 ? 'pointer' : 'default';
                }
            }
        });

        // Pie Chart untuk non clear per entitas
        const nonClearPieCtx = document.getElementById('nonClearPieChart').getContext('2d');
        const nonClearPieChart = new Chart(nonClearPieCtx, {
            type: 'pie',
            data: {
                labels: nonClearByEntitas.map(item => item.label),
                datasets: [{
                    data: nonClearByEntitas.map(item => item.value),
                    backgroundColor: warmColors,
                    borderWidth: 3,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                onClick: function(event, elements) {
                    if (elements.length > 0) {
                        const elementIndex = elements[0].index;
                        const entitas = nonClearByEntitas[elementIndex].label;
                        window.location.href =
                            `{{ route('dashboard.detail') }}?entitas=${encodeURIComponent(entitas)}&status=non_clear`;
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            usePointStyle: true,
                            font: {
                                family: 'Inter',
                                size: 11
                            },
                            generateLabels: function(chart) {
                                const data = chart.data;
                                if (data.labels.length && data.datasets.length) {
                                    const total = data.datasets[0].data
                                        .map(val => Number(val) || 0)
                                        .reduce((a, b) => a + b, 0);
                                    return data.labels.map((label, i) => {
                                        const value = data.datasets[0].data[i];
                                        const percentage = total > 0 ? ((value / total) * 100).toFixed(
                                            1) : '0.0';
                                        return {
                                            text: `${label}: ${value} (${percentage}%)`,
                                            fillStyle: data.datasets[0].backgroundColor[i],
                                            strokeStyle: data.datasets[0].borderColor,
                                            lineWidth: data.datasets[0].borderWidth,
                                            pointStyle: 'circle',
                                            hidden: false,
                                            index: i
                                        };
                                    });
                                }
                                return [];
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleFont: {
                            family: 'Inter',
                            size: 12
                        },
                        bodyFont: {
                            family: 'Inter',
                            size: 11
                        },
                        callbacks: {
                            label: function(context) {
                                // Perbaikan: Pastikan semua nilai adalah number dan valid
                                const total = context.dataset.data
                                    .map(val => Number(val) || 0) // Konversi setiap nilai ke number
                                    .reduce((a, b) => a + b, 0); // Sekarang akan menjumlahkan number


                                const value = Number(context.parsed) || 0;
                                const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : '0.0';
                                console.log(value, total, percentage);
                                return `${context.label}: ${value} dokumen (${percentage}%) - Klik untuk detail`;
                            }
                        }
                    }
                },
                onHover: function(event, elements) {
                    event.native.target.style.cursor = elements.length > 0 ? 'pointer' : 'default';
                }
            },
            plugins: [percentagePlugin]
        });
    </script>
</body>

</html>

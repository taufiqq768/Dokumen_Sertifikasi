<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dokumentasi Sertifikasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Dashboard Dokumentasi Sertifikasi</h1>

        <!-- Bagian 1: Total Dokumen -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Total Dokumen</h2>
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="bg-blue-500 text-white rounded-full p-3 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Total Semua Dokumen Proses</h3>
                        <p class="text-3xl font-bold text-blue-600">{{ number_format($totalDokumen) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian 2: Dokumen Berdasarkan Posisi (Dinamis dari Master Posisi) -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Dokumen Berdasarkan Posisi</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @php
                    $colors = [
                        'bg-green-500' => 'text-green-600',
                        'bg-yellow-500' => 'text-yellow-600',
                        'bg-purple-500' => 'text-purple-600',
                        'bg-blue-500' => 'text-blue-600',
                        'bg-red-500' => 'text-red-600',
                        'bg-indigo-500' => 'text-indigo-600',
                        'bg-pink-500' => 'text-pink-600',
                        'bg-gray-500' => 'text-gray-600',
                    ];
                    $colorKeys = array_keys($colors);
                @endphp

                @foreach ($posisiData as $index => $posisi)
                    @php
                        $bgColor = $colorKeys[$index % count($colorKeys)];
                        $textColor = $colors[$bgColor];
                    @endphp
                    <a href="{{ route('dashboard.detail', ['posisi_id' => $posisi->id]) }}"
                        class="block bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-200 transform hover:scale-105">
                        <div class="flex items-center">
                            <div class="{{ $bgColor }} text-white rounded-full p-3 mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">
                                    {{ ucwords(str_replace('_', ' ', $posisi->posisi)) }}</h3>
                                <p class="text-2xl font-bold {{ $textColor }}">
                                    {{ number_format($posisi->proses_dokumen_count) }}</p>
                                <p class="text-xs text-gray-500 mt-1">Klik untuk detail</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Status Cards Section -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Dokumen Berdasarkan Status</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Clear Status Card -->
                <a href="{{ route('dashboard.detail', ['status' => 'clear']) }}"
                    class="block bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-200 transform hover:scale-105">
                    <div class="flex items-center">
                        <div class="bg-green-500 text-white rounded-full p-3 mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-900">Clear</h3>
                            <p class="text-2xl font-bold text-green-600">{{ number_format($clearCount) }}</p>
                            <p class="text-xs text-gray-500 mt-1">Klik untuk detail</p>
                        </div>
                    </div>
                </a>

                <!-- Non Clear Status Card -->
                <a href="{{ route('dashboard.detail', ['status' => 'non_clear']) }}"
                    class="block bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-200 transform hover:scale-105">
                    <div class="flex items-center">
                        <div class="bg-red-500 text-white rounded-full p-3 mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-900">Non Clear</h3>
                            <p class="text-2xl font-bold text-red-600">{{ number_format($nonClearCount) }}</p>
                            <p class="text-xs text-gray-500 mt-1">Klik untuk detail</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Pie Chart: Dokumen berdasarkan Entitas -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Distribusi Dokumen per Entitas</h3>
                <div class="relative h-64">
                    <canvas id="entitasPieChart"></canvas>
                </div>
            </div>

            <!-- Pie Chart: Non Clear berdasarkan Entitas -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Distribusi Non Clear per Entitas</h3>
                <div class="relative h-64">
                    <canvas id="nonClearPieChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Charts Section: Bar Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Bar Chart: Jenis Hak berdasarkan Entitas -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Jenis Hak per Entitas</h3>
                <div class="relative h-64">
                    <canvas id="jenisHakBarChart"></canvas>
                </div>
            </div>

            <!-- Chart Section: Jenis Permohonan -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Jenis Permohonan per Entitas</h3>
                <div class="relative h-64">
                    <canvas id="jenisPermohonanChart"></canvas>
                </div>
            </div>
        </div>

        {{-- <!-- Chart Section: Jenis Permohonan -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Jenis Permohonan per Entitas</h3>
            <div class="relative h-64">
                <canvas id="jenisPermohonanChart"></canvas>
            </div>
        </div> --}}
    </div>

    <script>
        // Data untuk charts
        const dokumenByEntitas = @json($dokumenByEntitas);
        const jenisHakByEntitas = @json($jenisHakByEntitas);
        const jenisPermohonanByEntitas = @json($jenisPermohonanByEntitas);
        const nonClearByEntitas = @json($nonClearByEntitas);

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

                        // Hanya tampilkan persentase jika lebih dari 3% untuk menghindari tumpang tindih
                        if (percentage > 3) {
                            const position = element.tooltipPosition();

                            ctx.save();
                            ctx.fillStyle = 'white';
                            ctx.font = 'bold 14px Arial';
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'middle';
                            ctx.strokeStyle = '#000';
                            ctx.lineWidth = 3;

                            // Tambahkan outline untuk keterbacaan yang lebih baik
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
                    backgroundColor: [
                        '#3B82F6', // Blue
                        '#10B981', // Green
                        '#F59E0B', // Yellow
                        '#EF4444', // Red
                        '#8B5CF6', // Purple
                        '#F97316', // Orange
                        '#06B6D4', // Cyan
                        '#84CC16' // Lime
                    ],
                    borderWidth: 2,
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
                            padding: 20,
                            usePointStyle: true,
                            generateLabels: function(chart) {
                                const data = chart.data;
                                if (data.labels.length && data.datasets.length) {
                                    const total = data.datasets[0].data.reduce((a, b) => a + b, 0);
                                    return data.labels.map((label, i) => {
                                        const value = data.datasets[0].data[i];
                                        const percentage = ((value / total) * 100).toFixed(1);
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
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
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
            backgroundColor: [
                '#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#F97316', '#06B6D4', '#84CC16'
            ][index % 8],
            borderWidth: 1
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
                    },
                    tooltip: {
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
                            text: 'Entitas'
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Jumlah Dokumen'
                        },
                        beginAtZero: true
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
            backgroundColor: [
                '#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#F97316',
                '#06B6D4', '#84CC16', '#F472B6', '#A78BFA', '#FB7185', '#34D399'
            ][index % 12],
            borderWidth: 1
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
                            padding: 10
                        }
                    },
                    tooltip: {
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
                            text: 'Entitas'
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Jumlah Dokumen'
                        },
                        beginAtZero: true
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
                    backgroundColor: [
                        '#EF4444', // Red
                        '#F97316', // Orange
                        '#F59E0B', // Yellow
                        '#DC2626', // Dark Red
                        '#EA580C', // Dark Orange
                        '#D97706', // Dark Yellow
                        '#B91C1C', // Darker Red
                        '#C2410C' // Darker Orange
                    ],
                    borderWidth: 2,
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
                            padding: 20,
                            usePointStyle: true,
                            generateLabels: function(chart) {
                                const data = chart.data;
                                if (data.labels.length && data.datasets.length) {
                                    const total = data.datasets[0].data.reduce((a, b) => a + b, 0);
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
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = total > 0 ? ((context.parsed / total) * 100).toFixed(1) :
                                    '0.0';
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
    </script>
</body>

</html>

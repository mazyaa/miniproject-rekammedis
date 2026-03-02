<x-app-layout>

    <div class="dashboard-content">
        {{-- Dashboard Header --}}
        <x-dashboard.header
            title="Dashboard"
            :breadcrumbs="[['label' => 'Dashboard']]"
        />

        <div class="row g-4">
            {{-- Welcome Banner --}}
            <div class="col-lg-6 col-12">
                <x-dashboard.welcome-banner
                    bannerTitle="Kami Melayani & Menangani"
                    bannerHighlight="Dengan Sepenuh Hati"
                    subtitle="Memberikan pelayanan kesehatan terbaik untuk masyarakat dengan sistem manajemen modern dan terintegrasi."
                />
            </div>

            {{-- Chart Card --}}
            <div class="col-lg-6 col-12">
                <x-dashboard.chart-card
                    cardTitle="Grafik"
                    cardTitleHighlight="Perkembangan Pasien"
                    chartId="lineChart"
                />
            </div>
        </div>

        {{-- Stats Grid --}}
        <div class="stats-grid">
            <x-dashboard.stat-card
                :value="$totalPasien"
                label="Total Pasien Terdaftar"
                icon="bi-people-fill"
                variant="primary"
                :trend="($pasienTrend >= 0 ? '+' : '') . $pasienTrend . '% bulan ini'"
                :trendDirection="$pasienTrend >= 0 ? 'up' : 'down'"
                link="/kelola-pasien"
                linkText="Kelola Pasien"
            />

            <x-dashboard.stat-card
                :value="$totalKonsultasi"
                label="Total Konsultasi"
                icon="bi-person-check-fill"
                variant="success"
                :trend="($konsultasiTrend >= 0 ? '+' : '') . $konsultasiTrend . '% bulan ini'"
                :trendDirection="$konsultasiTrend >= 0 ? 'up' : 'down'"
                link="/kelola-rekamedis"
                linkText="Lihat Detail"
            />

            <x-dashboard.stat-card
                :value="$totalPetugas"
                label="Total Data Petugas"
                icon="bi-person-fill-gear"
                variant="warning"
                link="/kelola-petugas"
                linkText="Kelola Petugas"
            />
        </div>

        <div class="row g-4 mt-2">
            {{-- Quick Actions --}}
            <div class="col-lg-7 col-12">
                <div class="chart-card">
                    <div class="chart-header">
                        <h3 class="chart-title">Aksi <em>Cepat</em></h3>
                    </div>
                    <div class="quick-actions">
                        <a href="/kelola-pasien" class="quick-action-btn">
                            <i class="bi bi-person-plus-fill"></i>
                            Tambah Pasien
                        </a>
                        <a href="/kelola-rekamedis" class="quick-action-btn">
                            <i class="bi bi-heart-pulse-fill"></i>
                            Rekam Medis
                        </a>
                        <a href="/kelola-desa" class="quick-action-btn">
                            <i class="bi bi-geo-alt-fill"></i>
                            Data Desa
                        </a>
                        <a href="/kelola-petugas" class="quick-action-btn">
                            <i class="bi bi-person-badge-fill"></i>
                            Data Petugas
                        </a>
                    </div>
                </div>
            </div>

            {{-- Activity Card --}}
            <div class="col-lg-5 col-12">
                <x-dashboard.activity-card :activities="$activities" />
            </div>
        </div>
    </div>

    {{-- Chart Data from Backend --}}
    <script>
        window.chartConfig = {
            labels: @json($chartLabels),
            data: @json($chartData)
        };
    </script>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- Dashboard JS --}}
    <script src="{{ asset('js/dashboard.js') }}"></script>

</x-app-layout>

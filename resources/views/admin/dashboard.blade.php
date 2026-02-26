<x-app-layout>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0 text-primary fw-bold">{{ $title }}</h3>
                </div>
                <div class="col-sm-6">
                   <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/dashboard" class="text-black-50">Home</a></li>
                        <li class="breadcrumb-item active @if (request()->path() == 'dashboard') text-primary @endif"
                            aria-current="page">{{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="small-box p-2 py-4">
                        <div class="inner">
                            <div class="row align-items-center">
                                <!-- Teks -->
                                <div class="col-md-6 text-primary">
                                    <h4 class="fw-bold">
                                        Kami Melayani & Menangani
                                        Dengan Sepenuh Hati
                                    </h4>
                                    <p class="mb-0 opacity-75">
                                        Memberikan pelayanan kesehatan terbaik untuk masyarakat.
                                    </p>
                                </div>

                                <!-- Gambar -->
                                <div class="col-md-6 text-center">
                                    <img class="img-fluid" style="max-width: 250px;"
                                        src="{{ asset('assets/img/Medical care-rafiki.svg') }}" alt="Ilustrasi Medical">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="small-box">
                        <div class="inner">
                            <h5 class="fw-bold text-primary mb-4">Grafik Perkembangan Pasien</h5>
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="small-box text-bg-primary">
                        <div class="inner">
                            <h3>{{ $totalPasien }}</h3>
                            <p>Jumlah Pasien</p>
                        </div>
                        <i class="small-box-icon bi bi-people-fill"></i>
                        <a href="/kelola-pasien"
                            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            Add
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="small-box text-bg-success">
                        <div class="inner">
                            <h3>100<sup class="fs-5"></sup></h3>
                            <p>Jumlah Pasien Konsultasi</p>
                        </div>
                        <i class="small-box-icon bi bi-person-check-fill"></i>
                        <a href="#"
                            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            Add
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="small-box text-bg-warning">
                        <div class="inner">
                            <h3>44</h3>
                            <p>Jumlah Data Dokter</p>
                        </div>
                        <i class="small-box-icon bi bi-person-fill-gear"></i>
                        <a href="#"
                            class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                            Add
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ! Script Chart Start --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('lineChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Jumlah Pasien',
                    data: [12, 19, 15, 25, 22, 30],
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13,110,253,0.2)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true }
                }
            }
        });
    </script>
    {{-- ! Script Chart End --}}

</x-app-layout>

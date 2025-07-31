<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik Barang Ruangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OerWCQoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #0d6efd;
            color: white;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4 text-center">Statistik Daftar Barang Ruangan</h2>

        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Berdasarkan Kondisi</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Baik
                                <span class="badge bg-success rounded-pill">35</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Rusak
                                <span class="badge bg-danger rounded-pill">12</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Perlu Perbaikan
                                <span class="badge bg-warning rounded-pill">5</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Hilang
                                <span class="badge bg-secondary rounded-pill">2</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                                Total Barang
                                <span class="badge bg-primary rounded-pill">54</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Berdasarkan Ruangan</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Lt. 1-Sistem Informasi
                                <span class="badge bg-info text-dark rounded-pill">25</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Lt. 2-Laboratorium Komputer
                                <span class="badge bg-info text-dark rounded-pill">15</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Ruang Dosen
                                <span class="badge bg-info text-dark rounded-pill">8</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Gudang
                                <span class="badge bg-info text-dark rounded-pill">6</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                                Total Ruangan Tercatat
                                <span class="badge bg-primary rounded-pill">4</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Berdasarkan Penguasaan</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Barang Milik Perpustakaan
                                <span class="badge bg-primary rounded-pill">20</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Barang Milik Laboratorium
                                <span class="badge bg-primary rounded-pill">18</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Barang Milik Fakultas
                                <span class="badge bg-primary rounded-pill">10</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Lain-lain
                                <span class="badge bg-primary rounded-pill">6</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                                Total Penguasaan Tercatat
                                <span class="badge bg-dark rounded-pill">4</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Merk Barang Paling Banyak</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Western
                                <span class="badge bg-dark rounded-pill">15</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Lenovo
                                <span class="badge bg-dark rounded-pill">10</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Asus
                                <span class="badge bg-dark rounded-pill">8</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                HP
                                <span class="badge bg-dark rounded-pill">7</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        @import url(https://unpkg.com/@webpixels/css@1.1.5/dist/index.css);

        /* Bootstrap Icons */
        @import url("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.4.0/font/bootstrap-icons.min.css");
    </style>
</head>

<body>

    <!-- Dashboard -->
    <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
        <?php include('sidebar.php'); ?>
        <!-- Main content -->
        <div class="h-screen flex-grow-1 overflow-y-lg-auto">
            <!-- Header -->
            <?php include('navbar.php'); ?>
            <!-- Main -->
            <main class="py-6 bg-surface-secondary">
                <div class="container-fluid">
                    <!-- Card stats -->
                    <div class="row g-6 mb-6">
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow border-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Total Masuk
                                                Kerja</span>
                                            <span class="h3 font-bold mb-0">
                                                <!-- untuk menampilkan total absen -->
                                                <?php echo $total_absen ?> Hari
                                            </span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-tertiary text-white text-lg rounded-circle">
                                                <i class="bi bi-credit-card"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-0 text-sm">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow border-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Total
                                                Cuti</span>
                                            <span class="h3 font-bold mb-0">
                                                <!-- menampilkan total izin -->
                                                <?php echo $total_izin ?> Hari
                                            </span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-primary text-white text-lg rounded-circle">
                                                <i class="bi bi-people"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-0 text-sm">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow border-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Total
                                                Karyawan</span>
                                            <span class="h3 font-bold mb-0">
                                                <!-- menampilkan total karyawan -->
                                                <?php echo $total_karyawan ?>
                                            </span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-info text-white text-lg rounded-circle">
                                                <i class="bi bi-people"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-0 text-sm">

                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                    <div class="card shadow border-0 mb-7">
                        <div class="card-header">
                            <h5 class="mb-0">Data Karyawan</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-nowrap">
                                <thead class="thead-light">

                                    <tr>
                                        <th scope="col" class="text-center">No</th>
                                        <th scope="col" class="text-center">Nama Karyawan</th>
                                        <th scope="col" class="text-center">Kegiatan</th>
                                        <th scope="col" class="text-center">Date</th>
                                        <th scope="col" class="text-center">Jam Masuk</th>
                                        <th scope="col" class="text-center">Jam Pulang</th>
                                        <th scope="col" class="text-center">Keterangan Izin</th>
                                        <th scope="col" class="text-center">Status</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php $no = 0;
                                    foreach ($result as $row):
                                        $no++ ?>
                                        <tr>

                                            <td data-cell="No ">
                                                <?php echo $no ?>
                                            </td>

                                            <td data-cell="Nama Karyawan">
                                                <?php echo $row->nama_depan . ' ' . $row->nama_belakang; ?>
                                            </td>
                                            <td data-cell="Kegiatan">
                                                <?php if ($row->kegiatan == NULL) {
                                                    echo '-';
                                                } else {
                                                    echo $row->kegiatan;
                                                } ?>
                                            </td>
                                            <td data-cell="Date">
                                                <?php echo $row->date; ?>
                                            </td>
                                            <td data-cell="Jam Masuk">
                                                <?php if ($row->jam_masuk == NULL) {
                                                    echo '-';
                                                } else {
                                                    echo $row->jam_masuk;
                                                } ?>
                                            </td>
                                            <td data-cell="Jam Pulang">
                                                <?php if ($row->jam_pulang == NULL) {
                                                    echo '-';
                                                } else {
                                                    echo $row->jam_pulang;
                                                } ?>
                                            </td>
                                            <td data-cell="Keterangan Izin">
                                                <?php if ($row->keterangan_izin == NULL) {
                                                    echo '-';
                                                } else {
                                                    echo $row->keterangan_izin;
                                                } ?>
                                            </td>
                                            <td data-cell="Status">
                                                <?php if ($row->status == NULL) {
                                                    echo 'not';
                                                } else {
                                                    echo $row->status;
                                                } ?>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer border-0 py-5">
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        @import url(https://unpkg.com/@webpixels/css@1.1.5/dist/index.css);

        /* Bootstrap Icons */
        @import url("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.4.0/font/bootstrap-icons.min.css");


        .aksi_history {
            display: flex;
            gap: 2px;
        }

        @media (max-width: 600px) {
            .btn-edit {
                margin-left: 5rem;
            }

            tbody {
                text-align: left;
            }

            .option-select {
                font-size: 12px;
            }

            .td {
                padding-right: none;
                display: flex;
                justify-content: left;
            }

            .responsive-3 {
                width: 100%;
            }

            th {
                display: none;
            }

            td {
                display: grid;
                gap: 0.5rem;
                grid-template-columns: 15ch auto;
                padding: 0.75em 1rem;
            }

            td:first-child {
                padding-top: 2rem;
            }

            td::before {
                content: attr(data-cell) "  : ";
                font-weight: bold;
            }
        }
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

                                        <th scope="col" class="text-center">Aksi</th>
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
                                                <?php echo $row->jam_masuk; ?>
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
                                            <td data-cell="Aksi" class="text-end aksi_history">
                                                <a href="<?php echo base_url('karyawan/ubah_history_absen/') . $row->id ?>"
                                                    class="btn btn-sm btn-square btn-neutral text-danger-hover btn-edit"> <i
                                                        class="bi bi-pen"></i></a>
                                                <!-- <button type="button"
                                                    class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                                    <i class="bi bi-check"></i>
                                                </button> -->

                                                <?php
                                                if ($row->status == 'done') {
                                                    echo '<div>  <button disabled" class="btn btn-sm btn-square btn-neutral text-danger-hover opacity-50">  <i class="bi bi-check"></i>  </button> 
                                                    </div>';
                                                } else {
                                                    echo '<div>
                        <button onclick= "pulang(' . $row->id . ')"
                        class="btn btn-sm btn-square btn-neutral text-danger-hover">
                        <i class="bi bi-check"></i>
                        </button>
                       </div>';
                                                }
                                                ?>

                                              
                                                <button onclick="hapus(<?php echo $row->id ?>)" type="button"
                                                    class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer border-0 py-5">
                            <span class="text-muted text-sm">Showing 10 items out of 250 results found</span>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        function hapus(id) {
            Swal.fire({
                title: 'Akan Dihapus?',
                text: "data ini tidak bisa dikembalikan lagi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Sukses Menghapus!!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    setTimeout(() => {
                        window.location.href = "<?php echo base_url('karyawan/history_absen/') ?>" + id;
                    }, 1800);
                }
            })
        }
        function pulang(id) {
            Swal.fire({
                title: 'Apakah Ingin Pulang?',
                // text: "Pastikan kegiatan sudah dilakukan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, pulang!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Berhasil!!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    setTimeout(() => {
                        window.location.href = "<?php echo base_url('karyawan/pulang/') ?>" + id;
                    }, 1800);
                }
            })
        }
    </script>
</body>

</html>
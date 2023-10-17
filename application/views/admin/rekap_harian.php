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

        .header-data-karyawan {
            display: flex;
            gap: 48rem;
        }

        .btn-export {
            height: 2.3rem;
            margin-left: 20px;
        }

        .form-select-recap {
            width: 8.9rem;
            height: 2.7rem;
            font-size: small;
            margin-left: 36rem;
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

            .header-data-karyawan {
                gap: 3.5rem;
            }

            .btn-export {
                height: 2rem;
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

                            <div class="header-data-karyawan">
                                <h5 class="mb-0">Rekap Data Harian</h5>


                                <a href="<?php echo base_url('admin/export_harian') ?>" type="button"
                                    class="btn btn-sm btn-primary  btn-export">
                                    export
                                </a>
                            </div>
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

                                    </tr>

                                </thead>
                                <tbody>
                                    <?php $no = 0;
                                    foreach ($absensi as $row):
                                        $no++ ?>
                                        <tr>

                                            <td data-cell="No">
                                                <?php echo $no ?>
                                            </td>
                                            <td data-cell="Nama Karyawan">
                                                <?php echo $row->nama_depan . ' ' . $row->nama_belakang ?>
                                            </td>
                                            <td data-cell="Kegiatan">
                                                <?php echo $row->kegiatan ?>
                                            </td>
                                            <td data-cell="Date">
                                                <?php echo $row->date ?>
                                            </td>
                                            <td data-cell="Jam Masuk">
                                                <?php echo $row->jam_masuk ?>
                                            </td>
                                            <td data-cell="Jam Pulang">
                                                <?php echo $row->jam_pulang ?>
                                            </td>
                                            <td data-cell="Keterangan">
                                                <?php echo $row->keterangan_izin ?>
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
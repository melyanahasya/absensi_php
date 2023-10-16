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
            /* gap: 43rem; */
        }

        .btn-export-bulanan {
            height: 2.3rem;
            /* margin-left: 10px; */
        }

        .select-bulan {
            width: 9rem;
            height: 2.7rem;
            font-size: small;
            margin-left: 38rem;
        }

        @media (max-width: 600px) {
            .header-data-karyawan {
                gap: 3rem;
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
                                <h5 class="mb-0">Rekap Data Bulanan</h5>

                                <form action="<?php echo base_url('admin/export_bulanan') ?>" method="post">
                                    <div class="select-bulan flex flex-wrap justify-center col-span-2">
                                        <select name="bulan" id="bulan"
                                            class="custom-select custom-select-md  rounded-md border p-2 text-black">
                                            <option selected>Pilih Bulan</option>
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mei</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                </form>
                                
                                <a href="<?php echo base_url('admin/export_bulanan')?>" type="button" class="btn btn-sm btn-primary  btn-export-bulanan">
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
                                            <td>
                                                <?php echo $no ?>
                                            </td>
                                            <td>
                                                <?php echo $row->nama_depan . ' ' . $row->nama_belakang ?>
                                            </td>
                                            <td>
                                                <?php echo $row->kegiatan ?>
                                            </td>
                                            <td>
                                                <?php echo $row->date ?>
                                            </td>
                                            <td>
                                                <?php echo $row->jam_masuk ?>
                                            </td>
                                            <td>
                                                <?php echo $row->jam_pulang ?>
                                            </td>
                                            <td>
                                                <?php echo $row->keterangan_izin ?>
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
        document.addEventListener("DOMContentLoaded", function () {
            // Add an event listener for the "change" event on the select element
            var selectElement = document.getElementById('bulan');
            var formElement = selectElement.form; // Get the parent form

            selectElement.addEventListener('change', function () {
                formElement.submit(); // Submit the form when the select element changes
            });
        });
    </script>
</body>

</html>
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

        .card-k {
            margin-left: 1.5rem;
            width: 15rem;
        }

        @media (max-width: 600px) {

            .card-k {
                margin-left: 1.5rem;
                width: 18.5rem;
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
                    <!-- Card stats -->
                    <div class="row g-6 mb-6 total-karyawan">
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow border-0 card-k">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Total
                                                Akun</span>
                                            <span class="h3 font-bold mb-0">
                                                <?php echo $total_karyawan ?>
                                            </span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-tertiary text-white text-lg rounded-circle">
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

                    <!-- menampilkan table data karyawan -->
                    <main class="py-6 bg-surface-secondary">
                        <div class="container-fluid">

                            <div class="card shadow border-0 mb-7">
                                <div class="card-header">

                                    <div class="header-data-karyawan">
                                        <h5 class="mb-0"> Data Users</h5>

                                        <!-- <a href="<?php echo base_url('/admin/export') ?>" type="button"
                                    class="btn btn-sm btn-primary  btn-export">
                                    export
                                </a> -->
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover table-nowrap">
                                        <thead class="thead-light">

                                            <tr>
                                                <th scope="col" class="text-center">No</th>
                                                <th scope="col" class="text-center">Nama Karyawan</th>
                                                <th scope="col" class="text-center">Email</th>
                                                <th scope="col" class="text-center">Nama Lengkap</th>
                                                <th scope="col" class="text-center">Image</th>


                                            </tr>

                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($result as $row):
                                                $no++ ?>
                                                <tr>

                                                    <td data-cell="No">
                                                        <?php echo $no ?>
                                                    </td>

                                                    <td data-cell="Username">
                                                        <?php echo $row->username ?>
                                                    </td>
                                                    <td data-cell="Email">
                                                        <?php echo $row->email; ?>
                                                    </td>
                                                    <td data-cell="Nama Lengkap">
                                                        <?php echo $row->nama_depan . ' ' . $row->nama_belakang; ?>
                                                    </td>
                                                    <td data-cell="Image">
                                                        <img width="50" class="photo"
                                                            src="<?php echo base_url('images/admin/' . $row->image) ?>" />
                                                        <!-- <img width="50"  class="photo" src="<?php echo base_url('images/karyawan/' . $row->image) ?>" /> -->
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
            </main>
        </div>
    </div>
</body>

</html>
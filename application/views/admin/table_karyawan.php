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
            gap: 43rem;
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
        <!-- Main content -->
        <div class="h-screen flex-grow-1 overflow-y-lg-auto">
            <!-- Header -->

            <!-- Main -->
            <main class="py-6 bg-surface-secondary">
                <div class="container-fluid">

                    <div class="card shadow border-0 mb-7">
                        <div class="card-header">

                            <div class="header-data-karyawan">
                                <h5 class="mb-0"> Data Karyawan</h5>

                                <a href="<?php echo base_url('/admin/export') ?>" type="button"
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
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .form-menu-absen {
            margin: 20px;
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
                            <h5 class="mb-0">Menu Absen</h5>
                        </div>
                        <div class="table-responsive">
                            <form method="post" action="<?php echo base_url('karyawan/aksi_absen') ?>" class="form-menu-absen">
                                <div class="mb-3">
                                    <label for="kegiatan" class="form-label">Kegiatan*</label>
                                    <textarea id="kegiatan" name="kegiatan" rows="6" class="bg-gray-50 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-500" required></textarea>
                                    <div id="kegiatan" class="form-text">Isi form kegiatan diatas untuk mencatat kegiatan karyawan
                                    </div>
                                </div>

                                <button name="submit" type="submit" class="btn d-inline-flex btn-sm btn-primary mx-1">

                                    <span>Submit</span>
                                </button>
                            </form>
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
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
                            <h5 class="mb-0">Ubah History Absen</h5>
                        </div>
                        <div class="">
                            <?php foreach ($absensi as $row): ?>
                                <form action="<?php echo base_url('karyawan/aksi_ubah_siswa') ?>" class="form-menu-absen">
                                    <input name="id" type="hidden" value="<?php echo $row->id ?>">

                                    <div class="mb-3">
                                        <div>
                                            <label for="nama" class="form-label">Nama Karyawan</label>
                                            <input id="nama" name="nama" value="<?php echo $row->nama_karyawan ?>" rows="6"
                                                class="bg-gray-50 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-500"
                                                required></input>
                                        </div>

                                        <div> <label for="kegiatan" class="form-label">Kegiatan</label>
                                            <input id="kegiatan" name="kegiatan" value="<?php echo $row->kegiatan ?>" rows="6"
                                                class="bg-gray-50 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-500"
                                                required></input>
                                        </div>
                                        <div> <label for="date" class="form-label">Date</label>
                                            <input type="date" id="date" name="date" value="<?php echo $row->date ?>" rows="6"
                                                class="bg-gray-50 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-500"
                                                required></input>
                                        </div>
                                        <div> <label for="masuk" class="form-label">Jam Masuk</label>
                                            <input id="masuk" name="masuk" value="<?php echo $row->jam_masuk ?>" rows="6"
                                                class="bg-gray-50 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-500"
                                                required></input>
                                        </div>
                                        <div> <label for="pulang" class="form-label">Jam Pulang</label>
                                            <input id="pulang" name="pulang" value="<?php echo $row->jam_pulang ?>" rows="6"
                                                class="bg-gray-50 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-500"
                                                required></input>
                                        </div>
                                        <div> <label for="keterangan" class="form-label">Keterangan</label>
                                            <input id="keterangan" name="keterangan" value="<?php echo $row->keterangan ?>" rows="6"
                                                class="bg-gray-50 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-500"
                                                required></input>
                                        </div>
                                        <div> <label for="status" class="form-label">Status</label>
                                            <input id="status" name="status" value="<?php echo $row->status ?>" rows="6"
                                                class="bg-gray-50 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-500"
                                                required></input>
                                        </div>


                                    </div>

                                    <button name="submit" type="submit" class="btn d-inline-flex btn-sm btn-primary mx-1">

                                        <span>Submit</span>
                                    </button>
                                </form>
                            <?php endforeach ?>
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
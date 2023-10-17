<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        
    <style>
        html,
        body {
            background: #efefef;
            font-family: "Arial";
        }

        .container {
            max-width: 1250px;
            margin: 30px auto 30px;
            padding: 0 !important;
            width: 90%;
            background-color: #fff;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.10), 0 3px 6px rgba(0, 0, 0, 0.10);
        }

        header {
            background: #eee;
            background-image: url("https://images.pexels.com/photos/1731427/pexels-photo-1731427.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            height: 200px;
        }

        header i {
            position: relative;
            cursor: pointer;
            right: -96%;
            top: 25px;
            font-size: 18px !important;
            color: #fff;
        }

        @media (max-width:800px) {
            header {
                height: 150px;
            }

            header i {
                right: -90%;
            }
        }

        main {
            padding: 20px 20px 0px 20px;
        }

        .left {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .photo {
            width: 200px;
            height: 200px;
            margin-top: -286px;
            border-radius: 100px;
            border: 4px solid #fff;
        }

        .active {
            width: 20px;
            height: 20px;
            border-radius: 20px;
            position: absolute;
            right: calc(50% - 70px);
            top: 50px;
            background-color: #FFC107;
            border: 3px solid #fff;
        }

        @media (max-width:990px) {
            .active {
                right: calc(50% - 60px);
                top: 50px;
            }
        }

        .name {
            margin-top: 0px;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 18pt;
            color: #777;
        }

        .info {
            margin-top: -5px;
            margin-bottom: 5px;
            font-family: 'Montserrat', sans-serif;
            font-size: 11pt;
            color: #aaa;
        }

        .stats {
            margin-top: 25px;
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #ededed;
            font-family: 'Montserrat', sans-serif;
        }

        .number-stat {
            padding: 0px;
            font-size: 14pt;
            font-weight: bold;
            font-family: 'Montserrat', sans-serif;
            color: #aaa;
        }

        .desc-stat {
            margin-top: -15px;
            font-size: 10pt;
            color: #bbb;
        }

        .desc {
            text-align: center;
            margin-top: 25px;
            margin: 25px 40px;
            color: #999;
            font-size: 11pt;
            font-family: 'Montserrat', sans-serif;
            padding-bottom: 25px;
            border-bottom: 1px solid #ededed;
        }

        .social {
            margin: 5px 0 12px 0;
            text-align: center;
            display: inline-block;
            font-size: 20pt;
        }

        .social i {
            cursor: pointer;
            margin: 0 15px;
        }

        .social i:nth-child(1) {
            color: #4267b2;
        }

        .social i:nth-child(2) {
            color: #1da1f2;
        }

        .social i:nth-child(3) {
            color: #bd081c;
        }

        .social i:nth-child(4) {
            color: #36465d;
        }

        .right {
            padding: 0 25px 0 25px !important;
        }

        .nav a {
            display: inline-flex;
        }

        .nav li a {
            margin: 20px 30px 0 10px;
            cursor: pointer;
            font-size: 13pt;
            text-transform: uppercase;
            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
            color: #888;
            text-decoration: none;
        }

        .nav li a:hover,
        .nav li a:nth-child(1) {
            color: #999;
            border-bottom: 2px solid #999;
        }

        .follow {
            position: absolute;
            right: 8%;
            top: 15px;
            font-size: 11pt;
            background-color: #42b1fa;
            color: #fff;
            padding: 8px 15px;
            cursor: pointer;
            transition: all .4s;
            font-family: 'Montserrat', sans-serif;
            font-weight: 400;
        }

        .follow:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2), 0 0 15px rgba(0, 0, 0, 0.2);
        }

        @media (max-width:990px) {
            .nav a {
                display: none;
            }


            .follow {
                width: 50%;
                margin-left: 25%;
                display: block;
                position: unset;
                text-align: center;
            }

            .photo {
                width: 100px;
                height: 100px;
                margin-top: -80px;
                border-radius: 100px;
                border: 4px solid #fff;
            }

            .name {
                margin-top: 10px;
                font-family: 'Montserrat', sans-serif;
                font-weight: 600;
                font-size: 18pt;
                color: #777;
            }
        }

        .gallery {
            margin-top: 35px;
        }

        .gallery div {
            margin-bottom: 30px;
        }

        .gallery img {
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.10), 0 3px 6px rgba(0, 0, 0, 0.10);
            width: auto;
            height: auto;
            cursor: pointer;
            max-width: 100%;
        }
    </style>
</head>

<body>
    <?php foreach ($user as $row): ?>

        <div class="container">
            <header>
                <i class="fa fa-bars" aria-hidden="true"></i>
            </header>
            <main>
                <div class="row">
                    <div class="left col-lg-4">
                        <?php foreach ($user as $data): ?>
                            <div class="photo-left">
                                <img class="photo" src="<?php echo base_url('images/admin/' . $data->image) ?>" />
                                <div class="active"></div>
                            </div>
                        <?php endforeach ?>

                        <form enctype="multipart/form-data" action="<?php echo base_url('admin/aksi_ubah_password') ?>"
                            action="">
                            <h4 class="name">
                                <?php echo $row->username ?>
                            </h4>
                            <p class="info">
                                <?php echo $row->nama_depan . ' ' . $row->nama_belakang ?>
                           
                            </p>
                            <p class="info">
                                <?php echo $row->email ?>
                            </p>
                            <div class="stats row">

                            </div>

                        </form>
                        <div class="social">
                            <i class="fa fa-facebook-square" aria-hidden="true"></i>
                            <i class="fa fa-twitter-square" aria-hidden="true"></i>
                            <i class="fa fa-pinterest-square" aria-hidden="true"></i>
                            <i class="fa fa-tumblr-square" aria-hidden="true"></i>
                        </div>
                    </div>

                    <div class="right col-lg-8">
                        <ul class="nav">
                            <li><a href="<?php echo base_url('admin/ubah_profile') ?>"> Ubah Profile</a></li>
                            <li><a href="<?php echo base_url('admin/profile') ?>"> Ubah Password</a></li>
                            <li><a href="<?php echo base_url('admin/ubah_foto') ?>">Ubah Foto</a></li>
                        </ul>


                        <a href="<?php echo base_url('admin/') ?>"><span class="follow">Back</span></a>
                        <div id="ubah_password" class="">
                            <div class="card shadow border-0 mb-7" style="margin:2rem 5px;">
                                <div class="card-header">
                                    <h5 class="mb-0">Ubah Password</h5>
                                </div>
                                <div class="table-responsive">
                                    <form method="post" enctype="multipart/form-data"
                                        action="<?php echo base_url('admin/aksi_ubah_password') ?>"
                                        class="form-menu-absen" style="margin: 30px 20px 20px;">
                                        <div class="row">
                                            <div class="mb-3 col-6">
                                                <label for="nama" class="form-label bold">Password Lama</label>
                                                <i class="password-toggle fa fa-eye-slash" onclick="togglePassword()"></i>
                                                <input value="" type="password" class="form-control" id="lama"
                                                    name="password_lama" aria-describedby="nama">
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label for="nama" class="form-label bold">Password Baru</label>
                                                <input value="" type="password" class="form-control" id="baru"
                                                    name="password_baru" aria-describedby="nama">
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label for="nama" class="form-label bold">Konfirmasi Password</label>
                                                <input value="" type="password" class="form-control" id="konfirmasi"
                                                    name="konfirmasi_password" aria-describedby="nama">
                                            </div>

                                        </div>

                                        <button name="submit" type="submit"
                                            class="btn d-inline-flex btn-sm btn-primary mx-1">

                                            <span>Submit</span>
                                        </button>
                                    </form>
                                </div>
                                <!-- <div class="card-footer border-0 py-5">
                                </div> -->
                            </div>
                        </div>
            </main>
        </div>


    <?php endforeach ?>
    <script type="text/javascript">
        function togglePassword() {
            var passwordField = document.getElementById('password');
            var passwordToggle = document.querySelector('.password-toggle');

            if (passwordField.type === "password") {
                passwordField.type = "text";
                passwordToggle.classList.remove('fa-eye-slash');
                passwordToggle.classList.add('fa-eye');


            } else {
                passwordField.type = "password";
                passwordToggle.classList.add('fa-eye-slash');
                passwordToggle.classList.remove('fa-eye');

            }
        }
    </script>
</body>

</html>
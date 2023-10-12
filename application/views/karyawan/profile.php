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
            height: 250px;
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
            margin-top: -120px;
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
            margin-top: 20px;
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

        .nav {
            display: inline-flex;
        }

        .nav li {
            margin: 40px 30px 0 10px;
            cursor: pointer;
            font-size: 13pt;
            text-transform: uppercase;
            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
            color: #888;
        }

        .nav li:hover,
        .nav li:nth-child(1) {
            color: #999;
            border-bottom: 2px solid #999;
        }

        .follow {
            position: absolute;
            right: 8%;
            top: 35px;
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
            .nav {
                display: none;
            }

            .follow {
                width: 50%;
                margin-left: 25%;
                display: block;
                position: unset;
                text-align: center;
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
                        <div class="photo-left">
                            <img class="photo"
                                src="https://images.pexels.com/photos/1804796/pexels-photo-1804796.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                            <div class="active"></div>
                        </div>

                        <form enctype="multipart/form-data" action="<?php echo base_url('karyawan/aksi_ubah_akun') ?>"
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
                                <div class="stat col-xs-4" style="padding-right: 50px;">
                                    <p class="number-stat">3,619</p>
                                    <p class="desc-stat">Followers</p>
                                </div>
                                <div class="stat col-xs-4">
                                    <p class="number-stat">42</p>
                                    <p class="desc-stat">Following</p>
                                </div>
                                <div class="stat col-xs-4" style="padding-left: 50px;">
                                    <p class="number-stat">38</p>
                                    <p class="desc-stat">Uploads</p>
                                </div>
                            </div>
                            <p class="desc">Hi ! My name is Jane Doe. I'm a UI/UX Designer from Paris, in France. I really
                                enjoy photography and mountains.</p>
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
                            <li>Gallery</li>
                            <li>Collections</li>
                            <li>Groups</li>
                            <li>About</li>
                        </ul>
                       <a href="<?php echo base_url('karyawan/')?>"><span class="follow">Back</span></a> 
                        <div class="row gallery">
                            <div class="col-md-4">
                                <img
                                    src="https://images.pexels.com/photos/1036371/pexels-photo-1036371.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                            </div>
                            <div class="col-md-4">
                                <img
                                    src="https://images.pexels.com/photos/861034/pexels-photo-861034.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                            </div>
                            <div class="col-md-4">
                                <img
                                    src="https://images.pexels.com/photos/113338/pexels-photo-113338.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                            <!-- </div>
                            <div class="col-md-4">
                                <img
                                    src="https://images.pexels.com/photos/5049/forest-trees-fog-foggy.jpg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                            </div>
                            <div class="col-md-4">
                                <img
                                    src="https://images.pexels.com/photos/428431/pexels-photo-428431.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                            </div>
                            <div class="col-md-4">
                                <img
                                    src="https://images.pexels.com/photos/50859/pexels-photo-50859.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                            </div> -->
                        </div>
                    </div>
            </main>
        </div>

    <?php endforeach ?>
</body>

</html>
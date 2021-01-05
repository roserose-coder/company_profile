<!DOCTYPE html>
<html lang="en">
<?php 
require_once "../ajaxes/conn.php";
session_start(); ?>

<head>
    <title>BTT-Ban Tjie Tong</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,900" rel="stylesheet">
    <link rel="stylesheet" href="../fonts/icomoon/style.css">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/jquery-ui.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="../css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="../fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="../css/aos.css">

    <link rel="stylesheet" href="../css/style.css">

</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <div class="site-wrap">

        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>

        <div class="top-bar py-3 bg-light" id="home-section">
            <div class="container">
                <div class="row">
                    <div class="col-6 text-left">
                        <ul class="social-media">
                            <li><a href="https://www.facebook.com/ban.tjietong.5" class="p-2"><span class="icon-facebook"></span></a></li>
                            <li><a href="https://instagram.com/bantjietong?igshid=159igfw84gtm8" class="p-2"><span class="icon-instagram"></span></a></li>

                        </ul>
                    </div>
                    <div class="col-6">
                        <p class="mb-0 float-right">
                            <span class="mr-3"><a href="tel:62313537559"> <span class="icon-phone mr-2"></span><span class="d-none d-lg-inline-block">(031)3537559</span></a></span>
                            <span class="mr-3"><a target="_blank" href="https://wa.me/6287764908637?text=Saya%20ingin%20tanya%20obat"> <span class="icon-whatsapp mr-2"></span><span class="d-none d-lg-inline-block">+6287764908637</span></a></span>
                            <span><a href="#"><span class="icon-envelope mr-2"></span><span class="d-none d-lg-inline-block">info@bantjietong.com</span></a></span>
                        </p>

                    </div>
                </div>
            </div>
        </div>

        <header class="site-navbar py-4 bg-white js-sticky-header site-navbar-target" role="banner">

            <div class="container">
                <div class="row align-items-center">

                    <div class="col-6 col-xl-2">
                        <h1 class="mb-0 site-logo"><a href="../index.html" class="text-black h3 mb-0">Ban Tjie Tong<span class="text-primary">.</span> </a></h1>
                    </div>
                    <div class="col-12 col-md-10 d-none d-xl-block">
                        <nav class="site-navigation position-relative text-right" role="navigation">

                            <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                                <li><a onclick="window.location.href='../index.html'" class="nav-link">Halaman Utama</a></li>
                                <li><a onclick="window.location.href='produk.php'" class="nav-link">Produk Shop</a></li>
                                <li><a onclick="window.location.href='../ramuan-shop.html'" class="nav-link">Ramuan Shop</a></li>
                                <li><a href="#contact-section" class="nav-link">Kontak</a></li>

                            </ul>
                        </nav>
                    </div>


                    <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a></div>

                </div>
            </div>

        </header>


        <div class="jumbotron jumbotron-fluid bg-light">
            <div class="container">
                <br><br>

            </div>
        </div>



        <?php
        $idkategori = 0;
        if (isset($_GET["idk"])) {
            $_SESSION["idkat"] = $_GET['idk'];
            $idkategori = $_GET["idk"];
        } 
        ?>
        <!-- START ISI -->


        <section class="site-section" id="blog-section">

            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <div class="col-12 text-center">
                            <a href="produk.php">
                                <h3 class="section-sub-title">Shop</h3>
                            </a>
                            <h2 class="section-title mb-3" id="nama">Product</h2>
                            * Klik <strong>Whatsapp</strong> untuk transaksi via obrolan whatsapp<br>
                            ** Klik <strong>Tokopedia</strong> untuk ditujukan ke link tokopedia kami
                        </div>
                    </div>
                </div>



                <div id="datanya" class="row">

                    <?php
                    $idkat=$_SESSION["idkat"];
                    if (isset($_GET['pageno'])) {
                        $pageno = $_GET['pageno'];
                    } else {
                        $pageno = 1;
                    }
                    $no_of_records_per_page = 10;
                    $offset = ($pageno - 1) * $no_of_records_per_page;

                    $conn =getConn();
                    // Check connection
                    if (mysqli_connect_errno()) {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        die();
                    }

                    $total_pages_sql = "SELECT COUNT(*) FROM barang where kategori='$idkat' and link_tokopedia!=''";
                    $result = mysqli_query($conn, $total_pages_sql);
                    $total_rows = mysqli_fetch_array($result)[0];
                    $total_pages = ceil($total_rows / $no_of_records_per_page);
                    $kal = "";
                    $sql = "SELECT * FROM barang where kategori='$idkat' and link_tokopedia!='' LIMIT $offset, $no_of_records_per_page";
                    $res_data = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($res_data)) {
                        //here goes the data
                        $id = $row["id_barang"];
                        $nama = $row["nama_barang"];
                        $topedlink = $row["link_tokopedia"];
                        $gambar = "https://bantjietong.com/storeimage/obt-img/" . $row["link_gambar1"];
                        $kal .= " <div class='col-sm-6'>
                    <div class='card'>
                        <img class='card-img-top' src='$gambar' alt='Card image cap'>

                        <div class='card-body'>
                            <h5 class='card-title text-primary'>$nama</h5>
                            <p class='card-text'>Tim ayam obat ,kuah agak manis</p>
                        </div>

                        <div class='card-body'>
                            <a href='https://wa.me/6287764908637?text=Saya%20ingin%20pesan%20(Tun Cie)' target='_blank' class='card-link text-primary btn btn-secondary'>Whatsapp*</a>
                            <a href='$topedlink' class='card-link text-primary btn btn-secondary'>Tokopedia **</a>
                        </div>
                    </div>
                </div>";
                    }
                    echo $kal;
                    mysqli_close($conn);
                    ?>


                </div>

            </div>

            <nav>

              <ul class="pagination" >
        <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a class="page-link" href="<?php if($pageno <= 1){ echo "#"; } else { echo "kategori.php?idk=$idkat&pageno=".($pageno - 1); } ?>"><</a>
        </li>
        <li class="page-item">
          <a class="page-link"><strong><?php echo $_GET["pageno"];?></strong></a> 
        </li>
        <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a class="page-link" href="<?php if($pageno >= $total_pages){ echo "#"; } else { echo "kategori.php?idk=$idkat&pageno=".($pageno + 1); } ?>">></a>
        </li>
    </ul>
            </nav>

    </div>
    </section>



    <!---END ISI-->

    <?php
    require_once "bottompart.php";
    ?>

    <script>
        $.post("../ajaxes/a_kategori.php", {
            kind: "loadpage"
        }, function(data) {
            console.log(data);
            var arr = JSON.parse(data);
            $("#pagingnya").html(arr.data);
            $("#nama").html(arr.namakat);
        });

        function loadpage(hal) {
            $.post("../ajaxes/a_kategori.php", {
                kind: "loaddata",
                page: hal,
                idk: "<?php echo "$idkategori"; ?>"
            }, function(data) {
                var arr = JSON.parse(data);
                $("datanya").html(arr.data);
            });
        }

        loadpage("1");

        // $.post("../ajaxes/a_kategori.php", {
        //     kind: "getitemfromkat",
        // }, function(data) {
        //     var arr = JSON.parse(data);
        //     $("#datanya").html(arr.data);
        // });
    </script>
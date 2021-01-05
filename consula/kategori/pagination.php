<html>
<head>
    <title>Pagination</title>
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <?php

        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 10;
        $offset = ($pageno-1) * $no_of_records_per_page;

        $conn=mysqli_connect("localhost","root","","bantjietstore");
        // Check connection
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            die();
        }

        $total_pages_sql = "SELECT COUNT(*) FROM barang";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);
$kal="";
        $sql = "SELECT * FROM barang LIMIT $offset, $no_of_records_per_page";
        $res_data = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($res_data)){
            //here goes the data
            $id = $row["id_barang"];
            $nama = $row["nama_barang"];
            $gambar ="https://bantjietong.com/storeimage/obt-img/".$row["link_gambar1"];
            $kal.= " <div class='col-sm-6'>
                            <div class='card'>
                                <img class='card-img-top' src='$gambar' alt='Card image cap'>
    
                                <div class='card-body'>
                                    <h5 class='card-title text-primary'>$nama</h5>
                                    <p class='card-text'>Tim ayam obat ,kuah agak manis</p>
                                </div>
    
                                <div class='card-body'>
                                    <a href='https://wa.me/6287764908637?text=Saya%20ingin%20pesan%20(Tun Cie)' target='_blank' class='card-link text-primary btn btn-secondary'>Whatsapp*</a>
                                    <a href='https://www.tokopedia.com/bantjietong/etalase/ramuan' class='card-link text-primary btn btn-secondary'>Tokopedia **</a>
                                </div>
                            </div>
                        </div>";
        }
        echo $kal;
        mysqli_close($conn);
    ?>
    <ul class="pagination">
        <li><a href="?pageno=1"><<</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"><</a>
        </li>
        <li>
          <a href=""><strong><?php echo $_GET["pageno"];?></strong></a> 
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">></a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>">>></a></li>
    </ul>
</body>
</html>
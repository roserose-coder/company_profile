<?php
require_once "conn.php";
session_start();
if ($_POST["kind"] == "jumkat") {

    $conn = getConn();

    $stmt = $conn->prepare("SELECT k.id_kategori as idk,k.nama_kategori as kat,COUNT(b.id_barang) as jum
        FROM kategori k,barang b
        WHERE b.kategori=k.id_kategori and length(b.link_tokopedia)>5
        GROUP BY b.kategori");
    // $stmt->bind_param('ss', $u,$p);
    // $u=$arrdecoded->u;
    // $p=sha1($arrdecoded->p);

    $stmt->execute();
    $result = $stmt->get_result();

    $arr = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //cara membuat dan membaca
            $idkat = $row["idk"];
            $kat = $row["kat"];
            $qty = $row["jum"];
            $arr[$idkat] = $qty;
        }

        $res = array("status" => 1, "data" => $arr);
    } else {

        $res = array("status" => 0, "data" => "Username atau Password yang dimasukan salah !", "link" => "");
    }

    echo json_encode($res);

    $conn->close();
} else if ($_POST["kind"] == "loadkategori") {

    $conn = getConn();

    $stmt = $conn->prepare("SELECT k.id_kategori as idk,k.nama_kategori as kat,COUNT(b.id_barang) as jum
        FROM kategori k,barang b
        WHERE b.kategori=k.id_kategori 
        GROUP BY b.kategori");
    // $stmt->bind_param('ss', $u,$p);
    // $u=$arrdecoded->u;
    // $p=sha1($arrdecoded->p);

    $stmt->execute();
    $result = $stmt->get_result();

    $kal = "";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //cara membuat dan membaca
            $idkat = $row["idk"];
            $kat = ucwords($row["kat"]);
            $qty = $row["jum"];
            $kal .= "<a href='kategori.php?idk=$idkat&pageno=1' class='border pl-1 pr-1 mr-1 ml-1 mb-1 mt-1 rounded text-dark'>$kat <span id='k_$idkat' class='badge badge-secondary'>$qty</span></a>";
        }
    } else {
        $kal = "tidak ada barang pada setiap kategori";
    }
    $res = array("status" => 1, "data" => $kal);
    echo json_encode($res);

    $conn->close();
} else if ($_POST["kind"] == "loadpage") {
    $conn = getConn();
    $k = $_SESSION["idkat"];

    $stmt1 = $conn->prepare("select * from kategori where id_kategori=?");
    $stmt1->bind_param('s', $k);

    $stmt1->execute();
    $result1 = $stmt1->get_result();

    while ($row1 = $result1->fetch_assoc()) {
        //cara membuat dan membaca
        $nama = $row1["nama_kategori"];
    }

    $stmt = $conn->prepare("select * from barang where kategori=? and tokopedia_btt='2'");
    $stmt->bind_param('s', $k);
    $stmt->execute();
    $result = $stmt->get_result();
    $kal = "";
    $jumperpage = 6;
    $jum = 0;
    $arrid = [];

    if ($result->num_rows > 0) {
        //cara membuat dan membaca
        $ids = $result;
        $arrid = [];
        $arr = [];
        $count = $result->num_rows;

        if ($count % $jumperpage == 0) {
            $jum = $count / $jumperpage;
        } else {
            $jum = $count / $jumperpage + 1;
        }

        while ($row = $result->fetch_assoc()) {
            //cara membuat dan membaca
            $idbar = $row["id_barang"];
            array_push($arrid, $idbar);
        }

        $arrperpage = [];
        $page = 0;

        for ($i = 0; $i < $jum; $i++) {
        }


        for ($i = 1; $i <= count($arrid); $i++) {
            if ($i % 6 == 0) {
            } else {
            }
        }

        $arr = array(
            "1" => $arrperpage[0],
            "2" => $arrperpage[1],
            "3" => $arrperpage[2],
            "4" => $arrperpage[3],
            "5" => $arrperpage[4],
            "6" => $arrperpage[5]
        );
    } else {
        $jum = 0;
    }

    for ($i = 1; $i <= $jum; $i++) {
        $kal .= "<li class='page-item'><a class='page-link' onclick=\"gotopage('$i')\">$i</a></li>";
    }

    $res = array("status" => 1, "data" => $kal, "namakat" => $nama);
    echo json_encode($res);

    $conn->close();
} else if ($_POST["kind"] == "getitemfromkat") {
    if (isset($_SESSION["idkat"])) {
        $idkat = $_SESSION["idkat"];
    }
    $kal = "";
    $conn = getConn();
    $sql = "select * from barang where kategori='$idkat'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
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
    $arr=array("status"=>"1","data"=>$kal);
    echo json_encode($arr);
}

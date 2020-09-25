<?php
require_once "toppart_produk.php";
?>
<!-- START ISI -->

<section class="site-section" id="blog-section">
  <div class="container">
    <div class="row mb-5">
      <div class="col-12 text-center">
        <h3 class="section-sub-title">shop</h3>
        <h2 class="section-title mb-3">Produk</h2>
        
        
      </div>
    </div>

    <div class="row mb-3">
      <strong>Kategori</strong> 
      <div class="d-flex flex-wrap" id="loadkategori">
        <!-- isi ajax -->
      </div>
    </div>

    *  Klik <strong>Whatsapp</strong> untuk transaksi via obrolan whatsapp<br>
        ** Klik <strong>Tokopedia</strong> untuk ditujukan ke link tokopedia kami


  <div class="row">
    <!-- ajax isi barang -->
  </div>
   
</div>

    

  </div>
</section>

<!---END ISI-->

<?php
require_once "bottompart.php";
?>

<script>
 $.post("../ajaxes/a_kategori.php", {
        kind: "jumkat",
    }, function(data) {
        console.log(data);
    });

  $.post("../ajaxes/a_kategori.php", {
      kind: "loadkategori",
  }, function(data) {
    var arr=JSON.parse(data);

      $("#loadkategori").html(arr.data);
  });
</script>
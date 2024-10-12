<?php 
session_start();
if(!isset($_SESSION["login"])){
    include 'layout/header-guest.php';
} else include 'layout/header.php';

if (isset($_GET['id_review'])) {
    $id_review = (int)$_GET['id_review'];
} else {
    echo "<script>
            alert('ID review tidak ditemukan');
            document.location.href = 'index.php';
          </script>";
    exit;
}

// Pastikan query SQL Anda mengambil data dari kedua tabel, review_film dan users
$review = select("SELECT review_film.*, users.username FROM review_film 
                  JOIN users ON review_film.user_id = users.user_id 
                  WHERE review_film.id_review = $id_review")[0];
?>
<style>
  #konten{
    min-height: 100vh;  
    position: relative;
    z-index: 1;
    color: white;
  }
  /* Overlay to darken the background */
  .overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.7), rgba(0,0,0,0.2));
    z-index: 0;
  }
  /* Ensure text is above the overlay */
  .content {
    position: relative;
    z-index: 2;
  }
</style>

<!-- Outer div with background gradient -->
<div style="background: linear-gradient(to bottom, #000000, #FFFFFF); position: relative;">
  <!-- Overlay to maintain text readability -->
  <div class="overlay"></div>

  <!-- Container with content -->
  <div class="container-konten p-5" id="konten">

    <div class="row content">
      <div class="col-md-4">
        <!-- Poster -->
        <img src="./foto/foto-film/<?= $review['foto_film']; ?>" class="img-fluid" alt="Poster for <?= $review['judul_film']; ?>" />
        <span class="badge bg-secondary">TONTON SEKARANG</span>
      </div> 
      
      <div class="col-md-8"> 
        <!-- Menampilkan nama user yang menambahkan review -->
        <h2>Review oleh <?= $review['username']; ?></h2>
        <small><?= date('d F Y', strtotime($review['tanggal'])); ?></small>
        <hr style="border-color: white;"> <!-- Garis -->
        <h1 class="display-4"><strong><?= $review['judul_film'] ?></strong></h1> 

        <h4 style="color: green;"><?= $review['rating']; ?>/10</h4> 
       
        <!-- Ulasan -->
        <p class="lead"><?= $review['ulasan']; ?></p>
        <!-- Tombol review -->
        <a href="tambah-review.php" class="btn btn-primary mt-3">Berikan Review Anda</a>
      </div>
    </div>
  </div>
</div>

<?php
session_start();
include 'layout/header.php';

// Check if form is submitted
if (isset($_POST['tambah'])) {
    // You can validate the data here before calling create_review()
    
    // Call the function to create the review
    if (create_review($_POST) > 0) {
        echo "<script>
                alert('Berhasil ditambahkan');
                document.location.href = 'daftar-review.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal ditambahkan');
                document.location.href = 'daftar-review.php';
              </script>";
    }
}

?>

<div class="container">
    <h1 class="mt-5">Review Film</h1>
    <hr>

    <h2 class="mt-5">Ulasan Film</h2>
    <form action="" method="post" class="mt-5" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="judul" class="form-label">Judul Film</label>
            <input type="text" class="form-control" id="judul" name="judul" placeholder="Tambahkan judul" required>
        </div>

        <div class="mb-3">
            <label for="genre" class="form-label">Genre</label>
            <input type="text" class="form-control" id="genre" name="genre" placeholder="Tambahkan genre" required>
        </div>



        <div class="mb-3">
            <label for="ulasan" class="form-label">Tulis Ulasan</label>
            <textarea class="form-control" id="ulasan" name="ulasan" rows="4" placeholder="Tambahkan ulasan"
                required></textarea>
        </div>

        <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <select class="form-control" id="rating" name="rating" required>
                <option value="" disabled selected>Pilih rating</option>
                <?php 
                // Generate options for rating from 1 to 10
                for ($i = 1; $i <= 10; $i++) {
                    echo "<option value=\"$i\">$i</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control" id="foto_film" name="foto_film" placeholder="Tambahkan Foto..." onchange="previewImg()"
                required>

            <img src="" class="img-thumbnail img-preview" alt="" width="500px">
        </div>

        <button type="submit" name="tambah" id="tambah" class="btn btn-success" style="float: right">Kirim
            Ulasan</button>
    </form>
</div>

<script>
    function previewImg() {
        const foto_film = document.querySelector('#foto_film');
        const imgPreview = document.querySelector('.img-preview');

        const fileFotoFilm = new FileReader();
        fileFotoFilm.readAsDataURL(foto_film.files[0]);

        fileFotoFilm.onload = function(e){
            imgPreview.src = e.target.result;
        }
    }
    </script>
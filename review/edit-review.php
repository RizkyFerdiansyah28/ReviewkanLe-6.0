<?php 
session_start();

include 'layout/header.php';

// Check if id_review is set in the URL
if (isset($_GET['id_review'])) {
    $id_review = (int)$_GET['id_review'];
} else {
    echo "<script>
            alert('ID review tidak ditemukan');
            document.location.href = 'index.php';
          </script>";
    exit;
}

// Fetch the review data for the given id_review
$review = select("SELECT * FROM review_film WHERE id_review = $id_review")[0];

// Check if review data is found
if (!$review) {
    echo "<script>
            alert('Data ulasan tidak ditemukan');
            document.location.href = 'index.php';
          </script>";
    exit;
}


// Check if form is submitted
if (isset($_POST['ubah'])) {
    // Call the function to update the review
    if (update_review($_POST, $id_review) > 0) {
        echo "<script>
                alert('Berhasil diubah');
                document.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal diubah');
                document.location.href = 'index.php';
              </script>";
    }
}

?>

<div class="container">
    <h1 class="mt-5">Review Film</h1>
    <hr>

    <h2 class="mt-5">Edit Ulasan Film</h2>
    <form action="" method="post" class="mt-5" enctype="multipart/form-data">
        <input type="hidden" name="id_review" value="<?= $review['id_review']; ?>">
        <input type="hidden" name="foto_film_lama" value="<?= $review['foto_film']; ?>">
        <div class="mb-3">
            <label for="judul" class="form-label">Judul Film</label>
            <input type="text" class="form-control" id="judul" name="judul" placeholder="Tambahkan judul" value="<?= $review['judul_film']; ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="genre" class="form-label">Genre</label>
            <input type="text" class="form-control" id="genre" name="genre" placeholder="Tambahkan genre" value="<?= $review['genre']; ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="ulasan" class="form-label">Tulis Ulasan</label>
            <textarea class="form-control" id="ulasan" name="ulasan" rows="4" placeholder="Tambahkan ulasan" required><?= $review['ulasan']; ?></textarea>
        </div>
        
        <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <select class="form-control" id="rating" name="rating" required>
                <option value="" disabled>Pilih rating</option>
                <?php 
                // Generate options for rating from 1 to 10 and mark the current rating as selected
                for ($i = 1; $i <= 10; $i++) {
                    $selected = ($i == $review['rating']) ? 'selected' : '';
                    echo "<option value=\"$i\" $selected>$i</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control" id="foto_film" name="foto_film" placeholder="Tambahkan Foto..." onchange="previewImg()"
            >

            <img src="./foto/foto-film/<?= $review['foto_film']; ?>" class="img-thumbnail img-preview" alt="" width="500px">
        </div>
        
        <button type="submit" name="ubah" id="ubah" class="btn btn-success" style="float: right">Ubah Ulasan</button>
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

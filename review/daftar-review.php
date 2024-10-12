<?php 
session_start();

include 'layout/header.php';

if(!isset($_SESSION["login"])){
    echo "<script>alert('Anda belum login');
    document.location.href = 'login.php';
    </script>";
    exit;
}

// Ambil user_id dari session
$user_id = $_SESSION['user_id'];

// Query untuk mendapatkan review yang hanya ditambahkan oleh pengguna yang sedang login
$data_review = select("SELECT * FROM review_film WHERE user_id = '$user_id'");

?>

<div class="container mt-5">
    <h1>ReviewkanLe</h1>
    <a href="tambah-review.php" class="btn btn-success "> Tambah</a>

    <table class="table table-striped table-bordered mt-3 "  id="table">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Judul</th>
                <th class="text-center">Tanggal Rilis</th>
                <th class="text-center">Genre</th>
                <th class="text-center">Rating</th>
                <th class="text-center">Poster</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1;?>
            <?php foreach ($data_review as $review) : ?>
            <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td class="text-center"><?= $review['judul_film']; ?></td>
                <td class="text-center"><?= date('d F Y', strtotime($review['tanggal'])); ?></td>
                <td class="text-center"><?= $review['genre']; ?></td>
                <td class="text-center"><?= $review['rating']; ?></td>
                <td class="text-center"><img src="./foto/foto-film/<?= $review['foto_film']; ?>" width="150px"></td>
                <td width="15%" class="text-center">
                    <a href="edit-review.php?id_review=<?= $review['id_review']; ?>" class="btn btn-primary">Edit</a>
                    <a href="hapus-review.php?id_review=<?= $review['id_review']; ?>" class="btn btn-danger"
                        onclick="return confirm('Apakah anda yakin untuk menghapus review')">Hapus</a>
                </td>
            </tr>
            <?php  endforeach; ?>
        </tbody>
    </table>
</div>

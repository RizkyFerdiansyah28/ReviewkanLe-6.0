<?php 
session_start();

if(!isset($_SESSION["login"])){
    include 'layout/header-guest.php';
} else include 'layout/header.php';

?>

<style>
    a {
    text-decoration: none;
}
</style>

<div class="container mt-5">
    <h1>Cari Film</h1>
    <table class="table table-striped table-bordered mt-3 "  id="table">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Judul</th>
                <th class="text-center">Tanggal Rilis</th>
                <th class="text-center">Rating</th>
                <th class="text-center">poster</th>
                
            </tr>
        </thead>

        <tbody>
            <?php $no = 1;?>
            <?php foreach ($data_review as $review) : ?>
            <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td class="text-center"><a class="text-dark "href="detail-review.php?id_review=<?= $review['id_review']; ?>"><?= $review['judul_film']; ?></a></td>
                <td class="text-center"><?= date('d F Y', strtotime($review['tanggal'])); ?></td>
                <td class="text-center"><?= $review['rating']; ?>/10</td>
                <td class="text-center"><img src="./foto/foto-film/<?= $review['foto_film']; ?>" width="150px"></td>
            </tr>
            <?php  endforeach; ?>
        </tbody>
    </table>
</div>
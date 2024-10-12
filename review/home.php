<?php
session_start();
if (!isset($_SESSION["login"])) {
    include 'layout/header-guest.php';
} else {
    include 'layout/header.php';
}


// Fungsi untuk mengurutkan berdasarkan tanggal
function sortByDate($a, $b) {
    return strtotime($b['tanggal']) - strtotime($a['tanggal']);
}

// Fungsi untuk mengurutkan berdasarkan rating
function sortByRating($a, $b) {
    return $b['rating'] - $a['rating'];
}

// Cek metode pengurutan yang dipilih oleh pengguna
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'tanggal'; // default ke tanggal

if ($sort_by == 'rating') {
    usort($data_review, 'sortByRating');
} else {
    usort($data_review, 'sortByDate');
}
?>

<!-- Section Carousel Full Width -->
<section id="carouselExampleIndicators" class="carousel slide text-center position-relative" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <!-- Slide 1 -->
        <div class="carousel-item active">
            <img src="./foto/sryan.jpg" class="d-block w-100" alt="Gambar 1" style="filter: brightness(0.7) contrast(1.2); height: 400px; object-fit: cover;">
            <div class="carousel-caption d-none d-md-block">
                <div class="overlay-text">
                    <h1 class="fw-light">Jelajahi Film dan Beritahu Temanmu</h1>
                    <p class="lead">Komunitas untuk pecinta film</p>
                </div>
            </div>
        </div>
        <!-- Slide 2 -->
        <div class="carousel-item">
            <img src="./foto/nc.jpg" class="d-block w-100" alt="Gambar 2" style="filter: brightness(0.7) contrast(1.2); height: 400px; object-fit: cover;">
            <div class="carousel-caption d-none d-md-block">
                <div class="overlay-text">
                    <h1 class="fw-light">Film Terbaik Tahun Ini</h1>
                    <p class="lead">Lihat ulasan dari komunitas</p>
                </div>
            </div>
        </div>
        <!-- Slide 3 -->
        <div class="carousel-item">
            <img src="./foto/tgd.jpg" class="d-block w-100" alt="Gambar 3" style="filter: brightness(0.7) contrast(1.2); height: 400px; object-fit: cover;">
            <div class="carousel-caption d-none d-md-block">
                <div class="overlay-text">
                    <h1 class="fw-light">Bergabung dengan Diskusi Film</h1>
                    <p class="lead">Tukar pendapat dengan teman-temanmu</p>
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</section>

           

<main>
    <div class="container">
        <div class="d-flex justify-content-center mb-4">
            <a href="?sort_by=tanggal" class="btn btn-primary <?php if ($sort_by == 'tanggal') echo 'active'; ?>">Urutkan Berdasarkan Tanggal</a>
            <a href="?sort_by=rating" class="btn btn-primary ms-2 <?php if ($sort_by == 'rating') echo 'active'; ?>">Urutkan Berdasarkan Rating</a>
        </div>

        <div class="album py-3 bg-body-tertiary">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                    <?php foreach ($data_review as $review) : ?>
                    <div class="col">
                        <div class="card shadow-sm h-100">
                        <img src="./foto/foto-film/<?= $review['foto_film']; ?>" class="bd-placeholder-img card-img-top" alt="" style="width: 100%; height: 225px; object-fit: contain;" />

                            <div class="card-body">
                                <h4><?= $review['judul_film']; ?></h4>
                                <p class="card-text">
                                    <?= (strlen($review['ulasan']) > 100) ? substr($review['ulasan'], 0, 100) . '...' : $review['ulasan']; ?>
                                </p>
                                <small class="text-body-secondary">Rating: <?=($review['rating']); ?>/10</small>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <a href="detail-review.php?id_review=<?= $review['id_review']; ?>" class="btn btn-sm btn-outline-primary">Baca Selengkapnya</a>
                                    <small class="text-muted"><?= date('d F Y', strtotime($review['tanggal'])); ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    .card-text {
        max-height: 75px;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }
    main {
        background-color: #14181C;
        color: white;
        padding: 20px 0;
    }
    .album {
        padding: 3rem 0;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }
    .btn-outline-primary {
        color: #1e7e34;
        border-color: #1e7e34;
    }
    .btn-outline-primary:hover {
        background-color: #1e7e34;
        color: white;
    }
    .card {
        border-radius: 10px;
        transition: transform 0.3s ease;
    }
    .card:hover {
        transform: scale(1.05);
    }
</style>

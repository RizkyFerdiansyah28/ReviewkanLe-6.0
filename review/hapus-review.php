<?php 
session_start();

include 'config/app.php';

//mengambil data yang akan dihapus
$id_review = (int)$_GET['id_review'];

if(delete_review($id_review) > 0){
   echo "<script>
        alert ('Data berhasil dihapus');
        document.location.href = 'daftar-review.php';
   </script>";
}else{
    echo "<script>
        alert ('Data gagal dihapus');
        document.location.href = 'daftar-review.php';
   </script>";
}

?>
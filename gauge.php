<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id == 1) {
        // Contoh nilai random untuk gauge pertama (0-25)
        $nilai = rand(0, 15);
    } elseif ($id == 2) {
        // Contoh nilai random untuk gauge kedua (800-1350)
        $nilai = rand(0, 800);
    } else {
        // Jika ID tidak valid, kirimkan data kosong
        $nilai = null;
    }
} else {
    // Jika ID tidak diberikan, kirimkan data kosong
    $nilai = null;
}

$my_data = array();
$my_data['nilai'] = $nilai;
$my_data['chart'] = $nilai;
echo json_encode($my_data);
?>

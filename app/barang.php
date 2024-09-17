<?php

require_once 'database.php';


if (isset($_POST['saveBarang'])) {
    $name = $_POST['name'];
    $stock = $_POST['stock'];
    $id_kategori = $_POST['id_kategori'];

    $stmt = $conn->prepare("INSERT INTO barang (name, stock, id_kategori) VALUES (?,?,?)");
    $stmt->bind_param('sii', $name, $stock, $id_kategori);

    $resultMessage = 'Gagal menyimpan barang';
    if ($stmt->execute()) {
        $resultMessage = 'Berhasil menyimpan barang';
    }

    header('Location: ../index.php?message=' . $resultMessage);
    exit();
}

if (isset($_POST['updateBarang'])) {
    $name = $_POST['name'];
    $stock = $_POST['stock'];
    $id_kategori = $_POST['id_kategori'];
    $id_barang = $_POST['id_barang'];

    $stmt = $conn->prepare("UPDATE barang SET name = ?, stock = ?, id_kategori = ? WHERE id_barang = ?");
    $stmt->bind_param('siii', $name, $stock, $id_kategori, $id_barang);

    $resultMessage = 'Gagal update barang';
    if ($stmt->execute()) {
        $resultMessage = 'Berhasil update barang';
    }

    header('Location: ../index.php?message=' . $resultMessage);
    exit();
}


if (isset($_POST['deleteBarang'])) {
    $id_barang = $_POST['id_barang'];

    $stmt = $conn->prepare("DELETE FROM barang WHERE id_barang = ?");
    $stmt->bind_param('i', $id_barang);

    $resultMessage = 'Gagal delete barang';
    if ($stmt->execute()) {
        $resultMessage = 'Berhasil delete barang';
    }

    header('Location: ../index.php?message=' . $resultMessage);
    exit();
}

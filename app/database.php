<?php

$conn = new mysqli('localhost', 'root', '', 'gudang');

if ($conn->connect_error) {
    die("Koneksi gagal : $conn->connect_error");
} else {
    // 
}

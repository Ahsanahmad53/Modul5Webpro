<?php

$harga_menu = array (
    "makanan" =>  array ("Pecel" => 10000,
            "Nasi Kuning" => 12000,
            "Nasi Goreng" => 15000,
            "Spaghetti" => 20000),
    "minuman" => array ("Air Mineral" => 3000,
            "Cendol" => 5000,
            "Es Kopi" => 7000,
            "Es Teh" => 2500)
);



function Cek_keberadaanMakan($nama_makan) {
    global $harga_menu;
    return array_key_exists($nama_makan, $harga_menu["makanan"]);
}

function Cek_keberadaanMinum($nama_minum) {
    global $harga_menu;
    return array_key_exists($nama_minum, $harga_menu["minuman"]);
}

function Hitung_subtotalhargamakanan($nama_makan, $jumlah_makan) {
    global $harga_menu;
    return $harga_menu["makanan"][$nama_makan] * $jumlah_makan;
}


function Hitung_subtotalhargaminuman($nama_minum, $jumlah_minum) {
    global $harga_menu;
    return $harga_menu["minuman"][$nama_minum] * $jumlah_minum;
}

function Hitung_totalhargamakanan($nama_makan, $jumlah_makan, $nama_minum, $jumlah_minum) {
    return Hitung_subtotalhargamakanan($nama_makan, $jumlah_makan) + Hitung_subtotalhargaminuman($nama_minum, $jumlah_minum);
}


if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $nama_makan = $_POST['makanan'];
    $jumlah_makan = $_POST['jumlah_makan'];
    $nama_minum = $_POST['minuman'];
    $jumlah_minum = $_POST['jumlah_minuman'];

    if(Cek_keberadaanMakan($nama_makan) and Cek_keberadaanMinum($nama_minum)){
        $subtotal_hargamakanan = Hitung_subtotalhargamakanan($nama_makan, $jumlah_makan);
        $subtotal_hargaminuman = Hitung_subtotalhargaminuman($nama_minum, $jumlah_minum);
        $Hitung_totalhargamakanan = Hitung_totalhargamakanan($nama_makan, $jumlah_makan, $nama_minum, $jumlah_minum);
        echo "Detail  Pesanan Anda : Makanan : $nama_makan Jumlah: $jumlah_makan\n <br> Minuman :$nama_minum, Jumlah: $jumlah_minum\n<br>";
        echo "Subtotal Harga Makanan Anda adalah: Rp". number_format($subtotal_hargamakanan,0)."<br>";
        echo "Subtotal Harga Minuman Anda adalah: Rp". number_format($subtotal_hargaminuman,0)."<br>";
        echo "Total Harga Semua Makanan dan Minuman Anda adalah: Rp". number_format($Hitung_totalhargamakanan,0)."<br>";
    
    }else{
        echo "Tolong Masukkan Menu Makanan atau Minuman yang benar";
    }

}

?>
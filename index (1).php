<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Penghitung Nilai Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f4f8;
            padding: 25px;
        }
        h1, h3 {
            text-align: center;
        }
        .kartu {
            background: white;
            max-width: 600px;
            margin: 15px auto;
            padding: 15px 25px;
            border-radius: 6px;
            box-shadow: 0 1px 5px rgba(0,0,0,0.15);
        }
        .error {
            color: #b71c1c;
        }
        .ringkasan {
            max-width: 600px;
            margin: 20px auto;
            text-align: center;
        }
    </style>
</head>
<body>

<?php

const BOBOT_TUGAS = 0.3;
const BOBOT_UTS = 0.3;
define("BOBOT_UAS", 0.4);
define("NAMA_KAMPUS", "Universitas Lampung");

$jumlahMahasiswa = 0;
$jumlahLulus = 0;

function hitungNilaiAkhir($tugas, $uts, $uas) {
    $hasil = ($tugas * BOBOT_TUGAS) + ($uts * BOBOT_UTS) + ($uas * BOBOT_UAS);
    return $hasil;
}

function tentukanGrade($nilaiAkhir) {
    if ($nilaiAkhir >= 85) {
        $grade = "A";
    } elseif ($nilaiAkhir >= 75) {
        $grade = "B";
    } elseif ($nilaiAkhir >= 65) {
        $grade = "C";
    } elseif ($nilaiAkhir >= 50) {
        $grade = "D";
    } else {
        $grade = "E";
    }
    return $grade;
}

function tentukanStatus($nilaiAkhir) {
    if ($nilaiAkhir >= 65) {
        return "Lulus";
    } else {
        return "Tidak Lulus";
    }
}

function tentukanPredikat($nilaiAkhir) {
    if ($nilaiAkhir >= 85) {
        $predikat = "Sangat Baik";
    } elseif ($nilaiAkhir >= 75) {
        $predikat = "Baik";
    } elseif ($nilaiAkhir >= 65) {
        $predikat = "Cukup";
    } elseif ($nilaiAkhir >= 50) {
        $predikat = "Kurang";
    } else {
        $predikat = "Sangat Kurang";
    }
    return $predikat;
}

function nilaiValid($nilai) {
    if ($nilai < 0) {
        return false;
    }
    if ($nilai > 100) {
        return false;
    }
    return true;
}

function nomorUrut() {
    static $urut = 0;
    $urut++;
    return $urut;
}

function tampilkanMahasiswa($nama, $nim, $tugas, $uts, $uas) {
    global $jumlahMahasiswa;
    global $jumlahLulus;

    $no = nomorUrut();

    echo "<div class='kartu'>";
    echo "<h3>" . $no . ". " . $nama . " (" . $nim . ")</h3>";

    if (!nilaiValid($tugas) || !nilaiValid($uts) || !nilaiValid($uas)) {
        echo "<p class='error'>Nilai tidak valid, harus di antara 0 sampai 100.</p>";
        echo "<p>Tugas: " . $tugas . "<br>UTS: " . $uts . "<br>UAS: " . $uas . "</p>";
    } else {
        $nilaiAkhir = hitungNilaiAkhir($tugas, $uts, $uas);
        $grade = tentukanGrade($nilaiAkhir);
        $status = tentukanStatus($nilaiAkhir);
        $predikat = tentukanPredikat($nilaiAkhir);

        echo "<p>Nilai Tugas: " . $tugas . "</p>";
        echo "<p>Nilai UTS: " . $uts . "</p>";
        echo "<p>Nilai UAS: " . $uas . "</p>";
        echo "<p>Nilai Akhir: " . $nilaiAkhir . "</p>";
        echo "<p>Grade: " . $grade . "</p>";
        echo "<p>Predikat: " . $predikat . "</p>";
        echo "<p>Status: " . $status . "</p>";

        $jumlahMahasiswa++;
        if ($status == "Lulus") {
            $jumlahLulus++;
        }
    }

    echo "</div>";
}

$nama1 = "Andi";
$nim1 = "231234567";
$tugas1 = 80;
$uts1 = 75;
$uas1 = 90;

$nama2 = "Siti Rahma";
$nim2 = "231234568";
$tugas2 = 60;
$uts2 = 55;
$uas2 = 70;

$nama3 = "Budi Santoso";
$nim3 = "231234569";
$tugas3 = 45;
$uts3 = 40;
$uas3 = 50;

$nama4 = "Dewi Lestari";
$nim4 = "231234570";
$tugas4 = 90;
$uts4 = 120;
$uas4 = 85;

?>

<h1>Data Nilai Mahasiswa</h1>
<h3><?php echo NAMA_KAMPUS; ?></h3>

<?php
tampilkanMahasiswa($nama1, $nim1, $tugas1, $uts1, $uas1);
tampilkanMahasiswa($nama2, $nim2, $tugas2, $uts2, $uas2);
tampilkanMahasiswa($nama3, $nim3, $tugas3, $uts3, $uas3);
tampilkanMahasiswa($nama4, $nim4, $tugas4, $uts4, $uas4);

$jumlahTidakLulus = $jumlahMahasiswa - $jumlahLulus;
?>

<div class="ringkasan">
    <p>Mahasiswa yang berhasil dihitung: <?php echo $jumlahMahasiswa; ?></p>
    <p>Lulus: <?php echo $jumlahLulus; ?> | Tidak Lulus: <?php echo $jumlahTidakLulus; ?></p>
</div>

</body>
</html>

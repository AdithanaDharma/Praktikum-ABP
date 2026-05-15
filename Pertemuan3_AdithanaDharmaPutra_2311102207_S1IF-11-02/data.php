<?php
function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

function tentukanGrade($nilai_akhir) {
    if ($nilai_akhir >= 85) {
        return 'A';
    } elseif ($nilai_akhir >= 70) {
        return 'B';
    } elseif ($nilai_akhir >= 55) {
        return 'C';
    } elseif ($nilai_akhir >= 40) {
        return 'D';
    } else {
        return 'E';
    }
}

function tentukanStatus($nilai_akhir) {
    if ($nilai_akhir >= 60) {
        return "Lulus";
    } else {
        return "Tidak Lulus";
    }
}

$mahasiswa = [
    [
        "nama" => "Adithana Dharma Putra",
        "nim" => "2311102207",
        "tugas" => 85,
        "uts" => 90,
        "uas" => 88
    ],
    [
        "nama" => "Budi Santoso",
        "nim" => "2311102208",
        "tugas" => 60,
        "uts" => 55,
        "uas" => 50
    ],
    [
        "nama" => "Citra Lestari",
        "nim" => "2311102209",
        "tugas" => 95,
        "uts" => 80,
        "uas" => 90
    ],
    [
         "nama" => "Dewi Maharani",
         "nim" => "2311102210",
         "tugas" => 75,
         "uts" => 80,
         "uas" => 70
    ]
];

?>

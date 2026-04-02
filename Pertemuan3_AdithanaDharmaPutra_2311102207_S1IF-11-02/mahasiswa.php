<?php
require_once 'data.php';

$total_nilai_kelas = 0;
$nilai_tertinggi = 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light pb-5">

<div class="container-fluid px-4 py-3">
    <div class="mb-4">
        <h2 class="text-center text-dark fw-bold">Daftar Nilai Mahasiswa</h2>
    </div>
    
    <div class="table-responsive border rounded shadow-sm bg-white">
                <table class="table table-striped table-hover align-middle text-center mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3">No</th>
                            <th class="py-3">Nama</th>
                            <th class="py-3">NIM</th>
                            <th class="py-3">Nilai Tugas</th>
                            <th class="py-3">Nilai UTS</th>
                            <th class="py-3">Nilai UAS</th>
                            <th class="py-3">Nilai Akhir</th>
                            <th class="py-3">Grade</th>
                            <th class="py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($mahasiswa as $mhs) {
                            $nilai_akhir = hitungNilaiAkhir($mhs['tugas'], $mhs['uts'], $mhs['uas']);
                            $grade = tentukanGrade($nilai_akhir);
                            $status = tentukanStatus($nilai_akhir);

                            $total_nilai_kelas += $nilai_akhir;

                            if ($nilai_akhir > $nilai_tertinggi) {
                                $nilai_tertinggi = $nilai_akhir;
                            }
                            
                            $status_badge = ($status == "Lulus") ? "<span class='badge bg-success rounded-pill px-3'>Lulus</span>" : "<span class='badge bg-danger rounded-pill px-3'>Tidak Lulus</span>";

                            echo "<tr>";
                            echo "<td class='py-3'>" . $no++ . "</td>";
                            echo "<td class='py-3 text-start fw-medium'>" . $mhs['nama'] . "</td>";
                            echo "<td class='py-3'>" . $mhs['nim'] . "</td>";
                            echo "<td class='py-3'>" . $mhs['tugas'] . "</td>";
                            echo "<td class='py-3'>" . $mhs['uts'] . "</td>";
                            echo "<td class='py-3'>" . $mhs['uas'] . "</td>";
                            echo "<td class='py-3 fw-bold'>" . number_format($nilai_akhir, 2) . "</td>";
                            echo "<td class='py-3'><strong>" . $grade . "</strong></td>";
                            echo "<td class='py-3'>" . $status_badge . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <?php
            $jumlah_mahasiswa = count($mahasiswa);
            $rata_rata_kelas = $jumlah_mahasiswa > 0 ? $total_nilai_kelas / $jumlah_mahasiswa : 0;
            ?>

            <div class="row mt-4">
                <div class="col-md-4 mb-3">
                    <div class="alert alert-primary text-center shadow-sm border-0 h-100 d-flex flex-column justify-content-center py-4" role="alert">
                        <h6 class="alert-heading text-uppercase text-muted mb-2">Total Mahasiswa</h6>
                        <p class="mb-0 fs-2 fw-bold text-dark"><?php echo $jumlah_mahasiswa; ?></p>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="alert alert-primary text-center shadow-sm border-0 h-100 d-flex flex-column justify-content-center py-4" role="alert">
                        <h6 class="alert-heading text-uppercase text-muted mb-2">Rata-rata Kelas</h6>
                        <p class="mb-0 fs-2 fw-bold text-dark"><?php echo number_format($rata_rata_kelas, 2); ?></p>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="alert alert-primary text-center shadow-sm border-0 h-100 d-flex flex-column justify-content-center py-4" role="alert">
                        <h6 class="alert-heading text-uppercase text-muted mb-2">Nilai Tertinggi</h6>
                        <p class="mb-0 fs-2 fw-bold text-dark"><?php echo number_format($nilai_tertinggi, 2); ?></p>
                    </div>
                </div>
            </div>
</div>

</body>
</html>

<?= view('pages/templates/header') ?>

<!-- Page Header -->
<div class="container-fluid page-header mt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-5 mb-3 animated slideInDown" style="letter-spacing:2px;">Cari Lapangan Futsal</h1>
        <p class="lead animated slideInDown mb-4">Masukkan kriteriamu, cari lapangan, dan temukan tempat terbaik.</p>
        <nav aria-label="breadcrumb" class="animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Fusion</a></li>
                <li class="breadcrumb-item text-dark active">Cari Lapangan Futsal</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Info Banner -->
<div class="container-fluid bg-primary mb-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container text-center text-white py-4" style="font-family:'Alata', sans-serif;">
        Silahkan isi terlebih dahulu nilai kriteria menggunakan perbandingan berpasangan berdasarkan skala perbandingan 1-9
        (<a href="#" class="text-dark fw-bold" data-bs-toggle="modal" data-bs-target="#teori">lihat teori</a>)
        kemudian klik <strong>Simpan dan Lihat Hasil</strong> untuk melakukan pembobotan preferensi dengan menggunakan metode AHP dan perhitungan dengan menggunakan metode TOPSIS.
    </div>
</div>

<!-- Modal Skala -->
<div class="modal fade" id="teori" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center">Skala Perbandingan 1–9</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="bg-primary text-white">
                            <tr class="text-center">
                                <th>Skala</th>
                                <th>Tingkat Kepentingan</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $skala = [
                                1 => 'Sama penting',
                                2 => 'Mendekati sedikit lebih penting',
                                3 => 'Sedikit lebih penting',
                                4 => 'Mendekati lebih penting ',
                                5 => 'Lebih penting',
                                6 => 'Mendekati sangat lebih penting ',
                                7 => 'Sangat lebih penting',
                                8 => 'Mendekati mutlak lebih penting',
                                9 => 'Mutlak lebih penting'
                            ];

                            $deskripsi = [
                                1 => 'Kedua kriteria memiliki tingkat kepentingan yang sama.',
                                2 => 'Satu kriteria mendekati sedikit lebih penting daripada kriteria lainnya.',
                                3 => 'Satu kriteria sedikit lebih penting daripada kriteria lainnya.',
                                4 => 'Satu kriteria mendekati lebih penting daripada kriteria lainnya.',
                                5 => 'Satu kriteria lebih penting daripada kriteria lainnya.',
                                6 => 'Satu kriteria mendekati sangat lebih penting daripada kriteria lainnya.',
                                7 => 'Satu kriteria sangat lebih penting daripada kriteria lainnya.',
                                8 => 'Satu kriteria mendekati mutlak lebih penting daripada kriteria lainnya.',
                                9 => 'Satu kriteria mutlak lebih penting daripada kriteria lainnya.'
                            ];
                            foreach ($skala as $i => $label): ?>
                                <tr>
                                    <td class="text-center"><?= $i ?></td>
                                    <td><?= $label ?></td>
                                    <td><?= $deskripsi[$i] ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($error)) : ?>
    <div class="container-fluid bg-secondary mb-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container text-center text-white  py-4" style="font-family:'Alata', sans-serif;">
            <?= $error ?>
        </div>
    </div>
<?php endif; ?>
<!-- Form AHP -->
<div class="container py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="table-responsive">
        <form method="post" action="<?= base_url('hasil-perhitungan') ?>">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-costum">
                    <tr>
                        <th style="width:25%;">Nama Kriteria</th>
                        <th style="width:50%;">Skala Perbandingan</th>
                        <th style="width:25%;">Nama Kriteria</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($kriteria as $i => $k1): ?>
                        <?php foreach ($kriteria as $j => $k2): ?>
                            <?php if ($i < $j): ?>
                                <?php
                                $inputName = 'nilai_' . $k1['id_kriteria'] . '_' . $k2['id_kriteria'];
                                $checkedDefault = 'checked';
                                ?>
                                <tr>
                                    <td><?= esc($k1['nama']) ?></td>
                                    <td class="scrollable-cell">
                                        <div class="scroll-button-group">
                                            <?php
                                            $inputName = 'nilai_' . $k1['id_kriteria'] . '_' . $k2['id_kriteria'];
                                            $selected = $inputUser[$k1['id_kriteria']][$k2['id_kriteria']] ?? 1;
                                            $uid = $k1['id_kriteria'] . '_' . $k2['id_kriteria'];
                                            ?>

                                            <?php for ($n = 9; $n >= 1; $n--): ?>
                                                <?php $radioId = "r_{$uid}_{$n}"; ?>
                                                <input type="radio" class="btn-check" name="<?= $inputName ?>" id="<?= $radioId ?>" value="<?= $n ?>" <?= $n == $selected ? 'checked' : '' ?>>
                                                <label for="<?= $radioId ?>" class="btn btn-outline-primary btn-sm"><?= $n ?></label>
                                            <?php endfor; ?>

                                            <?php for ($n = -2; $n >= -9; $n--): ?>
                                                <?php $radioId = "r_{$uid}_neg" . abs($n); ?>
                                                <input type="radio" class="btn-check" name="<?= $inputName ?>" id="<?= $radioId ?>" value="<?= $n ?>" <?= $n == $selected ? 'checked' : '' ?>>
                                                <label for="<?= $radioId ?>" class="btn btn-outline-primary btn-sm"><?= abs($n) ?></label>
                                            <?php endfor; ?>
                                        </div>
                                    </td>
                                    <td><?= esc($k2['nama']) ?></td>
                                </tr>

                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>

                    <tr>
                        <td colspan="3">
                            <div class="text-center">
                                <?php if (checkLogin()) : ?>
                                    <button type="submit" class="btn btn-primary rounded-pill px-4 py-2">
                                        <i class="fas fa-save me-1"></i> Hitung dan Lihat Hasil
                                    </button>
                                <?php else : ?>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalLogin" class="btn btn-primary rounded-pill px-5 py-2 w-100" style="letter-spacing: 8px;">K I R I M</button>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <p class="text-muted fst-italic small mt-2 d-block d-md-none">
        <i class="bi bi-arrow-left-right me-1"></i>Geser ke samping untuk memilih skala.
    </p>
</div>
<div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="font-family:Alata, sans-serif;">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLoginLabel">Masuk Akun ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Silahkan Masuk Akun terlebih dahulu sebelum mengirim nilai perbandingan
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary text-white rounded-pill py-2 px-3" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary rounded-pill py-2 px-3"><a href="<?= base_url('login') ?>" class="text-white">Masuk</a></button>
            </div>
        </div>
    </div>
</div>

<?= view('pages/templates/footer') ?>
<?= $this->extend('layout/template') ?>

<?= $this->section('stylesheet') ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
    .dt-buttons {
        width: 100%;
    }

    /* Responsiveness */
    @media (max-width: 768px) {
        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        .col {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="hero">
    <?php if (in_groups('user')) { ?>
        <form action="<?php echo base_url('pengajuan/store'); ?>" method="post">
            <div class="container">
                <div class="row justify-content-md-between">
                    <div class="col-md-11">
                        <h5 class="fw-bold">Form Tambah Pengajuan</h5>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-dark btn-sm">Tambah</button>
                    </div>
                </div>
                <!-- Tampilkan pesan kesalahan jika ada -->
                <?php if (session()->has('error')) : ?>
                    <div class="alert alert-danger mt-2"><?= session('error') ?></div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label for="orang_terlibat" class="mb-2">Jumlah Orang Terlibat</label>
                            <input type="number" name="orang_terlibat" class="form-control" value="<?= @old("orang_terlibat") ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="hari_tanggal" class="mb-2">Hari Tanggal</label>
                            <input type="date" name="hari_tanggal" value="<?= @old("hari_tanggal") ?>" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="waktu_awal" class="mb-2">Waktu Awal</label>
                            <select name="waktu_awal" class="form-control" required>
                                <?php
                                $start_time = strtotime('6:01 AM');
                                $end_time = strtotime('9:31 PM');

                                while ($start_time <= $end_time) {
                                    $time = date('H:i', $start_time);

                                    echo '<option value="' . $time . '">' . $time . '</option>';
                                    $start_time += (30 * 60); // Menambahkan 30 menit
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="waktu_akhir" class="mb-2">Waktu Akhir</label>
                            <select name="waktu_akhir" class="form-control" required>
                                <?php
                                $start_time = strtotime('6:30 AM');
                                $end_time = strtotime('10:00 PM');

                                while ($start_time <= $end_time) {
                                    $time = date('H:i', $start_time);

                                    echo '<option value="' . $time . '">' . $time . '</option>';
                                    $start_time += (30 * 60); // Menambahkan 30 menit
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label for="Tempat_yang_dipakai" class="mb-2">Tempat yang Dipakai</label>
                            <select name="Tempat_yang_dipakai" id="Tempat_yang_dipakai" class="form-control">
                                <?php
                                $tempatOptions = [
                                    'Ruang Spare Room 1', 'Ruang Spare Room 2', 'Atrium SD', 'Kelas X.1', 'Kelas X.2', 'Kelas X.3', 'Kelas X.4',
                                    'Kelas X.5', 'Kelas X.6', 'Kelas X.7', 'Kelas XI.1', 'Kelas XI.2', 'Kelas XI.3',
                                    'Kelas XI.4', 'Kelas XI.5', 'Kelas XI.6', 'Kelas XI.7', 'Kelas XII.1', 'Kelas XII.2', 'Kelas XII.3', 'Kelas XII.4',
                                    'Kelas XII.5', 'Kelas XII.6', 'Kelas XII.7', 'Teater', 'Ruang OSIS/Wakasis', 'Ruang Laboratorium', 'Laboratorium Kimia',
                                    'Laboratorium Fisika', 'Laboratorium Komputer', 'Laboratorium Biologi', 'Laboratorium Bahasa',
                                    'Ruang Tamu', 'IT, Multimedia & Marketing', 'Ruang UKS', 'Ruang Yayasan', 'Ruang Guru',
                                    'Ruang Kepsek', 'Ruang Wakakur', 'Ruang Wakasar', 'Ruang Serbaguna SMA', 'Ruang Kuliner',
                                    'Ruang Musik', 'Perpustakaan', 'Kantin', 'Lapangan Badminton', 'Lapangan Tenis Meja',
                                    'Kolam Renang', 'Lapangan Basket', 'Lapangan Voli', 'Lapangan Tenis', 'Lapangan Senam',
                                    'Lapangan Futsal'
                                ];
                                foreach ($tempatOptions as $tempat) : ?>
                                    <option value="<?= $tempat ?>" <?= @old('Tempat_yang_dipakai') == $tempat ? 'selected' : '' ?>><?= $tempat ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="peralatan" class="mb-2">Peralatan</label>
                            <input type="text" name="peralatan" class="form-control" value="<?= @old("peralatan"); ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="kegunaan" class="mb-2">Kegunaan</label>
                            <input type="text" name="kegunaan" class="form-control" value="<?= @old("kegunaan"); ?>" required>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php }; ?>
    <div class="container">
        <div class="table-responsive">
            <table id="example" class="display table-bordered">
                <thead>
                    <tr style="background:#ECF2FF">
                        <th class="text-center">No</th>
                        <th class="text-center">Penanggung Jawab</th>
                        <th class="text-center">Jumlah Orang Terlibat</th>
                        <th class="text-center">Hari Tanggal</th>
                        <th class="text-center">Waktu Awal</th>
                        <th class="text-center">Waktu Akhir</th>
                        <th class="text-center">Tempat yang dipakai</th>
                        <th class="text-center">Peralatan</th>
                        <th class="text-center">Kegunaan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($pengajuan as $row) : ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row['penanggung_jawab'] ?></td>
                            <td><?= $row['orang_terlibat'] ?></td>
                            <td><?= $row['hari_tanggal'] ?></td>
                            <td><?= $row['waktu_awal'] ?></td>
                            <td><?= $row['waktu_akhir'] ?></td>
                            <td><?= $row['Tempat_yang_dipakai'] ?></td>
                            <td><?= $row['peralatan'] ?></td>
                            <td><?= $row['kegunaan'] ?></td>
                            <td><?= $row['status'] ?></td>
                            <td>
                                <div style="display: flex; align-items: center;">
                                    <a href="<?= base_url('pengajuan/edit/' . $row['id_pengajuan']) ?>" class="btn btn-primary btn-sm">
                                        <i class="bi bi-pencil-fill"></i> Edit
                                    </a>
                                    <?php if (in_groups('user')) { ?>
                                        <a href="https://api.whatsapp.com/send?phone=6289506754067&text=Kepada%2C%0A%5BPenanggung%20Jawab%5D%0A%0ADengan%20hormat%2C%0A%0ASaya%20mengajukan%20permohonan%20untuk%20melaksanakan%20kegiatan%20dengan%20rincian%20sebagai%20berikut%3A%0A%0APenanggung%20Jawab%3A%20%5BNama%20Penanggung%20Jawab%5D%0AOrang%20Terlibat%3A%20%5BDaftar%20Nama%20Orang%20Terlibat%5D%0AHari%20Tanggal%3A%20%5BHari%20Tanggal%5D%0AWaktu%20Awal%3A%20%5BWaktu%20Awal%5D%0AWaktu%20Akhir%3A%20%5BWaktu%20Akhir%5D%0ATempat%20yang%20Dipakai%3A%20%5BTempat%20yang%20dipakai%5D%0APeralatan%3A%20%5BPeralatan%5D%0AKegunaan%3A%20%5BKegunaan%5D%0AKegiatan%20ini%20penting%20untuk%20%5Bjelaskan%20alasan%20atau%20manfaat%20kegiatan%5D.%20Kami%20telah%20menyiapkan%20segala%20sesuatu%20dengan%20matang%2C%20termasuk%20peralatan%20dan%20persiapan%20lainnya." style="margin-left: 10px;">
                                            <i class="fa fa-whatsapp" style="font-size: 36px; color: green;"></i>
                                        </a>
                                    <?php }; ?>
                                </div>
                            </td>
                        </tr>
                    <?php $i++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<!-- jQuery Library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Datatable JS -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

<script>
    // table search
    $(document).ready(function() {
        $('#example').DataTable({
            columnDefs: [{
                    targets: [0, 1, 2, 4, 5, 6, 7, 8],
                    orderable: false
                } // Menggunakan indeks kolom (dimulai dari 0) untuk menentukan kolom yang akan dinonaktifkan pengurutannya
            ],
            dom: 'Blfrtip',
            buttons: [{
                    extend: 'copy'
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 4, 5, 6, 7, 8, 9] // Column index which needs to export
                    }
                },
                {
                    extend: 'csv',
                },
                {
                    extend: 'excel',
                }
            ]
        });
    });
</script>

<?= $this->endSection() ?>
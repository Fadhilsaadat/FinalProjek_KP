<?= $this->extend('layout/template') ?>

<?= $this->section('stylesheet') ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<style>

</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="hero">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <form action="<?= base_url('pengajuan/update/' . $pengajuan['id_pengajuan']) ?>" method="post">
          <input type="hidden" name="id" value="<?= $pengajuan['id_pengajuan'] ?>">

          <div class="form-group">
            <label>Penanggung Jawab</label>
            <input type="text" name="penanggung_jawab" class="form-control" value="<?= $pengajuan['penanggung_jawab'] ?>" readonly>
          </div>
          <div class="form-group">
            <label>Jumlah Orang Terlibat</label>
            <input type="number" name="orang_terlibat" class="form-control" value="<?= $pengajuan['orang_terlibat'] ?>" readonly>
          </div>
          <div class="form-group">
            <label>Hari Tanggal</label>
            <input type="text" name="hari_tanggal" class="form-control" value="<?= $pengajuan['hari_tanggal'] ?>" readonly>
          </div>
          <div class="form-group">
            <label>Waktu Awal</label>
            <input type="text" name="waktu_awal" class="form-control" value="<?= $pengajuan['waktu_awal'] ?>" readonly>
          </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Waktu Akhir</label>
          <input type="text" name="waktu_akhir" class="form-control" value="<?= $pengajuan['waktu_akhir'] ?>" readonly>
        </div>
        <div class="form-group">
          <label>Tempat yang Dipakai</label>
          <input type="text" name="Tempat_yang_dipakai" class="form-control" value="<?= $pengajuan['Tempat_yang_dipakai'] ?>" readonly>
        </div>
        <div class="form-group">
          <label>Peralatan</label>
          <input type="text" name="peralatan" class="form-control" value="<?= $pengajuan['peralatan'] ?>" readonly>
        </div>
        <div class="form-group">
          <label>Kegunaan</label>
          <input type="text" name="kegunaan" class="form-control" value="<?= $pengajuan['kegunaan'] ?>" readonly>
        </div>
        <div class="form-group">
          <label>Status</label>
          <select name="status" class="form-control">
            <?php if (in_groups("admin")) { ?>

              <option value="Telah disetujui" <?= $pengajuan['status'] == 'Disetujui' ? 'selected' : '' ?>>Disetujui</option>
              <option value="Ditolak" <?= $pengajuan['status'] == 'Ditolak' ? 'selected' : '' ?>>Ditolak</option>
            <?php } ?>

            <?php if (in_groups("user")) { ?>
              <option value="Dibatalkan" <?= $pengajuan['status'] == 'Dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
            <?php } ?>
          </select>
        </div>
        <button type="submit" class="btn btn-primary" id="simpan-button">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
  document.getElementById('simpan-button').addEventListener('click', function(e) {
    var statusSelect = document.querySelector('select[name="status"]');
    var selectedStatus = statusSelect.options[statusSelect.selectedIndex].value;

    if (selectedStatus === 'Dibatalkan' && <?= in_groups('user') ? 'true' : 'false' ?>) {
      e.preventDefault();
      if (confirm('Anda yakin ingin mengajukan pembatalan?')) {
        alert('Pembatalan diajukan.');
        document.querySelector('form').submit();
      }
    }
  });
</script>

<?= $this->endSection() ?>
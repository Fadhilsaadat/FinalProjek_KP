<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
  <section class="vh-100" style="background-color: #1F2533;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-4">
          <div class="card" style="border-radius: 1rem;">
            <div class="card-body p-4 text-center">

              <div class="">

                <img src="https://kumbang.sch.id/karir/assets/images/sma.png" class="mb-2" alt="Logo SMA Kumbang" width="80" height="80">
                <p class="fs-6 mb-4">Selamat Datang di </br> Aplikasi Penjadwalan Penggunaan Sarana</p>
                <?php if (session()->has('message')) : ?>
                  <div class="alert alert-success">
                    <?= session('message') ?>
                  </div>
                <?php endif ?>

                <?php if (session()->has('error')) : ?>
                  <div class="alert alert-danger">
                    <?= session('error') ?>
                  </div>
                <?php endif ?>

                <!-- <?php if (session()->has('errors')) : ?>
                  <ul class="alert alert-danger">
                    <?php foreach (session('errors') as $error) : ?>
                      <li><?= $error ?></li>
                    <?php endforeach ?>
                  </ul>
                <?php endif ?> -->
                <form method="POST" action="<?= route_to('login') ?>">
                  <?= csrf_field() ?>

                  <div class="form-outline mb-3">

                    <div class="form-group">
                      <!-- <label for="login"><?= lang('Auth.emailOrUsername') ?></label> -->
                      <input type="text" class="form-control form-control-lg fs-6 <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="Masukkan nomor telepon">
                      <div class="invalid-feedback">
                        <?= session('errors.login') ?>
                      </div>
                    </div>
                    <!-- <input type="tel" name="username" placeholder="Masukkan nomor telepon" id="typePhone" class="form-control form-control-lg fs-6" /> -->
                  </div>

                  <div class="form-outline mb-3">
                    <div class="form-group">
                      <!-- <label for="password"><?= lang('Auth.password') ?></label> -->
                      <input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">
                      <div class="invalid-feedback">
                        <?= session('errors.password') ?>
                      </div>
                      <?php if ($config->activeResetter) : ?>
                        <div class="float-left mt-2">
                          <a href="<?= route_to('forgot') ?>" class="text-muted">Lupa Password?</a>
                        </div>
                      <?php endif; ?>
                    </div>
                    <!-- <input type="password" name="password" placeholder="Masukkan kata sandi" id="typePassword" class="form-control form-control-lg fs-6" /> -->
                  </div>

                  <div>
                    <p class="mt-2">Belum memiliki akun? <a href="/register" class="fw-bold">Daftar</a></p>
                  </div>

                  <button class="btn btn-outline-dark px-2 mt-2" type="submit">Masuk</button>
                </form>

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>
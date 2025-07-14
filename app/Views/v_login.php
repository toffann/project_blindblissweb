<?= $this->extend('layout_clear') ?>
<?= $this->section('content') ?>

<div class="login-page-background"></div>

<?php
$username = [
    'name' => 'username',
    'id' => 'username',
    'class' => 'form-control'
];

$password = [
    'name' => 'password',
    'id' => 'password',
    'class' => 'form-control'
];
?>
<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="text-center mb-3">
    <a href="index.html" class="d-flex align-items-center justify-content-center">
        <img src="<?= base_url() ?>NiceAdmin\assets\img\logoB_baru.png" 
             alt="Logo Blind Bliss" 
             style="height: 80px; width: auto; object-fit: contain; margin-right: 10px;"> <!-- Ini yang diubah biar ukuran logonya keliatan -->
        <span class="fs-3 fw-bold text-dark">Blind Bliss</span>
    </a>
</div>
<div class="card mb-3">

                    <div class="card-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4" style="color: #000;">Masuk ke Akun Anda</h5>
                            <p class="text-center small" style="color: #000;">Silakan masukkan username dan password Anda</p>
                        </div>

                        <?php
                        if (session()->getFlashData('failed')) {
                        ?>
                            <div class="col-12 alert alert-danger" role="alert">
                                <hr>
                                <p class="mb-0">
                                    <?= session()->getFlashData('failed') ?>
                                </p>
                            </div>
                        <?php
                        }
                        ?>

<?= form_open('login', 'class = "row g-3 needs-validation"') ?>

<div class="col-12">
    <label for="yourUsername" class="form-label">Username</label>
    <div class="input-group has-validation">
        <span class="input-group-text" id="inputGroupPrepend">@</span>
        <?= form_input($username) ?>
        <div class="invalid-feedback">Please enter your username.</div>
    </div>
</div>

<div class="col-12">
    <label for="yourPassword" class="form-label">Password</label>
		    <?= form_password($password) ?>
    <div class="invalid-feedback">Please enter your password!</div>
</div>
<div class="col-12">
    <?= form_submit('submit', 'Login', [
    'class' => 'btn w-100',
    'style' => 'background-color: #EF476F; color: #fff; border: none;'
]) ?>
</div>

<?= form_close() ?>
                    </div>
                </div>

                <div class="credits" style="color: white;">
                     Designed by <a href="https://bootstrapmade.com/" style="color: white;">BootstrapMade</a>
                </div>


            </div>
        </div>
    </div>

</section>
<?= $this->endSection() ?>
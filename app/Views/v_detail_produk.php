<?= $this->extend('layout') ?>
<?= $this->section('content') ?>



<section class="py-5">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <img class="card-img-top mb-5 mb-md-0 rounded-3 shadow" src="<?= base_url('NiceAdmin/assets/img/' . $produk_image) ?>" alt="<?= $produk_name ?>" />
            </div>
            <div class="col-md-6">
                <div class="small mb-1">SKU: BST-<?= $produk_id ?></div>
                <h1 class="display-5 fw-bolder"><?= $produk_name ?></h1>
                <div class="fs-5 mb-5">
                    <span class="text-decoration-line-through">$<?= number_format($produk_old_price, 2) ?></span>
                    <span>$<?= number_format($produk_price, 2) ?></span>
                </div>

                <div class="product-description mb-4">
                    <h3>Deskripsi Produk</h3>
                    <!-- untuk merapikan deskripsi pada produk detail -->
                    <div style="white-space: pre-line; font-size: 14px; line-height: 1.6; color: #333;"> 
                        <?= esc($produk_description) ?>
                    </div>
                </div>

                <form action="<?= base_url('/keranjang') ?>" method="post" class="d-flex align-items-center gap-3">
                    <?= csrf_field() ?>
                    <input type="hidden" name="produk_id" value="<?= $produk_id ?>">
                    <div class="input-group" style="width: 120px;">
                        <button type="button" class="btn btn-outline-secondary no-hover" id="button-minus" style="width: 30px; height: 30px; padding: 0;">-</button>
                        <input type="text" name="quantity" id="inputQuantity" class="form-control text-center" value="1" min="1" style="width: 60px; height: 30px; padding: 0;" />
                        <button type="button" class="btn btn-outline-secondary no-hover" id="button-plus" style="width: 30px; height: 30px; padding: 0;">+</button>
                    </div>
                    <button type="submit" class="btn btn-info rounded-pill">Beli</button>
                </form>

            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Produk Terkait</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <div class="col mb-5">
                <div class="card h-100">
                    <img class="card-img-top" src="<?= base_url('NiceAdmin/assets/img/produk1.jpg') ?>" alt="Produk Terkait 1" />
                    <div class="card-body p-4">
                        <div class="text-center">
                            <h5 class="fw-bolder">Produk Terkait 1</h5>
                            $25.00
                        </div>
                    </div>
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="<?= base_url('/produk/1') ?>">Lihat Detail</a></div>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card h-100">
                    <img class="card-img-top" src="<?= base_url('NiceAdmin/assets/img/produk2.jpg') ?>" alt="Produk Terkait 2" />
                    <div class="card-body p-4">
                        <div class="text-center">
                            <h5 class="fw-bolder">Produk Terkait 2</h5>
                            $35.00
                        </div>
                    </div>
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="<?= base_url('/produk/2') ?>">Lihat Detail</a></div>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card h-100">
                    <img class="card-img-top" src="<?= base_url('NiceAdmin/assets/img/produk3.jpg') ?>" alt="Produk Terkait 3" />
                    <div class="card-body p-4">
                        <div class="text-center">
                            <h5 class="fw-bolder">Produk Terkait 3</h5>
                            $25.00
                        </div>
                    </div>
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="<?= base_url('/produk/3') ?>">Lihat Detail</a></div>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card h-100">
                    <img class="card-img-top" src="<?= base_url('NiceAdmin/assets/img/produk4.jpg') ?>" alt="Produk Terkait 4" />
                    <div class="card-body p-4">
                        <div class="text-center">
                            <h5 class="fw-bolder">Produk Terkait 4</h5>
                            $25.00
                        </div>
                    </div>
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="<?= base_url('/produk/4') ?>">Lihat Detail</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputQuantity = document.getElementById('inputQuantity');
        const buttonMinus = document.getElementById('button-minus');
        const buttonPlus = document.getElementById('button-plus');

        if (inputQuantity && buttonMinus && buttonPlus) { // Pastikan elemen ada
            buttonMinus.addEventListener('click', function() {
                let currentValue = parseInt(inputQuantity.value);
                if (currentValue > 1) { // Pastikan tidak kurang dari 1
                    inputQuantity.value = currentValue - 1;
                }
            });

            buttonPlus.addEventListener('click', function() {
                let currentValue = parseInt(inputQuantity.value);
                inputQuantity.value = currentValue + 1;
            });

            // Opsional: Validasi input agar hanya angka
            inputQuantity.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, ''); // Hanya izinkan angka
                if (this.value === '' || parseInt(this.value) < 1) {
                    this.value = '1'; // Pastikan minimal 1
                }
            });
        }
    });
</script>

<?= $this->endSection() ?>
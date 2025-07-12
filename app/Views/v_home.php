<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<?php
if (session()->getFlashData('success')) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>
<!-- Table with stripped rows -->
<div class="row">
    <?php foreach ($product as $key => $item) : ?>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <?= form_open('keranjang') ?>
            <?php
            echo form_hidden('id', $item['id']);
            echo form_hidden('nama', $item['nama']);
            echo form_hidden('harga', $item['harga']);
            echo form_hidden('foto', $item['foto']);
            ?>
            <div class="card card-custom">
                <div class="card-body">
                    <img src="<?php echo base_url() . "NiceAdmin/assets/img/" . $item['foto'] ?>" alt="..." class="card-img-custom">
                    <h5 class="card-title"><?php echo $item['nama'] ?><br><?php echo number_to_currency($item['harga'], 'IDR') ?></h5>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-beli btn-custom">Beli</button>
                        <a class="btn btn-detail btn-custom" href="<?= base_url('produk/' . $item['id']) ?>">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    <?php endforeach ?>
</div>
<!-- End Table with stripped rows -->
<?= $this->endSection() ?>
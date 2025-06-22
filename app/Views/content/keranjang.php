<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Data Kategori</h5>
        <ul>
            <?php
            foreach ($kat as $key => $value) {
            ?>
                <li><a href="/kategori/<?php echo $key ?>"><?php echo $value ?></a></li>
            <?php
            }
            ?>
        </ul>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
History Transaksi Pembelian <strong><?= $username ?></strong>
<hr>
<div class="table-responsive">
    <table class="table datatable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID Pembelian</th>
                <th scope="col">Waktu Pembelian</th>
                <th scope="col">Total Bayar</th>
                <th scope="col">Alamat</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($buy)) :
                foreach ($buy as $index => $item) :
            ?>
                    <tr>
                        <th scope="row"><?php echo $index + 1 ?></th>
                        <td><?php echo $item['id'] ?></td>
                        <td><?php echo $item['created_at'] ?></td>
                        <td><?php echo number_to_currency($item['total_harga'], 'IDR') ?></td>
                        <td><?php echo $item['alamat'] ?></td>
                        <td>
                            <?php
                            if ($item['status'] == "1") {
                                echo "<span class='badge bg-success'>Sudah Selesai</span>";
                            } elseif ($item['status'] == "2") { // Asumsi '2' untuk 'Diproses'
                                echo "<span class='badge bg-warning text-dark'>Diproses</span>";
                            } else {
                                echo "<span class='badge bg-info'>Belum Selesai</span>"; // Asumsi '0' atau selain '1','2' adalah 'Belum Selesai'
                            }
                            ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#detailModal-<?= $item['id'] ?>">
                                Detail
                            </button>
                            <?php if ($item['status'] == "0") : // Tombol hanya muncul jika status 'Belum Selesai' (asumsi 0) ?>
                                <?= form_open('transaksi/update_status', ['style' => 'display:inline; margin-left: 5px;']) ?>
                                    <?= form_hidden('transaction_id', $item['id']) ?>
                                    <?= form_hidden('new_status', '2') // Mengubah ke status 'Diproses' (asumsi 2) ?>
                                    <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Apakah Anda yakin ingin menandai pembayaran COD telah diproses untuk transaksi ini?')">
                                        Pembayaran COD
                                    </button>
                                <?= form_close() ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <div class="modal fade" id="detailModal-<?= $item['id'] ?>" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <?php
                                    // Pastikan $product ada dan memiliki kunci $item['id']
                                    if (isset($product[$item['id']]) && !empty($product[$item['id']])) {
                                        foreach ($product[$item['id']] as $index2 => $item2) : ?>
                                            <?php echo $index2 + 1 . ")" ?>
                                            <?php if ($item2['foto'] != '' and file_exists("NiceAdmin/assets/img/" . $item2['foto'] . "")) : // PERBAIKI PATH Niceadmin ke NiceAdmin ?>
                                                <img src="<?php echo base_url() . "NiceAdmin/assets/img/" . $item2['foto'] ?>" width="100px">
                                            <?php endif; ?>
                                            <strong><?= $item2['nama'] ?></strong>
                                            <?= number_to_currency($item2['harga'], 'IDR') ?>
                                            <br>
                                            <?= "(" . $item2['jumlah'] . " pcs)" ?><br>
                                            <?= number_to_currency($item2['subtotal_harga'], 'IDR') ?>
                                            <hr>
                                        <?php
                                        endforeach;
                                    } else {
                                        echo "<p>Detail produk tidak tersedia untuk transaksi ini.</p>";
                                    }
                                    ?>
                                    Ongkir <?= number_to_currency($item['ongkir'], 'IDR') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endforeach;
            endif;
            ?>
        </tbody>
    </table>
    </div>
<?= $this->endSection() ?>
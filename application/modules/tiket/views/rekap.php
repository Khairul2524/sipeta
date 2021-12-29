<main id="main" class="main">

    <div class="pagetitle">
        <h1><?= $judul; ?></h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Rekapan Transaksi</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tiket</th>
                            <th scope="col">Nama / Instansi</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Jumlah Orang</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($data as $d) {
                        ?>
                            <tr>
                                <th scope="row"><?= $no++; ?></th>
                                <td><?= $d->tiket; ?></td>
                                <td><?= $d->nama; ?></td>
                                <td><?= $d->alamat; ?></td>
                                <td><?= $d->jumlah; ?></td>
                                <td><?= date('d F Y / H:i:s a', $d->time); ?></td>
                                <td>Rp. <?= ' ' . number_format($d->harga, 2, ',', '.'); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main><!-- End #main -->
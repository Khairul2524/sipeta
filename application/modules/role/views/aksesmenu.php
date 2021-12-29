<main id="main" class="main">

    <div class="pagetitle">
        <h1><?= $judul; ?></h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Akses Menu : <?= $idrole->role ?></h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Menu</th>
                            <th scope="col">Hak Akses</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($menu as $d) {
                        ?>
                            <tr>
                                <th scope="row"><?= $no++; ?></th>
                                <td><?= $d->menu; ?></td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input akses" type="checkbox" id="akses" name="akses" data-role="<?= $idrole->idrole ?>" data-menu="<?= $d->idmenu ?>" <?= hakaksesmenu($idrole->idrole, $d->idmenu) ?>>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a href="<?= base_url('role/hakakses') ?>" class="btn btn-danger"><i class="bi bi-arrow-left-circle"></i> kembali</a>
            </div>
        </div>
    </section>

    <script>
        $(function() {
            // tambah
            $('.akses').on('click', function() {
                const menu = $(this).data('menu')
                const role = $(this).data('role')
                // console.log(menu, role)
                $.ajax({
                    url: `<?= base_url('role/insertakses') ?>`,
                    type: 'post',
                    data: {
                        menuid: menu,
                        roleid: role,
                    },

                    success: function() {
                        // console.log(e)
                        document.location.herf = `<?= base_url('role/aksesmenu/') ?>` + role
                    }
                })
            })

        })
    </script>
</main><!-- End #main -->
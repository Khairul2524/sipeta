<main id="main" class="main">

	<div class="pagetitle">
		<h1><?= $judul; ?></h1>
	</div><!-- End Page Title -->

	<section class="section">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Kartu Keluarga</h5>
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">No KK</th>
							<th scope="col">Kepala Keluarga</th>
							<th scope="col">Alamat</th>
							<th scope="col"> <button type="button" class="tombol-tambah btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#basicModal">Tambah</button></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($data as $d) {

						?>
							<tr>
								<th scope="row"><?= $no++; ?></th>
								<td><?= $d->nokk; ?></td>
								<td><?= $d->kepala; ?></td>
								<td><?= $d->alamat; ?></td>
								<td>
									<button type="button" class="btn btn-warning tombol-ubah" data-bs-toggle="modal" data-bs-target="#basicModal" data-id="<?= $d->idkk ?>"><i class="bi bi-tools"></i></button>
									<a href="<?= site_url('kk/hapus/') . $d->idkk ?>" type="button" class="btn btn-danger" onclick="return confirm('Yakin Hapus?')"><i class="bi bi-trash-fill"></i>
								</td>
							</tr>
						<?php }
						?>
					</tbody>
				</table>
			</div>
		</div>
	</section>

	<div class="modal fade" id="basicModal" tabindex="-1">
		<div class="modal-dialog">
			<form class="row g-3" action="<?= site_url('dusun/tambah') ?>" method="POST">
				<div class="modal-content">

					<div class="modal-header">
						<h5 class="modal-title" id="modal-title"></h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<div class="modal-body">

						<div class="col-12">
							<label for="dusun" class="form-label">dusun</label>
							<input type="hidden" name="id" id="id">
							<input type="text" class="form-control" id="dusun" name="dusun" required autocomplete="off">
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-success"></button>
					</div>

				</div>
			</form><!-- Vertical Form -->
		</div>
	</div><!-- End Basic Modal-->
	<script>
		$(function() {
			// tambah
			$('.tombol-tambah').on('click', function() {
				$('.modal-title').html('Tambah dusun')
				$('.modal-footer button[type= submit]').html('Simpan')
				$('#id').val('')
				$('#dusun').val('')


			})
			// ubah
			$('.tombol-ubah').on('click', function() {
				$('.modal-title').html('Ubah dusun')
				$('.modal-footer button[type= submit]').html('Ubah')
				$('.modal-dialog form').attr('action', `<?= site_url('dusun/ubah') ?>`)
				const id = $(this).data('id')
				// console.log(id)
				$.ajax({
					url: `<?= site_url('dusun/getubah') ?>`,
					data: {
						id: id
					},
					method: 'post',
					dataType: 'json',
					success: function(data) {
						// console.log(data)
						$('#id').val(data.iddusun)
						$('#dusun').val(data.dusun)

					}
				})
			})
		})
	</script>
</main><!-- End #main -->
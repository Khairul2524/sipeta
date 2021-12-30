<main id="main" class="main">

	<div class="pagetitle">
		<h1><?= $judul; ?></h1>
	</div><!-- End Page Title -->

	<section class="section">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">All Menu</h5>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Menu</th>
							<th>icon</th>
							<th>url</th>
							<th>urutan</th>
							<th>Aktif</th>
							<th><button type="button" class="tombol-tambah btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#basicModal">Tambah</button></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($menu as $d) {
						?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $d->menu ?></td>
								<td><?= $d->icon ?></td>
								<td><?= $d->url ?></td>
								<td><?= $d->urutan ?></td>
								<td><?php
									if ($d->aktif == 1) {
										echo "Aktif";
									} else {
										echo "Tidak Aktif";
									}

									?></td>
								<td class="text-center">
									<button type="button" class="btn btn-warning tombol-ubah" data-bs-toggle="modal" data-bs-target="#basicModal" data-id="<?= $d->idmenu ?>"><i class="bi bi-tools"></i></button>
									<a href="<?= site_url('menu/hapus/') . $d->idmenu ?>" type="button" class="btn btn-danger" onclick="return confirm('Yakin Hapus?')"><i class="bi bi-trash-fill"></i>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</section>
	<div class="modal fade" id="basicModal" tabindex="-1">
		<div class="modal-dialog">
			<form class="row g-3" action="<?= site_url('menu/tambah') ?>" method="POST">
				<div class="modal-content">

					<div class="modal-header">
						<h5 class="modal-title" id="modal-title"></h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<div class="modal-body">
						<div class="col-12">
							<label for="menu" class="form-label">Menu</label>
							<input type="text" class="form-control" id="menu" name="menu" autocomplete="off" required>
						</div>
						<div class="col-12">
							<label for="icon" class="form-label">Icon</label>
							<input type="hidden" name="id" id="id">
							<input type="text" class="form-control" id="icon" name="icon" required autocomplete="off">
						</div>
						<div class="col-12">
							<label for="url" class="form-label">Url</label>
							<input type="text" class="form-control" id="url" name="url" required autocomplete="off">
						</div>
						<div class="col-12">
							<label for="urutan" class="form-label">Urutan</label>
							<input type="number" class="form-control" id="urutan" name="urutan" required autocomplete="off">
						</div>
						<div class="col-12">
							<legend class="col-form-label col-sm-2 pt-0">Aktif</legend>
							<div class="col-sm-10">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="aktif" id="aktif" value="1" checked>
									<label class="form-check-label" for="aktif">
										Aktif
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="aktif" id="tidakaktif" value="2">
									<label class="form-check-label" for="tidakaktif">
										Tidak Aktif
									</label>
								</div>
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
				$('.modal-title').html('Tambah Menu')
				$('.modal-footer button[type= submit]').html('Simpan')
				$('#id').val('')
				$('#menu').val('')
				$('#icon').val('')
				$('#url').val('')
				$('#urutan').val('')
				$('#aktif').val(1)
				$('#tidakaktif').val(2)
			})
			// ubah
			$('.tombol-ubah').on('click', function() {
				$('.modal-title').html('Ubah Menu')
				$('.modal-footer button[type= submit]').html('Ubah')
				$('.modal-dialog form').attr('action', `<?= site_url('menu/ubah') ?>`)
				const id = $(this).data('id')
				// console.log(id)
				$.ajax({
					url: `<?= site_url('menu/getubah') ?>`,
					data: {
						id: id
					},
					method: 'post',
					dataType: 'json',
					success: function(data) {
						// console.log(data)
						// console.log(data)
						$('#id').val(data.idmenu)
						$('#menu').val(data.menu)
						$('#icon').val(data.icon)
						$('#url').val(data.url)
						$('#urutan').val(data.urutan)
						if (data.aktif == 1) {
							$('input:radio[name=aktif][value=' + data.aktif + ']')[0].checked = true;
						} else {
							$('input:radio[name=aktif][value=' + data.aktif + ']')[0].checked = true;
						}
					}
				})
			})
		})
	</script>

</main><!-- End #main -->
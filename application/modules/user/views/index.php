<main id="main" class="main">

	<div class="pagetitle">
		<h1><?= $judul; ?></h1>
	</div><!-- End Page Title -->

	<section class="section">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">User</h5>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Username</th>

							<th>Role</th>
							<th>Aktif</th>
							<th><button type="button" class="tombol-tambah btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#basicModal">Tambah</button></th>
						</tr>

					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($data as $d) {
						?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $d->nama ?></td>
								<td><?= $d->username ?></td>
								<td><?= $d->role ?></td>
								<td><?php
									if ($d->aktif == 1) {
										echo "Aktif";
									} else {
										echo "Tidak Aktif";
									}

									?></td>
								<td class="text-center">
									<button type="button" class="btn btn-warning tombol-ubah" data-bs-toggle="modal" data-bs-target="#basicModal" data-id="<?= $d->iduser ?>"><i class="bi bi-tools"></i></button>
									<a href="<?= site_url('user/hapus/') . $d->iduser ?>" type="button" class="btn btn-danger" onclick="return confirm('Yakin Hapus?')"><i class="bi bi-trash-fill"></i>
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
			<form class="row g-3" action="<?= site_url('user/tambah') ?>" method="POST">
				<div class="modal-content">

					<div class="modal-header">
						<h5 class="modal-title" id="modal-title"></h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<div class="modal-body">
						<div class="col-12">
							<label for="nama" class="form-label">Nama Lengkap</label>
							<input type="text" class="form-control" id="nama" name="nama" autocomplete="off" required>
						</div>
						<div class="col-12">
							<label for="username" class="form-label">Username</label>
							<input type="hidden" name="id" id="id">
							<input type="text" class="form-control" id="username" name="username" required autocomplete="off">
						</div>
						<div class="col-12" id="pass">
							<label for="password" class="form-label">Password</label>
							<input type="password" class="form-control" id="password" name="password" required autocomplete="off">
						</div>
						<div class="col-12">
							<label for="role" class="form-label">Role</label>
							<select id="role" name="role" class="form-select" required>
								<?php
								foreach ($roles as $r) {
								?>
									<option value="<?= $r->idrole ?>"><?= $r->role ?></option>
								<?php }
								?>
							</select>
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
				$('.modal-title').html('Tambah User')
				$('#pass').html(`<label for="password" class="form-label">Password</label> <input type="password" class="form-control" id="password" name="password" required autocomplete="off">`)
				$('.modal-footer button[type= submit]').html('Simpan')
				$('#id').val('')
				$('#username').val('')
				$('#password').val('')
				$('#nama').val('')
				$('#role').val('')
				$('#aktif').val(1)
				$('#tidakaktif').val(2)



			})
			// ubah
			$('.tombol-ubah').on('click', function() {
				$('.modal-title').html('Ubah User')
				$('#pass').html('')
				$('.modal-footer button[type= submit]').html('Ubah')
				$('.modal-dialog form').attr('action', `<?= site_url('user/ubah') ?>`)
				const id = $(this).data('id')
				// console.log(id)
				$.ajax({
					url: `<?= site_url('user/getubah') ?>`,
					data: {
						id: id
					},
					method: 'post',
					dataType: 'json',
					success: function(data) {
						// console.log(data)
						// console.log(data)
						$('#id').val(data.iduser)
						$('#nama').val(data.nama)
						$('#username').val(data.username)
						// $('#password').val(data.password)
						// $('#nama').val(data.nama)
						$('#role').val(data.idrole)
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
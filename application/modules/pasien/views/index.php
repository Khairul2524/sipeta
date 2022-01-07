<main id="main" class="main">

	<div class="pagetitle">
		<h1><?= $judul; ?></h1>
	</div><!-- End Page Title -->

	<section class="section">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Pasien</h5>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Alamat</th>
							<th>No Ponsel</th>
							<th>Email</th>
							<th>Kasus</th>
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
								<td><?= $d->dusun ?></td>
								<td><?= $d->noponsel ?></td>
								<td><?= $d->email ?></td>
								<td><?= $d->kasus ?></td>
								<td class="text-center">
									<button type="button" class="btn btn-warning tombol-ubah" data-bs-toggle="modal" data-bs-target="#basicModal" data-id="<?= $d->idpasien ?>"><i class="bi bi-tools"></i></button>
									<a href="<?= site_url('pasien/hapus/') . $d->idpasien ?>" type="button" class="btn btn-danger" onclick="return confirm('Yakin Hapus?')"><i class="bi bi-trash-fill"></i></a>
									<a href="<?= site_url('pasien/detail/') . $d->idpasien ?>" type="button" class="btn btn-info"><i class="bi bi-search"></i>
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
			<form class="row g-3" action="<?= site_url('pasien/tambah') ?>" method="POST">
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
							<label for="nik" class="form-label">NIK</label>
							<input type="hidden" name="id" id="id">
							<input type="number" class="form-control" id="nik" name="nik" required autocomplete="off">
						</div>
						<div class="col-12" id="pass">
							<label for="nokk" class="form-label">NO KK</label>
							<input type="number" class="form-control" id="nokk" name="nokk" required autocomplete="off">
						</div>
						<div class="col-12" id="pass">
							<label for="noponsel" class="form-label">NO Ponsel</label>
							<input type="number" class="form-control" id="noponsel" name="noponsel" required autocomplete="off">
						</div>
						<div class="col-12" id="pass">
							<label for="email" class="form-label">Email</label>
							<input type="text" class="form-control" id="email" name="email" required autocomplete="off">
						</div>
						<div class="col-12" id="pass">
							<label for="tempatlahir" class="form-label">Tempat Lahir</label>
							<input type="text" class="form-control" id="tempatlahir" name="tempatlahir" required autocomplete="off">
						</div>
						<div class="col-12" id="pass">
							<label for="tgllahir" class="form-label">Tanggal Lahir</label>
							<input type="text" class="form-control" id="tgllahir" name="tgllahir" required autocomplete="off">
						</div>
						<div class="col-12">
							<label for="kasus" class="form-label">Kasus</label>
							<select id="kasus" name="kasus" class="form-select" required>
								<?php
								foreach ($kasus as $kas) {
								?>
									<option value="<?= $kas->idkasus ?>"><?= $kas->kasus ?></option>
								<?php }
								?>
							</select>
						</div>
						<div class="col-12">
							<label for="dusun" class="form-label">Dusun</label>
							<select id="dusun" name="dusun" class="form-select" required>
								<?php
								foreach ($dusun as $dus) {
								?>
									<option value="<?= $dus->iddusun ?>"><?= $dus->dusun ?></option>
								<?php }
								?>
							</select>
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
				$('.modal-title').html('Tambah Pasien')
				$('.modal-footer button[type= submit]').html('Simpan')
				$('#id').val('')
				$('#nama').val('')
				$('#dusun').val('')
				$('#noponsel').val('')
				$('#nik').val('')
				$('#nokk').val('')
				$('#email').val('')
				$('#tempatlahir').val('')
				$('#tgllahir').val('')
				$('#kasus').val('')
				$('#dusun').val('')
			})
			// ubah
			$('.tombol-ubah').on('click', function() {
				$('.modal-title').html('Ubah Pasien')
				$('.modal-footer button[type= submit]').html('Ubah')
				$('.modal-dialog form').attr('action', `<?= site_url('pasien/ubah') ?>`)
				const id = $(this).data('id')
				// console.log(id)
				$.ajax({
					url: `<?= site_url('pasien/getubah') ?>`,
					data: {
						id: id
					},
					method: 'post',
					dataType: 'json',
					success: function(data) {
						$('#id').val(data.idpasien)
						$('#nama').val(data.nama)
						$('#dusun').val(data.iddusun)
						$('#noponsel').val(data.noponsel)
						$('#nik').val(data.nik)
						$('#nokk').val(data.nokk)
						$('#email').val(data.email)
						$('#tempatlahir').val(data.tempatlahir)
						$('#tgllahir').val(data.tgllahir)
						$('#kasus').val(data.idkasus)
						$('#dusun').val(data.iddusun)
					}
				})
			})
		})
	</script>
</main><!-- End #main -->
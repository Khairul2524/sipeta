<main id="main" class="main">

	<div class="pagetitle">
		<h1><?= $judul; ?></h1>
	</div><!-- End Page Title -->

	<section class="section">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Transaksi</h5>
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Tiket</th>
							<th scope="col">Nama / Instansi</th>
							<th scope="col">Alamat</th>
							<th scope="col">Jumlah Orang</th>
							<th scope="col">Harga</th>
							<!-- <th scope="col">Time</th> -->
							<th scope="col" style=" width: 150px;"> <button type="button" class="tombol-tambah btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#basicModal">Tambah</button></th>
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
								<td>Rp. <?= ' ' . number_format($d->harga, 2, ',', '.'); ?></td>
								<!-- <td></td> -->
								<td>
									<button type="button" class="btn btn-warning tombol-ubah" data-bs-toggle="modal" data-bs-target="#basicModal" data-id="<?= $d->id ?>"><i class="bi bi-tools"></i></button>
									<a href="<?= site_url('transaksi/hapus/') . $d->id ?>" type="button" class="btn btn-danger" onclick="return confirm('Yakin Hapus?')"><i class="bi bi-trash-fill"></i></a>
									<a href="<?= site_url('transaksi/cetak/') . $d->id ?>" type="button" class="btn btn-primary" target="blank"><i class="bi bi-printer"></i></a>
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
			<form class="row g-3" action="<?= site_url('transaksi/tambah') ?>" method="POST">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modal-title"></h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="col-12">
							<label for="nama" class="form-label">Nama / Instansi</label>
							<input type="text" class="form-control" id="nama" name="nama" required autocomplete="off">
							<input type="hidden" name="id" id="id">
						</div>
						<div class="col-12">
							<label for="nohp" class="form-label">No HP</label>
							<input type="text" class="form-control" id="nohp" name="nohp" required autocomplete="off">
						</div>
						<div class="col-12">
							<label for="nama" class="form-label">Alamat</label>
							<textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control"></textarea>
						</div>
						<div class="col-12">
							<label for="tiket" class="form-label">Tiket</label>
							<select id="tiket" name="tiket" class="form-select" required>
								<?php
								foreach ($tiket as $r) {
								?>
									<option value="<?= $r->idtiket ?>"><?= $r->tiket ?></option>
								<?php }
								?>
							</select>
						</div>
						<div class="col-12">
							<label for="jumlah" class="form-label">Jumlah Orang</label>
							<input type="number" class="form-control" id="jumlah" name="jumlah" required autocomplete="off">
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
				$('.modal-title').html('Tambah Transaksi')
				$('.modal-footer button[type= submit]').html('Simpan')
				$('#id').val('')
				$('#tiket').val('')
				$('#harga').val('')
				$('#nama').val('')
				$('#alamat').val('')
				$('#nohp').val('')
				$('#jumlah').val('')
			})
			// ubah
			$('.tombol-ubah').on('click', function() {
				$('.modal-title').html('Ubah Transaksi')
				$('.modal-footer button[type= submit]').html('Ubah')
				$('.modal-dialog form').attr('action', `<?= site_url('transaksi/ubah') ?>`)
				const id = $(this).data('id')
				// console.log(id)
				$.ajax({
					url: `<?= site_url('transaksi/getubah') ?>`,
					data: {
						id: id
					},
					method: 'post',
					dataType: 'json',
					success: function(data) {
						// console.log(data)
						$('#id').val(data.id)
						$('#tiket').val(data.idtiket)
						$('#nama').val(data.nama)
						$('#alamat').val(data.alamat)
						$('#nohp').val(data.nohp)
						$('#harga').val(data.harga)
						$('#jumlah').val(data.jumlah)

					}
				})
			})
		})
	</script>
</main><!-- End #main -->